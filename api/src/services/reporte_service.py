from typing import List
from src.extensions import db
from src.models.rep_model import Reporte 
from src.schemas.reporte_dto import ReporteReadDTO, ReporteCreateDTO
from src.schemas.common_dto import Estado
from src.schemas.usuario_dto import UsuarioDTO
from src.domain.contract import IReporteRepository  
from src.models.evidencia_model import Evidencia
from src.schemas.reporte_dto import ReporteReadDTO, EvidenciaDTO
from werkzeug.utils import secure_filename
from flask import current_app
import os

class ReporteService(IReporteRepository):
    
    def _mapear_a_dto(self, modelo_db: Reporte) -> ReporteReadDTO:
        """Función privada para convertir de BD a DTO, extrayendo título/desc de observaciones."""
        
        fecha_creacion_real = modelo_db.fecha_completa 
        
        if not fecha_creacion_real:
            from datetime import datetime
            fecha_creacion_real = datetime.now()

        # Lógica para extraer Título y Descripción
        obs = modelo_db.observaciones if modelo_db.observaciones else ""
        titulo = "Reporte Desconocido"
        descripcion = obs
        
        # Intenta parsear el formato
        try:
            inicio_titulo = obs.find("Título: ")
            inicio_desc = obs.find(" | Descripción: ")
            
            if inicio_titulo != -1 and inicio_desc != -1:
                titulo = obs[inicio_titulo + len("Título: "):inicio_desc].strip()
                descripcion = obs[inicio_desc + len(" | Descripción: "):].strip()
        except:
            pass # Si falla el parseo, se usan los valores por defecto

        lista_evidencias = []
        if modelo_db.evidencias: # Verifica si la relación tiene datos
            lista_evidencias = [
                EvidenciaDTO(
                    id=e.id,
                    nombre_archivo=e.nombre_archivo,
                    extension=e.extension,
                    url_acceso=f"/static/uploads/{e.nombre_archivo}"
                ) for e in modelo_db.evidencias
            ]

        return ReporteReadDTO(
            id=modelo_db.id,
            titulo=titulo, # Usando el valor extraído
            fecha_creacion=fecha_creacion_real, 
            fecha_evento=modelo_db.fecha_evento_db, # Usando la columna correcta FECEVE
            lugar=f"Lugar ID {modelo_db.lugar_id}", 
            descripcion=descripcion, # Usando el valor extraído
            estado=Estado.ABIERTO, 
            autor=UsuarioDTO( 
                id=modelo_db.usuario_id, 
                nombre_completo="Usuario Legacy", 
                email="usuario@test.com",
                cargo="Desconocido",
                rol_sistema="USER",
                es_activo=True
            ),
            evidencias=lista_evidencias
        )

    def obtener_todos(self) -> List[ReporteReadDTO]:
        resultados = Reporte.query.all()
        return [self._mapear_a_dto(rep) for rep in resultados]

    def crear_reporte(self, datos: ReporteCreateDTO) -> ReporteReadDTO:
        nuevo_rep = Reporte(
            titulo=datos.titulo,
            descripcion=datos.descripcion,
            usuario_id=datos.autor_id,
            lugar_id=datos.lugar_id
        )
        
        db.session.add(nuevo_rep)
        db.session.commit()
        
        return self._mapear_a_dto(nuevo_rep)

    def obtener_por_id(self, id: int) -> ReporteReadDTO:
        rep = Reporte.query.get(id)
        if not rep:
            return None
        return self._mapear_a_dto(rep)
    
    
    def agregar_evidencia(self, reporte_id: int, archivo, descripcion: str = ""):
        reporte = Reporte.query.get(reporte_id)
        if not reporte:
            return None

        if archivo.filename == '':
            raise ValueError("El archivo no tiene nombre")

        # 1. Preparar datos del archivo
        filename = secure_filename(archivo.filename)
        nombre_unico = f"{reporte_id}_{filename}"
        extension = filename.rsplit('.', 1)[1].lower() if '.' in filename else ''
        

        ruta_relativa = f"uploads/{nombre_unico}" 
        
        # Ruta física absoluta para guardar el archivo ahora
        upload_folder = current_app.config['UPLOAD_FOLDER']
        os.makedirs(upload_folder, exist_ok=True)
        ruta_fisica = os.path.join(upload_folder, nombre_unico)
        
        # Guardar archivo en disco
        archivo.save(ruta_fisica)

        # 2. Crear registro en BD usando las columnas reales
        nueva_evidencia = Evidencia(
            reporte_id=reporte.id,
            descripcion=descripcion[:40],  # Mapeado a NOMEVI
            nombre_archivo=nombre_unico,   # Mapeado a FILEVI
            ruta=ruta_relativa,            # Mapeado a RUTEVI
            tipo=extension                 # Mapeado a TIPEVI
        )

        db.session.add(nueva_evidencia)
        db.session.commit()

        # 3. Retornar DTO
        dto = EvidenciaDTO.model_validate(nueva_evidencia)
        # Ajustamos la URL de acceso para que apunte a la carpeta static
        dto.url_acceso = f"/static/{ruta_relativa}" 
        return dto