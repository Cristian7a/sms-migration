# api/src/run.py
from src import create_app # Asumiendo que tu __init__.py tiene un create_app
from src.routes.reportes_routes import reportes_bp

app = create_app()

# Registramos las rutas nuevas
app.register_blueprint(reportes_bp, url_prefix='/api/v1/reportes')

if __name__ == "__main__":
    app.run(debug=True)