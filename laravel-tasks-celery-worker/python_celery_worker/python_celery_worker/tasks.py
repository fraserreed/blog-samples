from __future__ import absolute_import
from python_celery_worker import logging
from python_celery_worker.celery import app
from python_celery_worker.services import db_tasks

log = logging.getLogger(__name__)


@app.task(name="task_created", bind=True, default_retry_delay=10)  # set a retry delay, 10 equal to 10s
def task_created(self, task_id):
    try:
        db_tasks.update_task(task_id)

        log.info('Updated task %s in database', task_id)
    except Exception as exc:
        raise self.retry(exc=exc)

    return True
