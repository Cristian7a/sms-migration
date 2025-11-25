from typing import List
from src.extensions import db
# CORRECCIÓN CRÍTICA: Importamos 'Reporte' que es como se llama la clase en el modelo, no 'Rep'
from src.models.rep_model import Reporte 
from src.schemas.reporte_dto import ReporteReadDTO, ReporteCreateDTO
from src.schemas.common_dto import Estado
from src.schemas.usuario_dto import UsuarioDTO
from src.domain.contract import IReporteRepository  

class ReporteService(IReporteRepository):
    
    # Actualizamos el type hint a Reporte
    def _mapear_a_dto(self, modelo_db: Reporte) -> ReporteReadDTO:
        """Función privada para convertir de BD a DTO"""
        
        fecha_creacion_real = modelo_db.fecha_completa 
        
        if not fecha_creacion_real:
            from datetime import datetime
            fecha_creacion_real = datetime.now()

        return ReporteReadDTO(
            id=modelo_db.id,
            titulo=modelo_db.titulo,
            fecha_creacion=fecha_creacion_real, 
            fecha_evento=fecha_creacion_real.date(),
            lugar=f"Lugar ID {modelo_db.lugar_id}", 
            descripcion=modelo_db.descripcion,
            estado=Estado.ABIERTO, 
            autor=UsuarioDTO( 
                id=modelo_db.usuario_id if modelo_db.usuario_id else 0, 
                nombre_completo="Usuario Legacy", 
                email="usuario@test.com",
                cargo="Desconocido",
                rol_sistema="USER",
                es_activo=True
            )
        )

    def obtener_todos(self) -> List[ReporteReadDTO]:
        # Usamos Reporte.query en lugar de Rep.query
        resultados = Reporte.query.all()
        return [self._mapear_a_dto(rep) for rep in resultados]

    def crear_reporte(self, datos: ReporteCreateDTO) -> ReporteReadDTO:
        # Instanciamos la clase correcta: Reporte
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
        # Usamos Reporte.query
        rep = Reporte.query.get(id)
        if not rep:
            return None
        return self._mapear_a_dto(rep)