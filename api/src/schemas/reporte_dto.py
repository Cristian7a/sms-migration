from pydantic import BaseModel
from datetime import date, datetime
from typing import List, Optional
from .usuario_dto import UsuarioDTO

class EvidenciaDTO(BaseModel):
    id: int
    nombre_archivo: str
    tipo: str             
    url_acceso: Optional[str] = None 

    # Esta configuración es OBLIGATORIA para aceptar objetos de SQLAlchemy
    class Config:
        from_attributes = True 

# Modelo para CREAR un reporte
class ReporteCreateDTO(BaseModel):
    titulo: str
    fecha_evento: date
    lugar_id: int
    descripcion: str
    autor_id: int

# Modelo para LEER un reporte
class ReporteReadDTO(BaseModel):
    id: int
    titulo: str
    fecha_creacion: datetime
    fecha_evento: date
    lugar: str
    descripcion: str
    estado: str
    autor: UsuarioDTO
    
    # Lista de evidencias
    evidencias: List[EvidenciaDTO] = []

    class Config:
        from_attributes = True