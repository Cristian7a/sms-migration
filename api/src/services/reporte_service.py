from typing import List
from src.extensions import db
from src.models.rep_model import Reporte, Area, Lugar
from src.models.evidencia_model import Evidencia
from src.models.usuario_model import Usuario, Empleado, Cargo
from src.schemas.reporte_dto import ReporteReadDTO, ReporteCreateDTO, EvidenciaDTO
from src.schemas.usuario_dto import UsuarioDTO
from src.domain.contract import IReporteRepository  
from werkzeug.utils import secure_filename
from flask import current_app
import os
from datetime import datetime

class ReporteService(IReporteRepository):
    
    def _mapear_a_dto(self, modelo_db: Reporte) -> ReporteReadDTO:
        
        fecha_creacion_real = modelo_db.fecha_creacion_db
        if not fecha_creacion_real:
            fecha_creacion_real = datetime.now()

        lista_evidencias = []
        if modelo_db.evidencias:
            lista_evidencias = [
                EvidenciaDTO(
                    id=e.id,
                    nombre_archivo=e.nombre_archivo,
                    tipo=e.tipo,
                    # URL para que el frontend pueda ver la imagen
                    url_acceso=f"/static/uploads/{e.nombre_archivo}"
                ) for e in modelo_db.evidencias
            ]

        # Autor dummy o real
        autor_dto = UsuarioDTO(
            id=modelo_db.usuario_id, 
            nombre_completo="Usuario Sistema", 
            email="usuario@sms.com",
            cargo="Empleado",
            rol_sistema="USER",
            es_activo=True
        )

        return ReporteReadDTO(
            id=modelo_db.id,
            fecha_creacion=fecha_creacion_real, 
            fecha_evento=modelo_db.fecha_evento_db, 
            lugar=f"{modelo_db.lugar_id}", 
            descripcion=modelo_db.observaciones if modelo_db.observaciones else "",
            estado="ABIERTO", 
            autor=autor_dto,
            evidencias=lista_evidencias
        )

    def obtener_todos(self) -> List[ReporteReadDTO]:
        resultados = Reporte.query.all()
        return [self._mapear_a_dto(rep) for rep in resultados]

    def crear_reporte(self, dto: ReporteCreateDTO) -> ReporteReadDTO:
        nuevo_reporte = Reporte(dto)
        db.session.add(nuevo_reporte)
        db.session.commit()
        return self._mapear_a_dto(nuevo_reporte)

    def obtener_por_id(self, id: int) -> ReporteReadDTO:
        rep = Reporte.query.get(id)
        if not rep:
            return None
        return self._mapear_a_dto(rep)
    
    def agregar_evidencia(self, reporte_id: int, archivo, nombre_evidencia: str, tipo_evidencia: str):
        reporte = Reporte.query.get(reporte_id)
        if not reporte:
            return None

        if not archivo or archivo.filename == '':
            raise ValueError("El archivo no tiene nombre")

        # Procesamiento del archivo y nombre único
        filename = secure_filename(archivo.filename)
        # timestamp para evitar colisiones de nombres
        nombre_unico = f"{reporte_id}_{int(datetime.now().timestamp())}_{filename}"
        
        # Validación de seguridad longitud máxima de nombre
        if len(nombre_unico) > 140: 
             ext = filename.rsplit('.', 1)[1].lower() if '.' in filename else ''
             nombre_unico = f"{reporte_id}_{int(datetime.now().timestamp())}_file.{ext}"

        
        upload_folder = current_app.config.get('UPLOAD_FOLDER', 'src/static/uploads')
        os.makedirs(upload_folder, exist_ok=True)
        ruta_fisica = os.path.join(upload_folder, nombre_unico)
        archivo.save(ruta_fisica)

        # Ruta web relativa (para la BD)
        ruta_web = "uploads/" 

        
        nueva_evidencia = Evidencia(
            reporte_id=reporte.id,
            descripcion=nombre_evidencia,  
            tipo=tipo_evidencia,           
            nombre_archivo=nombre_unico,   
            ruta=ruta_web                  
        )

        db.session.add(nueva_evidencia)
        db.session.commit()

        dto = EvidenciaDTO.model_validate(nueva_evidencia)
        # Asignar la URL manualmente para que el frontend la reciba
        dto.url_acceso = f"/static/uploads/{nombre_unico}"
        
        return dto
    
    @staticmethod
    def obtener_areas():
        areas = Area.query.all()
        return [{"id": a.id, "nombre": a.nombre} for a in areas]

    @staticmethod
    def obtener_lugares():
        lugares = Lugar.query.all()
        return [{"id": l.id, "nombre": l.nombre} for l in lugares]

    @staticmethod
    def obtener_empleados(area_id=None):
        query = Usuario.query.join(Empleado).join(Cargo)
        
        if area_id:
            query = query.filter(Cargo.area_id == area_id)
            
        usuarios = query.all()
        
        resultado = []
        for u in usuarios:
            if u.empleado: 
                resultado.append({
                    "id": u.id, 
                    "nombre_completo": f"{u.empleado.nombre_completo} ({u.cargo.nombre})"
                })
        return resultado