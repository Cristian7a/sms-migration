from pydantic import BaseModel
from datetime import date, datetime
from typing import Optional
from .usuario_dto import UsuarioDTO

# Modelo para CREAR un reporte (lo que recibes del Frontend)
class ReporteCreateDTO(BaseModel):
    titulo: str
    fecha_evento: date
    lugar_id: int
    descripcion: str
    autor_id: int

# Modelo para LEER un reporte (lo que envías al Frontend - Canonical Schema completo)
class ReporteReadDTO(BaseModel):
    id: int
    titulo: str
    fecha_creacion: datetime
    fecha_evento: date
    lugar: str             # Nombre del lugar, no el ID
    descripcion: str
    estado: str            # Normalizado (ej: ABIERTO)
    autor: UsuarioDTO      # Objeto anidado completo (¡Gran ventaja del Patrón 1!)

    class Config:
        from_attributes = True