from src.extensions import db
from datetime import datetime, date, time
from typing import Optional

class Reporte(db.Model):
    # 1. Vinculación con la tabla real
    __tablename__ = 'rep' 

    # 2. Mapeo 
    
    # IDEREP es la PK
    id = db.Column('IDEREP', db.Integer, primary_key=True)
    
    # CONREP (Confidencialidad) - tinyint(1) en SQL, mapeado a entero
    # Lo usamos para almacenar un valor por defecto (0)
    folio = db.Column('CONREP', db.SmallInteger, nullable=False, default=0) 
    
    # Fechas
    fecha_evento_db = db.Column('FECEVE', db.Date, nullable=False)        # Fecha del Suceso
    fecha_creacion_db = db.Column('FECREP', db.DateTime, nullable=False)  # Fecha del Reporte/Creación
    
    # Contenido (Mapeando el DTO a los campos disponibles)
    frecuencia = db.Column('FREREP', db.String(25), nullable=False, default='S/D') 
    # Usamos OBSREP para guardar el Título y la Descripción
    observaciones = db.Column('OBSREP', db.String(300), nullable=True, default='') 
    
    # Llaves Foráneas (Foreign Keys)
    lugar_id = db.Column('LUGREP', db.Integer, nullable=False) # FK a tabla 'lug'
    usuario_id = db.Column('PERREP', db.Integer, nullable=False) # FK a tabla 'per' (usuarios)
    
    # CANREP - Mapeado a entero con default
    campo_can = db.Column('CANREP', db.SmallInteger, nullable=False, default=0) 
    # Relación One-to-Many: Un reporte tiene muchas evidencias.
    evidencias = db.relationship('Evidencia', backref='reporte', lazy=True) 

    # 3. Constructor Abstrae el DTO y lo mapea a los campos limitados de la BD
    def __init__(self, titulo: str, descripcion: str, usuario_id: int, lugar_id: int):
        # Mapeo de datos del DTO (ReporteCreateDTO)
        self.usuario_id = usuario_id
        self.lugar_id = lugar_id
        # La fecha de evento viene del DTO
        self.fecha_evento_db = date.today() 
        
        # Mapeo forzado de DTO a campo legacy Título y Descripción van juntos
        self.observaciones = f"Título: {titulo} | Descripción: {descripcion}"
        
        # Valores automáticos y por defecto para campos NOT NULL
        ahora = datetime.now()
        self.fecha_creacion_db = ahora  # FECREP
        self.folio = 0                  # CONREP (Confidencialidad: 0 = No)
        self.frecuencia = "S/D"         # FREREP
        self.campo_can = 0              # CANREP


    # 4. Propiedad Virtual para leer la fecha fácilmente en Python
    @property
    def fecha_completa(self) -> Optional[datetime]:
        """Devuelve la fecha/hora de creación (FECREP) para el DTO."""
        return self.fecha_creacion_db

    # 5. Convertir a diccionario (Para Service Encapsulation)
    def to_dict(self):
        return {
            'id': self.id,
            'folio': self.folio,
            'observaciones_combinadas': self.observaciones, 
            'fecha': self.fecha_completa.strftime('%Y-%m-%d %H:%M') if self.fecha_completa else 'N/A',
            'usuario_id': self.usuario_id,
            'lugar_id': self.lugar_id
        }

    def __repr__(self):
        return f"<Reporte {self.id} - {self.observaciones[:20]}>"