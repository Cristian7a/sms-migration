from flask import Blueprint, jsonify, request
from src.services.reporte_service import ReporteService
from src.schemas.reporte_dto import ReporteCreateDTO
from flask_jwt_extended import jwt_required
from pydantic import ValidationError

reportes_bp = Blueprint('reportes_api_bp', __name__) 
servicio = ReporteService()

@reportes_bp.route('/<int:id>/evidencias', methods=['POST'])
@jwt_required()
def upload_evidence(id):
    """
    Sube una evidencia para un reporte específico.
    Uso: Form-Data con key 'archivo' y opcional 'descripcion'.
    """
    if 'archivo' not in request.files:
        return jsonify({'error': 'No se envió la parte del archivo'}), 400
        
    archivo = request.files['archivo']
    descripcion = request.form.get('descripcion', '')

    try:
        resultado = servicio.agregar_evidencia(id, archivo, descripcion)
        
        if not resultado:
            return jsonify({'error': 'Reporte no encontrado'}), 404
            
        return jsonify(resultado.model_dump()), 201
        
    except ValueError as e:
        return jsonify({'error': str(e)}), 400
    except Exception as e:
        print(f"Error subiendo archivo: {e}")
        return jsonify({'error': 'Error interno al procesar archivo'}), 500


@reportes_bp.route('', methods=['GET'])
def index():
    reportes = servicio.obtener_todos()
    
    # Convertimos los objetos Pydantic a diccionarios para JSON
    return jsonify([r.model_dump() for r in reportes])

@reportes_bp.route('', methods=['POST'])
def store():
    try:
        # Patrón 4: Validamos el contrato de entrada
        dto_entrada = ReporteCreateDTO(**request.json)
        
        # Llamamos al servicio
        resultado = servicio.crear_reporte(dto_entrada)
        
        return jsonify(resultado.model_dump()), 201
    except ValidationError as e:
        return jsonify(e.errors()), 400
    
@reportes_bp.route('/<int:id>', methods=['GET'])
def show(id):
    reporte = servicio.obtener_por_id(id)
    if not reporte:
        return jsonify({'error': 'Reporte no encontrado'}), 404
    return jsonify(reporte.model_dump())

@reportes_bp.route('/catalogos/areas', methods=['GET'])
def get_areas():
    data = ReporteService.obtener_areas()
    return jsonify({'status': 'success', 'data': data}), 200

@reportes_bp.route('/catalogos/lugares', methods=['GET'])
def get_lugares():
    data = ReporteService.obtener_lugares()
    return jsonify({'status': 'success', 'data': data}), 200

@reportes_bp.route('/catalogos/empleados', methods=['GET'])
def get_empleados():
    data = ReporteService.obtener_empleados()
    return jsonify({'status': 'success', 'data': data}), 200