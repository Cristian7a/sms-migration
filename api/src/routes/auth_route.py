from flask import Blueprint, jsonify, request
from src.services.auth_service import AuthService
from src.schemas.usuario_dto import LoginDTO
from pydantic import ValidationError

auth_bp = Blueprint('auth', __name__)
servicio = AuthService()

@auth_bp.route('/login', methods=['POST'])
def login():
    try:
        datos_entrada = LoginDTO(**request.json)
        
        # El servicio ahora devuelve un UsuarioDTO
        usuario_logueado = servicio.login(datos_entrada)
        
        if not usuario_logueado:
            return jsonify({"error": "Credenciales inválidas"}), 401
            
        return jsonify(usuario_logueado.model_dump()), 200
        
    except ValidationError as e:
        return jsonify(e.errors()), 400
    except Exception as e:
        print(e)
        return jsonify({"error": "Error interno del servidor"}), 500