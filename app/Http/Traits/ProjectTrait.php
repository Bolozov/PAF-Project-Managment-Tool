<?php

namespace App\Http\Traits;

use App\Models\Project;

trait ProjectTrait
{
    /**
     * Budget left Calculation
     */
    public function getLeftBalance(Project $project) : int
    {
        $tasksCost = $project->tasks()->sum('budget');
        isset($tasksCost) ? $leftBalance = $project->budget_project - $tasksCost
            : $leftBalance = $project->budget_project;
        return $leftBalance;
    }

}
