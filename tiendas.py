import pandas as pd
from sqlalchemy import create_engine, text
from db import get_engine


def procesar_tiendas():
    print("Procesando tiendas...")

    easygo = pd.read_csv("data/tienda_easygo.csv")
    yeli = pd.read_csv("data/tienda_yeli.csv")

    # Normalizar columnas
    easygo = easygo.rename(
        columns={"codigo": "code", "nombre": "name", "abreviado": "abbreviated"}
    )
    yeli = yeli.rename(columns={"codigo": "code", "nombre": "name"})
    yeli["abbreviated"] = None

    # identificar bd de origen
    easygo["origen"] = "easygo"
    yeli["origen"] = "yeli"

    # identificar el id que tenían en MySQL
    easygo["original_id"] = easygo["id"]
    yeli["original_id"] = yeli["id"]

    # combinar y reasignar ID
    combined = pd.concat([easygo, yeli], ignore_index=True)
    combined = combined.drop(columns=["id"])

    # asignar nuevos id
    combined["id"] = range(1, len(combined) + 1)

    # crear mapa:(origen,original_id) -> nuevo_id
    id_map = combined[["origen", "original_id", "id"]]

    # Filtrar solo las columnas necesarias para la tabla store
    store_df = combined[["id", "abbreviated", "name", "code"]]

    # Conexión a postgres
    # engine = create_engine("postgresql+psycopg2://postgres:123456@localhost:5433/micd")
    engine = get_engine()

    # Insertar en la tabla store
    store_df.to_sql("store", con=engine, if_exists="append", index=False)

    # Actualizar la secuencia al valor máximo actual
    with engine.connect() as conn:
        conn.execute(
            text("SELECT setval('store_id_seq', (SELECT MAX(id) FROM store));")
        )

    print("Tiendas procesadas!")

    return combined
