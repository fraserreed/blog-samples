import os
from dotenv import load_dotenv

basedir = os.path.dirname(os.path.abspath(os.path.dirname(__file__)))
load_dotenv(os.path.join('../', basedir, '.env'))

# SQLAlchemy settings
SQLALCHEMY_DATABASE_URI = os.environ.get('SQLALCHEMY_DATABASE_URI') or 'mysql+pymysql://root:root@mysql/blog'
SQLALCHEMY_TRACK_MODIFICATIONS = False

DATABASE_QUERY_LOG = os.environ.get('DATABASE_QUERY_LOG') or False

WORKER_BROKER = os.environ.get('WORKER_BROKER') or 'redis://redis:6379/0'
WORKER_BACKEND = os.environ.get('WORKER_BACKEND') or 'file:///usr/src/app/logs'
