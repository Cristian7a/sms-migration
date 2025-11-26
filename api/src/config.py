import os
from dotenv import load_dotenv

basedir = os.path.abspath(os.path.dirname(__file__))

path_to_env = os.path.join(basedir, '..', '.env')

load_dotenv(path_to_env)

class Config:
    SECRET_KEY = os.getenv('SECRET_KEY', 'default_secret')
    SQLALCHEMY_DATABASE_URI = os.getenv('DATABASE_URL')
    SQLALCHEMY_TRACK_MODIFICATIONS = False

    # NUEVO: Configuración de JWT (Seguridad)
    JWT_SECRET_KEY = os.getenv('JWT_SECRET_KEY', 'super-secret-key-cambiar-en-produccion')
    # Carpeta donde se guardan las fotos
    UPLOAD_FOLDER = os.path.join(os.getcwd(), 'src', 'static', 'uploads')
    ALLOWED_EXTENSIONS = {'png', 'jpg', 'jpeg', 'gif', 'pdf'}