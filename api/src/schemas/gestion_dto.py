from pydantic import BaseModel
from typing import Optional
from datetime import date

class PropuestaCreateDTO(BaseModel):
    riesgo_id: int 
    descripcion: str
    responsable_id: Optional[int] = None
    fecha_limite: Optional[date] = None


class ResponsableUpdateDTO(BaseModel):
    propuesta_id: int
    responsable_id: int

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
    reporte_id: int  
    componente: str  
    descripcion: str 
    consecuencia: str 
    probabilidad: int 
    gravedad: str    

class ResponsableEjecucionCreateDTO(BaseModel):
    propuesta_id: int
    empleado_id: int
    fecha_limite: date