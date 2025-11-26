from src.extensions import db
from src.models.rep_model import Reporte
from src.models.gestion_model import Peligro, Riesgo, Propuesta
from src.schemas.gestion_dto import PropuestaCreateDTO, PropuestaResponseDTO

class GestionService:
    
    def crear_propuesta(self, datos: PropuestaCreateDTO) -> PropuestaResponseDTO:
        """
        Crea una propuesta vinculada a un reporte.
        Si no existe la cadena Peligro->Riesgo, la crea automáticamente.
        """
        # 1. Verificar Reporte
        reporte = Reporte.query.get(datos.reporte_id)
        if not reporte:
            raise ValueError("Reporte no encontrado")

        # 2. Obtener o Crear Peligro (Relación 1 a 1)
        peligro = Peligro.query.get(reporte.id)
        if not peligro:
            peligro = Peligro(
                reporte_id=reporte.id,
                objetivo="Investigación Automática",
                actividad="Gestión SMS"
            )
            db.session.add(peligro)
            db.session.flush() # Para asegurar que exista antes de usarlo

        # 3. Obtener o Crear un Riesgo "General" para enlazar la propuesta
        # Buscamos si ya hay algún riesgo asociado, si no, creamos uno genérico
        riesgo = Riesgo.query.filter_by(peligro_id=peligro.reporte_id).first()
        if not riesgo:
            riesgo = Riesgo(
                peligro_id=peligro.reporte_id,
                descripcion="Riesgo General Detectado",
                probabilidad=1,
                gravedad="D"
            )
            db.session.add(riesgo)
            db.session.flush()

        # 4. Crear la Propuesta
        nueva_propuesta = Propuesta(
            descripcion=datos.descripcion,
            riesgo_id=riesgo.id,
            responsable_id=datos.responsable_id,
            fecha_fin=datos.fecha_limite,
            prioridad="ALTA",
            estado="ABIERTO"
        )

        db.session.add(nueva_propuesta)
        db.session.commit()

        return PropuestaResponseDTO.model_validate(nueva_propuesta)