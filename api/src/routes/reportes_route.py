from flask import Blueprint, jsonify, request
from src.services.reporte_service import ReporteService
from src.schemas.reporte_dto import ReporteCreateDTO
from pydantic import ValidationError

reportes_bp = Blueprint('reportes', __name__)
servicio = ReporteService() # Instanciamos el servicio

@reportes_bp.route('/', methods=['GET'])
def index():
    # El servicio nos devuelve DATOS LIMPIOS directamente
    reportes = servicio.obtener_todos()
    
    # Convertimos los objetos Pydantic a diccionarios para JSON
    return jsonify([r.model_dump() for r in reportes])

@reportes_bp.route('/', methods=['POST'])
def store():
    try:
        # Patrón 4: Validamos el contrato de entrada
        dto_entrada = ReporteCreateDTO(**request.json)
        
        # Llamamos al servicio
        resultado = servicio.crear_reporte(dto_entrada)
        
        return jsonify(resultado.model_dump()), 201
    except ValidationError as e:
        return jsonify(e.errors()), 400