from flask import Flask
from flask_cors import CORS
from .config import Config
from .extensions import db

def create_app():
    # Inicializar Flask
    app = Flask(__name__)
    
    app.config.from_object(Config)
    
    CORS(app) 
    db.init_app(app)
    
    @app.route('/')
    def index():
        return {"status": "API SMS Corriendo", "db": app.config['SQLALCHEMY_DATABASE_URI']}

    return app