from abc import ABC, abstractmethod
from typing import List
from ..schemas.reporte_dto import ReporteReadDTO, ReporteCreateDTO

# --- CENTRALIZACIÓN DEL CONTRATO ---
# Cualquier servicio de reportes (sea Legacy, Nuevo, o Mock) debe obedecer esto.

class IReporteRepository(ABC):
    
    @abstractmethod
    def obtener_todos(self) -> List[ReporteReadDTO]:
        """
        Contrato: Debe devolver una lista de objetos ReporteReadDTO limpios.
        No se permiten diccionarios crudos ni tuplas SQL.
        """
        pass

    @abstractmethod
    def obtener_por_id(self, id: int) -> ReporteReadDTO:
        """
        Contrato: Busca por ID y devuelve el esquema canónico.
        Si no existe, debe lanzar una excepción de dominio, no de BD.
        """
        pass

    @abstractmethod
    def crear_reporte(self, datos: ReporteCreateDTO) -> ReporteReadDTO:
        """
        Contrato: Recibe datos limpios de creación y devuelve el objeto creado.
        """
        pass