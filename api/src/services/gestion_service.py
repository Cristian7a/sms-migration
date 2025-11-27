from src.extensions import db
from src.models.rep_model import Reporte
from src.models.gestion_model import Peligro, Riesgo, Propuesta
from src.schemas.gestion_dto import PropuestaCreateDTO, PropuestaResponseDTO, PeligroUpdateDTO, PeligroResponseDTO, RiesgoCreateDTO
from sqlalchemy import text
from datetime import date

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
    

    def actualizar_peligro(self, datos: PeligroUpdateDTO, nombre_gestor: str):
        # 1. Buscar o Crear Peligro
        peligro = Peligro.query.get(datos.reporte_id)
        
        if not peligro:
            peligro = Peligro(reporte_id=datos.reporte_id)
            db.session.add(peligro)
        
        # 2. Actualizar datos
        peligro.consecuencia = datos.condicion # Mapeado a CONPEL
        peligro.objetivo = datos.objeto
        peligro.actividad = datos.actividad
        peligro.categoria = datos.categoria
        peligro.metodo = datos.metodo
        peligro.riesgo_operacional = datos.riesgo_operacional
        peligro.generador = datos.generador
        peligro.gestor = nombre_gestor
        peligro.fecha = date.today()

        # 3. Verificar tabla MON (Legacy compatibility)
        # En tu SQL, MON tiene FK PELMON -> PEL.REPPEL
        # Si usas SQLAlchemy raw o añades el modelo MonitoreoGeneral, úsalo aquí.
        # Por ahora usaremos SQL raw para no romper si no has creado el modelo MON.
        sql_check = text("SELECT PELMON FROM MON WHERE PELMON = :id")
        result = db.session.execute(sql_check, {'id': datos.reporte_id}).fetchone()
        
        if not result:
            sql_insert = text("INSERT INTO MON (PELMON, MSMMON, PSMMON, PSOMON, DIFMON, MITMON, ESTMON) VALUES (:id, '', '', '', '', '', 'ABIERTO')")
            db.session.execute(sql_insert, {'id': datos.reporte_id})

        db.session.commit()
        return {"mensaje": "Gestión guardada correctamente"}
    
    def obtener_peligro(self, reporte_id: int) -> PeligroResponseDTO:
        peligro = Peligro.query.get(reporte_id)
        if not peligro:
            return None
        
        # Mapeo manual si los nombres de atributos difieren o usar model_validate si son iguales
        return PeligroResponseDTO(
            reporte_id=peligro.reporte_id,
            condicion=peligro.consecuencia, # Ojo con tu mapeo en el modelo
            objeto=peligro.objetivo,
            actividad=peligro.actividad,
            categoria=peligro.categoria,
            metodo=peligro.metodo,
            riesgo_operacional=peligro.riesgo_operacional,
            generador=peligro.generador
        )
    
    def crear_riesgo(self, datos: RiesgoCreateDTO):
        # Crear la instancia del modelo Riesgo
        # Nota: En tu modelo Riesgo (gestion_model.py), los campos tienen nombres específicos
        nuevo_riesgo = Riesgo(
            peligro_id=datos.reporte_id, # PELRIE
            cesp=datos.componente,       # CESPRIE
            descripcion=datos.descripcion, # DESRIE
            consecuencia=datos.consecuencia, # CONRIE
            probabilidad=datos.probabilidad, # PROBRIE
            gravedad=datos.gravedad      # GRARIE
        )
        
        db.session.add(nuevo_riesgo)
        db.session.commit()
        
        return {"mensaje": "Riesgo creado correctamente", "id": nuevo_riesgo.id}