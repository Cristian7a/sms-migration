from src.extensions import db
from src.models.rep_model import Reporte
from src.models.gestion_model import Peligro, Riesgo, Propuesta, Responsable
from src.schemas.gestion_dto import PropuestaCreateDTO,  ResponsableEjecucionCreateDTO , ResponsableUpdateDTO, PropuestaResponseDTO, PeligroUpdateDTO, PeligroResponseDTO, RiesgoCreateDTO
from sqlalchemy import text
from datetime import date
from src.models.monitoreo_model import MonitoreoPropuesta

class GestionService:
    
    def crear_propuesta(self, datos: PropuestaCreateDTO) -> PropuestaResponseDTO:
        """
        Crea una propuesta ligada a un riesgo específico e inicializa su monitoreo.
        """
        
        riesgo = Riesgo.query.get(datos.riesgo_id)
        if not riesgo:
            raise ValueError("Riesgo no encontrado")

        
        nueva_propuesta = Propuesta(
            descripcion=datos.descripcion,
            riesgo_id=datos.riesgo_id,
            responsable_id=datos.responsable_id,
            fecha_fin=datos.fecha_limite,
            prioridad="MEDIA", # Default del sistema
            estado="ABIERTO"
        )
        
        db.session.add(nueva_propuesta)
        db.session.flush() # Para obtener el ID de la propuesta (nueva_propuesta.id)

        
        nuevo_monitoreo = MonitoreoPropuesta(
            id=nueva_propuesta.id,
            estatus='NO HAN SIDO IMPLEMENTADAS',
            porcentaje=0,
            descripcion_estatus='',
            medida=''
        )
        db.session.add(nuevo_monitoreo)


        db.session.commit()

        return PropuestaResponseDTO.model_validate(nueva_propuesta)
    

    def actualizar_peligro(self, datos: PeligroUpdateDTO, nombre_gestor: str):
        peligro = Peligro.query.get(datos.reporte_id)
        
        if not peligro:
            peligro = Peligro(reporte_id=datos.reporte_id)
            db.session.add(peligro)
        
        
        peligro.consecuencia = datos.condicion
        peligro.objetivo = datos.objeto
        peligro.actividad = datos.actividad
        peligro.categoria = datos.categoria
        peligro.metodo = datos.metodo
        peligro.riesgo_operacional = datos.riesgo_operacional
        peligro.generador = datos.generador
        peligro.gestor = nombre_gestor
        peligro.fecha = date.today()

        # Forzamos que el INSERT/UPDATE de la tabla PEL viaje a la BD
        # para que la tabla MON pueda encontrar la llave foránea (REPPEL).
        db.session.flush() 
        
        
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
        
        return PeligroResponseDTO(
            reporte_id=peligro.reporte_id,
            condicion=peligro.consecuencia, 
            objeto=peligro.objetivo,
            actividad=peligro.actividad,
            categoria=peligro.categoria,
            metodo=peligro.metodo,
            riesgo_operacional=peligro.riesgo_operacional,
            generador=peligro.generador
        )
    
    def crear_riesgo(self, datos: RiesgoCreateDTO):
        nuevo_riesgo = Riesgo(
            peligro_id=datos.reporte_id, 
            cesp=datos.componente,       
            descripcion=datos.descripcion, 
            consecuencia=datos.consecuencia, 
            probabilidad=datos.probabilidad, 
            gravedad=datos.gravedad      
        )
        
        db.session.add(nuevo_riesgo)
        db.session.commit()
        
        return {"mensaje": "Riesgo creado correctamente", "id": nuevo_riesgo.id}
    

    def asignar_responsable(self, datos: ResponsableUpdateDTO):
        propuesta = Propuesta.query.get(datos.propuesta_id)
        if not propuesta:
            raise ValueError("Propuesta no encontrada")

        propuesta.responsable_id = datos.responsable_id
        propuesta.fecha_notificacion = date.today()

        db.session.commit()
        return {"mensaje": "Responsable asignado correctamente"}
    

    def crear_responsable_ejecucion(self, datos: ResponsableEjecucionCreateDTO):
        """Asigna un empleado para ejecutar la propuesta (Tabla RES)."""
        
        nuevo_resp = Responsable(
            empleado_id=datos.empleado_id,
            propuesta_id=datos.propuesta_id,
            fecha_limite=datos.fecha_limite,
            fecha_notificacion=date.today()
        )
        
        db.session.add(nuevo_resp)
        db.session.commit()
        
        return {"mensaje": "Responsable de ejecución agregado correctamente"}