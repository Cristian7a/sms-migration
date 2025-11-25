from src.models.usuario_model import Empleado, Usuario
from src.schemas.usuario_dto import LoginDTO, UsuarioDTO
from flask_jwt_extended import create_access_token

class AuthService:
    
    def login(self, credenciales: LoginDTO) -> UsuarioDTO:
        # 1. Buscar al empleado por Email
        empleado = Empleado.query.filter_by(email=credenciales.email).first()
        
        if not empleado:
            return None 
            
        # 2. Buscar su cuenta de usuario
        usuario_db = Usuario.query.filter_by(empleado_id=empleado.id).first()
        
        if not usuario_db or not usuario_db.sesion:
            return None 
            
        # 3. Validar Contraseña (texto plano según tu legacy)
        if usuario_db.sesion.password != credenciales.password:
            return None 
            
        # 4. Generar Token
        access_token = create_access_token(identity=str(usuario_db.id))
        
        # 5. Construir respuesta usando UsuarioDTO
        return UsuarioDTO(
            id=usuario_db.id,
            nombre_completo=empleado.nombre_completo,
            email=empleado.email,
            cargo=usuario_db.cargo.nombre if usuario_db.cargo else "Sin Cargo",
            rol_sistema=usuario_db.sesion.rol.nombre if usuario_db.sesion.rol else "Usuario",
            es_activo=True,
            token=access_token
        )