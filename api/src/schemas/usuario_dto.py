from pydantic import BaseModel, EmailStr
from typing import Optional

class UsuarioDTO(BaseModel):
    id: int
    nombre_completo: str  # Mapeado de NOMEMP + APPEMP + APMEMP
    email: EmailStr       # Mapeado de EMAEMP
    cargo: str            # Mapeado de NOMCAR
    rol_sistema: str      # Mapeado de NOMPRI
    es_activo: bool

    class Config:
        from_attributes = True # Permite convertir desde objetos ORM/SQL fácilmente