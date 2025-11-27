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

class PeligroUpdateDTO(BaseModel):
    reporte_id: int
    condicion: str
    objeto: str
    actividad: str
    categoria: str
    metodo: str
    riesgo_operacional: str
    generador: str

class PeligroResponseDTO(BaseModel):
    reporte_id: int
    condicion: str
    objeto: str
    actividad: str
    categoria: str
    metodo: str
    riesgo_operacional: str
    generador: str
    
    class Config:
        from_attributes = True

class RiesgoCreateDTO(BaseModel):
    reporte_id: int  # ID del peligro/reporte padre
    componente: str  # CESPRIE
    descripcion: str # DESRIE
    consecuencia: str # CONRIE
    probabilidad: int # PROBRIE
    gravedad: str    # GRARIE