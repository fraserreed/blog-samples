<?php

namespace App\Jobs;

interface ICeleryTaskJob
{
    /**
     * Each class extending this abstract class can use this as the function to dispatch the correct task message
     *
     * @param $id
     *
     * @return \AsyncResult
     */
    public function dispatch($id): \AsyncResult;
}
