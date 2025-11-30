from flask import Blueprint, jsonify, request
from src.services.gestion_service import GestionService
from src.schemas.gestion_dto import PropuestaCreateDTO
from pydantic import ValidationError
from src.schemas.gestion_dto import PropuestaCreateDTO, PeligroUpdateDTO, RiesgoCreateDTO, ResponsableUpdateDTO, ResponsableEjecucionCreateDTO
from flask_jwt_extended import get_jwt_identity, jwt_required
from src.models.usuario_model import Usuario


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
    

@gestion_bp.route('/peligros', methods=['PUT'])
@jwt_required()
def guardar_gestion():
    try:
        data = request.json
        dto = PeligroUpdateDTO(**data)
        
        # Obtener nombre del gestor desde el token
        user_id = get_jwt_identity()
        usuario = Usuario.query.get(user_id)
        nombre_gestor = usuario.empleado.nombre_completo if usuario and usuario.empleado else "Sistema"

        resultado = servicio.actualizar_peligro(dto, nombre_gestor)
        return jsonify(resultado), 200
        
    except ValueError as e:
        return jsonify({'error': str(e)}), 400
    except Exception as e:
        print(f"Error interno: {e}")
        return jsonify({'error': 'Error al guardar gestión'}), 500

@gestion_bp.route('/peligros/<int:id>', methods=['GET'])
@jwt_required()
def ver_peligro(id):
    resultado = servicio.obtener_peligro(id)
    if not resultado:
        return jsonify({'error': 'Datos de gestión no encontrados'}), 404
    return jsonify(resultado.model_dump()), 200

@gestion_bp.route('/riesgos', methods=['POST'])
@jwt_required()
def crear_riesgo():
    try:
        data = request.json
        dto = RiesgoCreateDTO(**data)
        resultado = servicio.crear_riesgo(dto)
        return jsonify(resultado), 201
    except ValueError as e:
        return jsonify({'error': str(e)}), 400
    except Exception as e:
        print(f"Error interno: {e}")
        return jsonify({'error': 'Error al crear riesgo'}), 500
    
@gestion_bp.route('/propuestas/responsable', methods=['PUT'])
@jwt_required()
def asignar_responsable():
    try:
        dto = ResponsableUpdateDTO(**request.json)
        resultado = servicio.asignar_responsable(dto)
        return jsonify(resultado), 200
    except ValueError as e:
        return jsonify({'error': str(e)}), 404
    except Exception as e:
        print(f"Error: {e}")
        return jsonify({'error': 'Error al asignar responsable'}), 500
    
@gestion_bp.route('/responsables', methods=['POST'])
@jwt_required()
def agregar_ejecutor():
    try:
        dto = ResponsableEjecucionCreateDTO(**request.json)
        resultado = servicio.crear_responsable_ejecucion(dto)
        return jsonify(resultado), 201
    except ValueError as e:
        return jsonify({'error': str(e)}), 400
    except Exception as e:
        print(f"Error: {e}")
        return jsonify({'error': 'Error al asignar ejecutor'}), 500