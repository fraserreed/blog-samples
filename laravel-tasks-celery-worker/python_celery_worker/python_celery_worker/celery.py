from __future__ import absolute_import
from python_celery_worker import settings
from celery import Celery

app = Celery(
    'python_celery_worker',
    broker=settings.WORKER_BROKER,
    backend=settings.WORKER_BACKEND,
    include=['python_celery_worker.tasks']
)
