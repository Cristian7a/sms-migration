from src.extensions import db
from datetime import datetime, date, time
from typing import Optional


# Tabla 'rep'
class Reporte(db.Model):
    __tablename__ = 'rep' 

    id = db.Column('IDEREP', db.Integer, primary_key=True)
    folio = db.Column('CONREP', db.SmallInteger, nullable=False, default=0) 
    fecha_evento_db = db.Column('FECEVE', db.Date, nullable=False)
    fecha_creacion_db = db.Column('FECREP', db.DateTime, nullable=False)
    frecuencia = db.Column('FREREP', db.String(25), nullable=False)
    observaciones = db.Column('OBSREP', db.String(300), nullable=True)
    lugar_id = db.Column('LUGREP', db.Integer, nullable=False)
    usuario_id = db.Column('PERREP', db.Integer, nullable=False)
    campo_can = db.Column('CANREP', db.SmallInteger, nullable=False, default=0)
    evidencias = db.relationship('Evidencia', backref='reporte', lazy=True)

    def __init__(self, dto):
        self.observaciones = dto.descripcion
        self.fecha_evento_db = dto.fecha_evento
        self.fecha_creacion_db = dto.fecha_reporte 
        self.lugar_id = dto.lugar_id
        self.usuario_id = dto.autor_id
        self.folio = dto.confidencial
        self.frecuencia = dto.frecuencia
        self.campo_can = 0    

# --- Tabla 'coo' (Áreas/Coordinaciones) ---
class Area(db.Model):
    __tablename__ = 'coo' 
    id = db.Column('IDECOO', db.String(3), primary_key=True) 
    nombre = db.Column('NOMCOO', db.String(40))

# --- Tabla 'lug' (Lugares) ---
class Lugar(db.Model):
    __tablename__ = 'lug'
    id = db.Column('IDELUG', db.Integer, primary_key=True)
    nombre = db.Column('NOMLUG', db.Text)