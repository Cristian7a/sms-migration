from src.extensions import db
from datetime import date

# Modelo Peligro (Tabla 'pel')
class Peligro(db.Model):
    __tablename__ = 'pel'

    reporte_id = db.Column('REPPEL', db.Integer, db.ForeignKey('rep.IDEREP'), primary_key=True)
    fecha = db.Column('FECPEL', db.Date, default=date.today)
    
    objetivo = db.Column('OBJPEL', db.String(100), default="Por definir")
    actividad = db.Column('ACTPEL', db.String(100), default="Análisis")
    consecuencia = db.Column('CONPEL', db.String(100), default="Por determinar")
    categoria = db.Column('CATEPEL', db.String(10), default="S/D")
    riesgo_operacional = db.Column('RIEOPEPEL', db.String(2), default="NO")
    generador = db.Column('GENPEL', db.Text, default="")
    metodo = db.Column('METIDEPEL', db.String(10), default="REACTIVO")
    gestor = db.Column('NOMGESPEL', db.String(40), default="") 

    # Relación con Riesgos
    riesgos = db.relationship('Riesgo', backref='peligro', lazy=True)

# Modelo Riesgo (Tabla 'rie')
class Riesgo(db.Model):
    __tablename__ = 'rie'

    id = db.Column('IDERIE', db.Integer, primary_key=True)
    descripcion = db.Column('DESRIE', db.Text, nullable=False)
    peligro_id = db.Column('PELRIE', db.Integer, db.ForeignKey('pel.REPPEL'), nullable=False)
    
    cesp = db.Column('CESPRIE', db.Text, default="S/D")
    consecuencia = db.Column('CONRIE', db.Text, default="S/D")
    probabilidad = db.Column('PROBRIE', db.Integer, default=0)
    gravedad = db.Column('GRARIE', db.String(1), default="E")

    # Relación con Propuestas
    propuestas = db.relationship('Propuesta', backref='riesgo', lazy=True)

# Modelo Propuesta (Tabla 'pro')
class Propuesta(db.Model):
    __tablename__ = 'pro'

    id = db.Column('IDEPRO', db.Integer, primary_key=True)
    descripcion = db.Column('DESPRO', db.Text, nullable=False)
    estado = db.Column('ESTPRO', db.String(50), default='ABIERTO')
    fecha_fin = db.Column('FINPRO', db.Date)
    fecha_notificacion = db.Column('NOTPRO', db.Date)
    
    # Relaciones
    riesgo_id = db.Column('RIEPRO', db.Integer, db.ForeignKey('rie.IDERIE'), nullable=False)
    responsable_id = db.Column('RESPRO', db.Integer, db.ForeignKey('per.IDEPER'), nullable=True)
    
    # Campos obligatorios
    prioridad = db.Column('PRIPRO', db.Text, default="MEDIA")

class Responsable(db.Model):
    __tablename__ = 'res'

    id = db.Column('IDERES', db.Integer, primary_key=True)
    empleado_id = db.Column('EMPRES', db.Integer, db.ForeignKey('per.IDEPER'), nullable=False)
    fecha_notificacion = db.Column('FECNOT', db.Date)
    fecha_limite = db.Column('FECLIM', db.Date)
    propuesta_id = db.Column('PRORES', db.Integer, db.ForeignKey('pro.IDEPRO'), nullable=False)