from pydantic import BaseModel
from typing import Optional
from datetime import date

class PropuestaCreateDTO(BaseModel):
    reporte_id: int
    descripcion: str
    responsable_id: Optional[int] = None
    fecha_limite: Optional[date] = None

class PropuestaResponseDTO(BaseModel):
    id: int
    descripcion: str
    estado: str
    responsable_id: Optional[int]
    
    class Config:
        from_attributes = True