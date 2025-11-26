from flask import Flask
from flask_cors import CORS
from flask_jwt_extended import JWTManager
from src.config import Config
from src.extensions import db

def create_app():
    app = Flask(__name__)
    app.config.from_object(Config)
    
    # Inicializar extensiones
    CORS(app)
    db.init_app(app)
    JWTManager(app)
    
    # Registrar Blueprints
    from src.routes.reportes_route import reportes_bp
    from src.routes.auth_route import auth_bp 
    from src.routes.gestion_route import gestion_bp
    from src.routes.monitoreo_route import monitoreo_bp
    
    app.register_blueprint(reportes_bp, url_prefix='/api/v1/reportes')
    app.register_blueprint(auth_bp, url_prefix='/api/v1/auth')
    app.register_blueprint(gestion_bp, url_prefix='/api/v1/gestion')
    app.register_blueprint(monitoreo_bp, url_prefix='/api/v1/monitoreo')
    
    return app