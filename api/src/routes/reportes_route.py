from flask import Blueprint, jsonify, request
from src.services.reporte_service import ReporteService
from src.schemas.reporte_dto import ReporteCreateDTO
from flask_jwt_extended import jwt_required
from pydantic import ValidationError

reportes_bp = Blueprint('reportes_api_bp', __name__) 
servicio = ReporteService()

@reportes_bp.route('/<int:id>/evidencias', methods=['POST'])
# @jwt_required() # Descomenta si ya tienes el token en el frontend
def upload_evidence(id):
    if 'archivo' not in request.files:
        return jsonify({'error': 'Falta el archivo'}), 400
        
    archivo = request.files['archivo']
    # campos que antes enviaba tu formulario PHP
    nombre = request.form.get('nom', 'ADICIONAL') # NOMEVI
    tipo = request.form.get('tip', 'DOCUMENTAL')  # TIPEVI

    try:
        # Llamamos al servicio con los nuevos parámetros
        resultado = servicio.agregar_evidencia(id, archivo, nombre, tipo)
        
        if not resultado:
            return jsonify({'error': 'Reporte no encontrado'}), 404
            
        return jsonify(resultado.model_dump()), 201
        
    except ValueError as e:
        return jsonify({'error': str(e)}), 400
    except Exception as e:
        print(f"Error interno: {e}")
        return jsonify({'error': 'Error al procesar evidencia'}), 500

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