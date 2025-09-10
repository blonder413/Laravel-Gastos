import pandas as pd

from sqlalchemy import create_engine, text
from db import get_engine


def procesar_sectores():
    print("Procesando sectores...")

    easygo = pd.read_csv("data/dispositivos_sector_easygo.csv")

    # Normalizar columnas
    easygo = easygo.rename(columns={"nombre": "name"})

    # Filtrar solo las columnas necesarias
    data_df = easygo[["id", "name"]]

    engine = get_engine()

    data_df.to_sql("devices_sector", con=engine, if_exists="append", index=False)

    with engine.connect() as conn:
        conn.execute(
            text(
                "SELECT setval('devices_sector_id_seq', (SELECT MAX(id) FROM devices_sector));"
            )
        )

    print("Sectores procesados")

    return easygo
