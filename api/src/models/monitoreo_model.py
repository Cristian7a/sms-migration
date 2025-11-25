from src.extensions import db
from datetime import date

# 1. Monitoreo de la Propuesta (Tabla 'monpro')
class MonitoreoPropuesta(db.Model):
    __tablename__ = 'monpro'

    # La PK es MONPRO, pero también es FK hacia la tabla 'pro' (Relación 1 a 1)
    id = db.Column('MONPRO', db.Integer, db.ForeignKey('pro.IDEPRO'), primary_key=True)
    
    medida = db.Column('MEDMON', db.String(254), default="Medida Estándar")
    fecha = db.Column('FECMON', db.Date, default=date.today)
    estatus = db.Column('ESTMON', db.String(40), default="EN PROCESO")
    porcentaje = db.Column('POREST', db.Integer, default=0)
    descripcion_estatus = db.Column('DESEST', db.Text, default="")

    # Relación con el Ciclo PHVA
    ciclo = db.relationship('Ciclo', backref='monitoreo', uselist=False, lazy=True)

# 2. Ciclo PHVA (Tabla 'cic')
class Ciclo(db.Model):
    __tablename__ = 'cic'

    id = db.Column('IDECIC', db.Integer, primary_key=True)
    monitoreo_id = db.Column('MONCIC', db.Integer, db.ForeignKey('monpro.MONPRO'), nullable=False)
    
    # Etapas del Ciclo (Planear, Hacer, Verificar, Actuar)
    causa = db.Column('CAUCIC', db.Text, default="")    # Análisis de Causa
    objetivo = db.Column('OBJCIC', db.Text, default="") # Objetivo
    plan = db.Column('PLACIC', db.Text, default="")     # PLANEAR
    
    # HACER (Se suele mapear a las fechas de ejecución o acciones externas)
    fecha_inicio = db.Column('FECINI', db.Date)
    fecha_entrega = db.Column('FECENT', db.Date)
    
    verificacion = db.Column('VERCIC', db.Text, default="") # VERIFICAR
    actuacion = db.Column('ACTCIC', db.Text, default="")    # ACTUAR
    
    logro = db.Column('LOGCIC', db.String(2), default="0%") # Porcentaje de logro