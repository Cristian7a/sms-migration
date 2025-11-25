import os
from dotenv import load_dotenv

basedir = os.path.abspath(os.path.dirname(__file__))

# CORRECCIÓN: Apuntamos a la carpeta 'api' (un nivel arriba de 'src')
# Antes era: os.path.join(basedir, '..', '..')
path_to_env = os.path.join(basedir, '..', '.env')

load_dotenv(path_to_env)

class Config:
    SECRET_KEY = os.getenv('SECRET_KEY', 'default_secret')
    # Si esto sigue siendo None, lanzará el error que ves
    SQLALCHEMY_DATABASE_URI = os.getenv('DATABASE_URL')
    SQLALCHEMY_TRACK_MODIFICATIONS = False