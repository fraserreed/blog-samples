import os
import json
import logging.config

from python_celery_worker import settings

# set up the logging configuration
default_path = os.path.normpath(os.path.join(os.path.dirname(__file__), '../logging.json'))
default_level = logging.INFO
env_key = 'LOG_CFG'

value = os.getenv(env_key, None)
if value:
    default_path = value
if os.path.exists(default_path):
    with open(default_path, 'rt') as f:
        config = json.load(f)
    logging.config.dictConfig(config)
else:
    logging.basicConfig(level=default_level)

if settings.DATABASE_QUERY_LOG:
    logging.getLogger('sqlalchemy.engine').setLevel(logging.INFO)

# expose the logging service
logging = logging
