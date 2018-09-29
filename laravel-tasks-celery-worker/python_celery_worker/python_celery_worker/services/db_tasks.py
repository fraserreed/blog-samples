from python_celery_worker.services.db import db_engine


def update_task(id):
    """
    Update the task status in the database

    :param id:
    :return:
    """
    conn = db_engine.connect()
    conn.execute(
        'update tasks set status = %s, message = %s, updated_at = NOW() where id = %s',
        'completed',
        'Updated by celery worker!',
        id
    )
