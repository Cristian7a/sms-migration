from src.extensions import db
from src.models.gestion_model import Propuesta
from src.models.monitoreo_model import MonitoreoPropuesta, Ciclo
from src.schemas.monitoreo_dto import MonitoreoCreateDTO, MonitoreoResponseDTO, CicloUpdateDTO

class MonitoreoService:
    
    def iniciar_ciclo(self, datos: MonitoreoCreateDTO) -> MonitoreoResponseDTO:
        """Crea el registro en monpro y su ciclo vacío asociado."""
        
        # 1. Verificar que la propuesta exista
        propuesta = Propuesta.query.get(datos.propuesta_id)
        if not propuesta:
            raise ValueError("Propuesta no encontrada")

        # 2. Verificar si ya tiene monitoreo
        existente = MonitoreoPropuesta.query.get(datos.propuesta_id)
        if existente:
            return MonitoreoResponseDTO.model_validate(existente)

        # 3. Crear Monitoreo (Tabla monpro)
        nuevo_mon = MonitoreoPropuesta(
            id=datos.propuesta_id, # Relación 1 a 1 con propuesta
            medida=datos.medida_inicial,
            estatus="EN PROCESO",
            porcentaje=0
        )
        db.session.add(nuevo_mon)
        db.session.flush() # ID disponible

        # 4. Crear Ciclo Vacío (Tabla cic)
        nuevo_ciclo = Ciclo(
            monitoreo_id=nuevo_mon.id,
            causa="Pendiente análisis",
            plan="Pendiente planificación"
        )
        db.session.add(nuevo_ciclo)
        db.session.commit()

        dto = MonitoreoResponseDTO.model_validate(nuevo_mon)
        dto.ciclo_id = nuevo_ciclo.id
        return dto

    def actualizar_etapa(self, datos: CicloUpdateDTO):
        """Actualiza una columna específica del ciclo según la etapa."""
        ciclo = Ciclo.query.filter_by(monitoreo_id=datos.monitoreo_id).first()
        monitoreo = MonitoreoPropuesta.query.get(datos.monitoreo_id)
        
        if not ciclo or not monitoreo:
            raise ValueError("Ciclo de monitoreo no encontrado")

        # Lógica dinámica para saber qué campo actualizar
        etapa = datos.etapa.upper()
        if etapa == "PLANEAR":
            ciclo.plan = datos.contenido
        elif etapa == "VERIFICAR":
            ciclo.verificacion = datos.contenido
        elif etapa == "ACTUAR":
            ciclo.actuacion = datos.contenido
        elif etapa == "CAUSA":
            ciclo.causa = datos.contenido
        else:
            raise ValueError("Etapa inválida (Use: PLANEAR, VERIFICAR, ACTUAR, CAUSA)")

        # Actualizar porcentaje global si se envía
        if datos.porcentaje_avance is not None:
            monitoreo.porcentaje = datos.porcentaje_avance
            if datos.porcentaje_avance == 100:
                monitoreo.estatus = "CERRADO"

        db.session.commit()
        return {"mensaje": f"Etapa {etapa} actualizada correctamente"}