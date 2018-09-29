<?php

namespace App\Services;

use App\Jobs\TaskCreatedJob;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Database\Eloquent\Collection;

class TaskService
{
    /**
     * @var TaskRepository
     */
    protected $taskRepository;

    /**
     * @var TaskCreatedJob
     */
    protected $taskCreatedJob;

    /**
     * @param TaskRepository $taskRepository
     */
    public function __construct(TaskRepository $taskRepository, TaskCreatedJob $taskCreatedJob)
    {
        $this->taskRepository = $taskRepository;
        $this->taskCreatedJob = $taskCreatedJob;
    }

    /**
     * Fetch all tasks from the database
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetchAllTasks(): Collection
    {
        return $this->taskRepository->fetchAll();
    }

    /**
     * Create a task and dispatch a job using the newly created task id
     *
     * @param $name
     *
     * @return Task
     */
    public function createTask($name): Task
    {
        $task = $this->taskRepository->create($name);

        // dispatch the job to the celery queue for the newly created task
        $this->taskCreatedJob->dispatch($task->id);

        return $task;
    }
}
