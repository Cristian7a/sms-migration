from pydantic import BaseModel
from enum import Enum

class Estado(str, Enum):
    ABIERTO = "ABIERTO"
    CERRADO = "CERRADO"
    PENDIENTE = "PENDIENTE"

# Base para respuestas estándar de la API
class RespuestaBase(BaseModel):
    mensaje: str
    exito: bool