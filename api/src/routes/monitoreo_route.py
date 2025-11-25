from flask import Blueprint, jsonify, request
from flask_jwt_extended import jwt_required
from src.services.monitoreo_service import MonitoreoService
from src.schemas.monitoreo_dto import MonitoreoCreateDTO, CicloUpdateDTO

monitoreo_bp = Blueprint('monitoreo_api', __name__)
servicio = MonitoreoService()

@monitoreo_bp.route('/iniciar', methods=['POST'])
@jwt_required()
def iniciar():
    try:
        dto = MonitoreoCreateDTO(**request.json)
        resultado = servicio.iniciar_ciclo(dto)
        return jsonify(resultado.model_dump()), 201
    except ValueError as e:
        return jsonify({'error': str(e)}), 400
    except Exception as e:
        print(e)
        return jsonify({'error': 'Error interno'}), 500

@monitoreo_bp.route('/avance', methods=['PUT'])
@jwt_required()
def avance():
    try:
        dto = CicloUpdateDTO(**request.json)
        resultado = servicio.actualizar_etapa(dto)
        return jsonify(resultado), 200
    except ValueError as e:
        return jsonify({'error': str(e)}), 400