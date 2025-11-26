from pydantic import BaseModel
from datetime import date, datetime
from typing import List, Optional
from .usuario_dto import UsuarioDTO

class EvidenciaDTO(BaseModel):
    id: int
    nombre_archivo: str
    tipo: str             
    url_acceso: Optional[str] = None 

    class Config:
        from_attributes = True 

# Modelo para CREAR 
class ReporteCreateDTO(BaseModel):
    descripcion: str 
    fecha_evento: date 
    fecha_reporte: date 
    lugar_id: int
    autor_id: int
    confidencial: int 
    frecuencia: str
    area_id: Optional[str] = None 

# Modelo para LEER
class ReporteReadDTO(BaseModel):
    id: int
    fecha_creacion: datetime
    fecha_evento: date
    lugar: str
    descripcion: str
    estado: str
    autor: UsuarioDTO
    evidencias: List[EvidenciaDTO] = []

    class Config:
        from_attributes = True