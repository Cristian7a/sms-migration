from pydantic import BaseModel
from typing import Optional
from datetime import date

# DTO para iniciar el monitoreo
class MonitoreoCreateDTO(BaseModel):
    propuesta_id: int
    medida_inicial: str

# DTO para actualizar pasos del ciclo (Planear, Verificar, etc.)
class CicloUpdateDTO(BaseModel):
    monitoreo_id: int
    etapa: str # Valores: "PLANEAR", "VERIFICAR", "ACTUAR"
    contenido: str
    porcentaje_avance: Optional[int] = None

class MonitoreoResponseDTO(BaseModel):
    id: int
    estatus: str
    porcentaje: int
    ciclo_id: Optional[int] = None
    
    class Config:
        from_attributes = True