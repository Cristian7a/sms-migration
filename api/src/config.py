import os
from dotenv import load_dotenv

basedir = os.path.abspath(os.path.dirname(__file__))

#    api/src -> api -> sms-migration
root_path = os.path.join(basedir, '..', '..') 

load_dotenv(os.path.join(root_path, '.env'))

class Config:
    SECRET_KEY = os.getenv('SECRET_KEY', 'default_secret')
    SQLALCHEMY_DATABASE_URI = os.getenv('DATABASE_URL')
    SQLALCHEMY_TRACK_MODIFICATIONS = False