from flask import Blueprint, jsonify, request
from flask_jwt_extended import jwt_required
from src.services.gestion_service import GestionService
from src.schemas.gestion_dto import PropuestaCreateDTO
from pydantic import ValidationError

gestion_bp = Blueprint('gestion_api', __name__)
servicio = GestionService()

@gestion_bp.route('/propuestas', methods=['POST'])
@jwt_required()
def crear_propuesta():
    try:
        data = request.json
        # Validamos entrada
        dto = PropuestaCreateDTO(**data)
        
        # Ejecutamos lógica
        resultado = servicio.crear_propuesta(dto)
        
        return jsonify(resultado.model_dump()), 201
        
    except ValueError as e:
        return jsonify({'error': str(e)}), 404
    except ValidationError as e:
        return jsonify(e.errors()), 400
    except Exception as e:
        print(f"Error interno: {e}")
        return jsonify({'error': 'Error interno del servidor'}), 500