from src.extensions import db

class Evidencia(db.Model):
    __tablename__ = 'evi'

    # Mapeo exacto
    id = db.Column('IDEEVI', db.Integer, primary_key=True)
    reporte_id = db.Column('REPEVI', db.Integer, db.ForeignKey('rep.IDEREP'), nullable=False)
    
    descripcion = db.Column('NOMEVI', db.String(40)) 
    
    # Nombre físico del archivo (ej: 1_foto.png)
    nombre_archivo = db.Column('FILEVI', db.String(150)) 
    
    # Ruta completa o relativa (ej: src/static/uploads/...)
    ruta = db.Column('RUTEVI', db.String(150))
    
    # Extensión o tipo (ej: png)
    tipo = db.Column('TIPEVI', db.String(11))

    def __repr__(self):
        return f'<Evidencia {self.nombre_archivo}>'