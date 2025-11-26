from src.extensions import db

# 1. Tabla de Empleados (Datos personales)
class Empleado(db.Model):
    __tablename__ = 'emp'
    id = db.Column('IDEEMP', db.Integer, primary_key=True)
    nombre = db.Column('NOMEMP', db.String(25))
    apellido_p = db.Column('APPEMP', db.String(20))
    apellido_m = db.Column('APMEMP', db.String(20))
    email = db.Column('EMAEMP', db.String(50))
    
    # Propiedad para obtener nombre completo fácil
    @property
    def nombre_completo(self):
        return f"{self.nombre} {self.apellido_p} {self.apellido_m}".strip()

# 2. Tabla de Cargos (Puestos)
class Cargo(db.Model):
    __tablename__ = 'car'
    id = db.Column('IDECAR', db.Integer, primary_key=True)
    nombre = db.Column('NOMCAR', db.String(40))

# 3. Tabla de Roles/Privilegios
class Rol(db.Model):
    __tablename__ = 'pri'
    id = db.Column('IDEPRI', db.Integer, primary_key=True)
    nombre = db.Column('NOMPRI', db.String(25))

# 4. Tabla de Sesión (Contraseñas y Rol)
class Sesion(db.Model):
    __tablename__ = 'ses'
    id = db.Column('IDESES', db.Integer, db.ForeignKey('per.IDEPER'), primary_key=True)
    password = db.Column('PASSES', db.String(20))
    rol_id = db.Column('PRISES', db.Integer, db.ForeignKey('pri.IDEPRI'))
    
    # Relación con Rol
    rol = db.relationship('Rol', uselist=False)

# 5. Tabla Principal de Usuario (Permisos/Relación)
# Esta es la tabla central 'per' que une todo.
class Usuario(db.Model):
    __tablename__ = 'per'
    id = db.Column('IDEPER', db.Integer, primary_key=True)
    empleado_id = db.Column('EMPPER', db.Integer, db.ForeignKey('emp.IDEEMP'))
    cargo_id = db.Column('CARPER', db.Integer, db.ForeignKey('car.IDECAR'))
    
    # Relaciones (Joins automáticos de SQLAlchemy)
    empleado = db.relationship('Empleado', uselist=False)
    cargo = db.relationship('Cargo', uselist=False)
    sesion = db.relationship('Sesion', uselist=False) # Acceso a password y rol