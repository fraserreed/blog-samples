<?php

namespace App\Jobs;

class TaskCreatedJob extends AbstractCeleryTaskJob
{
    /**
     * Dispatch the task created job
     *
     * @param $id
     *
     * @return \AsyncResult
     */
    public function dispatch($id): \AsyncResult
    {
        return $this->send('task_created', [$id]);
    }
}
