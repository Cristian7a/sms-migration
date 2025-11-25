from src.extensions import db
from datetime import datetime, time

class Reporte(db.Model):
    # 1. Vinculación con la tabla real del .sql
    __tablename__ = 'rep' 

    # 2. Mapeo exacto de columnas (Nombre Python = db.Column('NOMBRE_SQL', ...))
    
    # Identificadores
    id = db.Column('IDEREP', db.Integer, primary_key=True)
    folio = db.Column('CONREP', db.String(10), nullable=False, default='')
    consecutivo = db.Column('CONSEC', db.Integer, nullable=False, default=0)
    referencia = db.Column('REFREP', db.String(25), nullable=False, default='')

    # Fechas (La BD las guarda separadas, aquí las mapeamos tal cual)
    anio = db.Column('ANOREP', db.Integer, nullable=False)
    mes = db.Column('MESREP', db.Integer, nullable=False)
    dia = db.Column('DIAREP', db.Integer, nullable=False)
    hora = db.Column('HORREP', db.Time, nullable=False)

    # Contenido del Reporte
    titulo = db.Column('TITREP', db.Text, nullable=False)
    descripcion = db.Column('DESREP', db.Text, nullable=False)
    observaciones = db.Column('OBSREP', db.Text, nullable=False, default='')
    acciones = db.Column('ACCREP', db.Text, nullable=False, default='')
    comentario = db.Column('COMREP', db.Text, nullable=False, default='')
    obra = db.Column('OBRREP', db.Text, nullable=False, default='')

    # Relaciones / Llaves Foráneas (Foreign Keys)
    # Nota: En el SQL original son enteros.
    lugar_id = db.Column('LUGREP', db.Integer, nullable=False) # FK a tabla 'lug'
    usuario_id = db.Column('SOLREP', db.Integer, nullable=True) # FK a tabla 'per' (usuarios)
    estatus_id = db.Column('ESTREP', db.Integer, nullable=False, default=1) # FK a tabla 'est'
    
    # Otros campos detectados en el SQL
    tipo = db.Column('TIPREP', db.String(12), nullable=False, default='General')
    notificacion = db.Column('NOTREP', db.Integer, nullable=False, default=0)
    equipo_id = db.Column('EQUIPO', db.Integer, nullable=True)
    herramienta_id = db.Column('HERRAMIENTA', db.Integer, nullable=True)
    localizacion = db.Column('LOCREP', db.String(50), nullable=True)
    turno = db.Column('TURREP', db.String(15), nullable=True)
    area = db.Column('AREAREP', db.String(25), nullable=True)
    puesto = db.Column('PUESTOREP', db.String(25), nullable=True)

    # 3. Constructor: Abstrae la complejidad de la fecha
    def __init__(self, titulo, descripcion, usuario_id, lugar_id=1, estatus_id=1):
        self.titulo = titulo
        self.descripcion = descripcion
        self.usuario_id = usuario_id
        self.lugar_id = lugar_id
        self.estatus_id = estatus_id
        
        # Lógica automática para llenar los campos de fecha separados
        ahora = datetime.now()
        self.anio = ahora.year
        self.mes = ahora.month
        self.dia = ahora.day
        self.hora = ahora.time()
        
        # Valores por defecto para campos NOT NULL obligatorios en tu BD vieja
        self.folio = f"F-{int(ahora.timestamp())}" # Generar un folio temporal
        self.consecutivo = 0
        self.referencia = "S/R"
        self.observaciones = ""
        self.acciones = ""
        self.comentario = ""
        self.obra = ""
        self.tipo = "Incidencia"
        self.notificacion = 0

    # 4. Propiedad Virtual para leer la fecha fácilmente en Python
    @property
    def fecha_completa(self):
        try:
            return datetime(self.anio, self.mes, self.dia, self.hora.hour, self.hora.minute)
        except:
            return None

    # 5. Convertir a JSON (Para Service Encapsulation)
    def to_dict(self):
        return {
            'id': self.id,
            'folio': self.folio,
            'titulo': self.titulo,
            'descripcion': self.descripcion,
            'estatus_id': self.estatus_id,
            'fecha': self.fecha_completa.strftime('%Y-%m-%d %H:%M') if self.fecha_completa else 'N/A',
            'usuario_id': self.usuario_id,
            'lugar_id': self.lugar_id
        }

    def __repr__(self):
        return f"<Reporte {self.id} - {self.titulo}>"