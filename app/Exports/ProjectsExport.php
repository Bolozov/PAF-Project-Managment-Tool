<?php

namespace App\Exports;

use App\Models\Project;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProjectsExport implements FromView
{
    public function view() : View
    {
        $projectData =  Project::with('responsible', 'departement', 'service', 'tasks')->latest()->get();

        return view("projects.exceltable",[
        "projects" => $projectData
    ]);
    }
}
