from sqlalchemy.ext.declarative import declarative_base
from sqlalchemy import create_engine
from sqlalchemy.orm import sessionmaker

from python_celery_worker import settings

Base = declarative_base()

db_engine = create_engine(settings.SQLALCHEMY_DATABASE_URI, echo=settings.DATABASE_QUERY_LOG)

session = sessionmaker()
session.configure(bind=db_engine)
