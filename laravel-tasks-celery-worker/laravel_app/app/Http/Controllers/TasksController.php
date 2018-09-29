<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TasksController extends Controller
{
    use DispatchesJobs;

    /**
     * @var TaskService
     */
    protected $taskService;

    /**
     * @param TaskService $taskService
     */
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Task listing page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('tasks', ['tasks' => $this->taskService->fetchAllTasks()]);
    }

    /**
     * Task create action
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(Request $request)
    {
        $this->taskService->createTask($request->get('name'));

        return redirect('/');
    }
}
