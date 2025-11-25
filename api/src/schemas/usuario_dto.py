from pydantic import BaseModel
from typing import Optional

# DTO para recibir credenciales de Login
class LoginDTO(BaseModel):
    email: str
    password: str

# DTO unificado ombina Reportes y Auth
class UsuarioDTO(BaseModel):
    id: int
    nombre_completo: str
    email: str
    cargo: str
    # Usamos 'rol_sistema' para mantener compatibilidad con ReporteService
    rol_sistema: str 
    es_activo: bool = True
    
    # Campo opcional para el token (solo se llena al hacer login)
    token: Optional[str] = None 

    class Config:
        from_attributes = True