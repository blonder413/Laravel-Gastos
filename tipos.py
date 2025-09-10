"""
Procesar los tipos de dispositivos de easygo y yeli y unirlos en una sola tabla
"""

import pandas as pd
from sqlalchemy import create_engine, text
from db import get_engine


def procesar_tipos():
    print("Procesando tipos...")

    easygo = pd.read_csv("data/dispositivos_tipos_easygo.csv")
    yeli = pd.read_csv("data/dispositivos_tipos_yeli.csv")

    # Normalizar columnas
    easygo = easygo.rename(columns={"nombre": "name"})
    yeli = yeli.rename(columns={"nombre": "name"})

    # Identicar bd de origen
    easygo["origen"] = "easygo"
    yeli["origen"] = "yeli"

    # Identificar el id que tenían en MySQL
    easygo["original_id"] = easygo["id"]
    yeli["original_id"] = yeli["id"]

    # Combinar y reasignar ID
    combined = pd.concat([easygo, yeli], ignore_index=True)
    combined = combined.drop(columns=["id"])

    # Asignar nuevos id
    combined["id"] = range(1, len(combined) + 1)

    # Crear map: (origen, original_id) -> nuevo_id
    id_map = combined[["origen", "original_id", "id"]]

    # Filtrar solo las columnas necesarias para la tabla
    data_df = combined[["id", "name"]]

    # Conexión a postgres
    engine = get_engine()

    # Insertar regsitros
    data_df.to_sql("devices_type", con=engine, if_exists="append", index=False)

    # Actualizar la secuencia al valor máximo actual
    with engine.connect() as conn:
        conn.execute(
            text(
                "SELECT setval('devices_type_id_seq', (SELECT MAX(id) FROM devices_type));"
            )
        )

    print("Tipos procesados!")

    return combined
