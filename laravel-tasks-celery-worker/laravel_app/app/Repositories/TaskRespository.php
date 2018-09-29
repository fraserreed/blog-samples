<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository
{
    /**
     * Fetch all tasks in database
     *
     * @return Collection
     */
    public function fetchAll()
    {
        return Task::get();
    }

    /**
     * Create a new task in the database
     *
     * @param $name
     *
     * @return Task
     */
    public function create($name)
    {
        return Task::create([
            'name'   => $name,
            'status' => Task::STATUS_PENDING
        ]);
    }
}
