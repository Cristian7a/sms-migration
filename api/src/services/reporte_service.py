from typing import List
from src.extensions import db
from src.models.rep_model import Rep
from src.schemas.reporte_dto import ReporteReadDTO, ReporteCreateDTO
from src.schemas.common_dto import Estado
from src.schemas.usuario_dto import UsuarioDTO
# CORRECCIÓN 1: Importamos la interfaz con el nombre correcto
from src.domain.contract import IReporteRepository  

class ReporteService(IReporteRepository):
    
    def _mapear_a_dto(self, modelo_db: Rep) -> ReporteReadDTO:
        """Función privada para convertir de BD a DTO"""
        
        # CORRECCIÓN 2: Usamos 'fecha_completa' en lugar de 'FECREP' (que no existe)
        fecha_creacion_real = modelo_db.fecha_completa 
        
        # Manejo de seguridad por si la fecha es nula
        if not fecha_creacion_real:
            # Fallback o fecha actual si la BD tiene datos corruptos
            from datetime import datetime
            fecha_creacion_real = datetime.now()

        return ReporteReadDTO(
            id=modelo_db.id,  # Usamos .id (propiedad del modelo) en vez de .IDEREP
            titulo=modelo_db.titulo, # Usamos .titulo mapeado
            fecha_creacion=fecha_creacion_real, 
            fecha_evento=fecha_creacion_real.date(), # Usamos la fecha calculada (o FECEVE si existiera separada)
            lugar=f"Lugar ID {modelo_db.lugar_id}", 
            descripcion=modelo_db.descripcion,
            estado=Estado.ABIERTO, 
            autor=UsuarioDTO( 
                id=modelo_db.usuario_id if modelo_db.usuario_id else 0, 
                nombre_completo="Usuario Legacy", 
                email="usuario@test.com", # Valor dummy requerido por DTO
                cargo="Desconocido",
                rol_sistema="USER",
                es_activo=True
            )
        )

    def obtener_todos(self) -> List[ReporteReadDTO]:
        resultados = Rep.query.all()
        return [self._mapear_a_dto(rep) for rep in resultados]

    def crear_reporte(self, datos: ReporteCreateDTO) -> ReporteReadDTO:
        # CORRECCIÓN 3: Usamos el constructor __init__ definido en rep_model.py
        # def __init__(self, titulo, descripcion, usuario_id, lugar_id=1, estatus_id=1):
        nuevo_rep = Rep(
            titulo=datos.titulo,
            descripcion=datos.descripcion,
            usuario_id=datos.autor_id,
            lugar_id=datos.lugar_id
            # El modelo se encarga de llenar anio, mes, dia, hora automáticamente
        )
        
        db.session.add(nuevo_rep)
        db.session.commit()
        
        return self._mapear_a_dto(nuevo_rep)

    def obtener_por_id(self, id: int) -> ReporteReadDTO:
        rep = Rep.query.get(id)
        if not rep:
            return None
        return self._mapear_a_dto(rep)