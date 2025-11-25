# api/run.py (Ahora en la raíz de 'api')
from src import create_app 
# CORRECCIÓN: nombre del archivo 'reportes_route' (singular) según tus archivos subidos
from src.routes.reportes_route import reportes_bp 

app = create_app()

# Registramos el Blueprint
# Nota: url_prefix define la base, así que las rutas serán /api/v1/reportes/
app.register_blueprint(reportes_bp, url_prefix='/api/v1/reportes')

if __name__ == "__main__":
    app.run(debug=True)