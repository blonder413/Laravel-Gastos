from sqlalchemy import create_engine


def get_engine():
    return create_engine("postgresql+psycopg2://postgres:123456@localhost:5433/micd")
