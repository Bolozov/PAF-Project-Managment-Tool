<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {

        if (auth()->user()->hasRole('Admin')) {
            $projectCount = Project::count('id');
            $tasksCount = Task::count('id');
            $totalBudget = Project::sum('budget_project');
            $usersCount = User::count('id');
            $actifUsersCount = User::whereNotNull('last_login_at')->count('id');
            $chartsContion = "true";

        } elseif (auth()->user()->hasRole('Chef de département')) {
            $projectCount = Project::where('departement_id', auth()->user()->departement_id)
                ->count('id');
            $tasksCount = Task::whereHas('project', function ($q) {
                $q->where('departement_id', auth()->user()->departement_id);
            })->count('id');
            $totalBudget = Project::where('departement_id', auth()->user()->departement_id)
                ->sum('budget_project');

            $usersCount = User::where('departement_id', auth()->user()->departement_id)
                ->count('id');
            $actifUsersCount = User::where('departement_id', auth()->user()->departement_id)
                ->whereNotNull('last_login_at')
                ->count('id');

            $chartsContion = 'departement_id = ' . auth()->user()->departement_id;

        } elseif (auth()->user()->hasRole('Chef de service')) {
            $projectCount = Project::where(['departement_id', auth()->user()->departement_id],
                ['service_id', auth()->user()->service_id])
                ->count('id');
            $chartsContion = 'departement_id = ' . auth()->user()->departement_id . ' service_id = ' . auth()->user()->service_id;

        } elseif (auth()->user()->hasRole('Chef de projet')) {
            $projectCount = Project::where(['departement_id', auth()->user()->departement_id],
                ['service_id', auth()->user()->service_id],
                ['responsible_id_project', auth()->user()->id])
                ->count('id');
        } else {
            $projectCount = auth()->user()->projects_count;
        }

        $chart_options = [
            'chart_title' => 'Nouveaux projets chaque mois',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Project',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'where_raw' => $chartsContion,

        ];
        $projectsByMonth = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'État des projets',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Project',
            'group_by_field' => 'status_project',
            'chart_type' => 'pie',
            'filter_field' => 'created_at',
            'filter_period' => 'month',
            'where_raw' => $chartsContion,

        ];
        $projectStatusByMonth = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Projets par département',
            'chart_type' => 'bar',
            'report_type' => 'group_by_relationship',
            'model' => 'App\Models\Project',

            'relationship_name' => 'departement',
            'group_by_field' => 'name',

            'aggregate_function' => 'count',
            'aggregate_field' => 'name',

            'filter_field' => 'created_at',
            'filter_days' => 30,
            'filter_period' => 'week',
        ];
        $projectsByDepartment = new LaravelChart($chart_options);

        $projectsEndingThisWeek = Project::with('responsible', 'departement')
            ->whereDate('end_date_project', '<=', Carbon::now()->endOfWeek()->format('Y-m-d'))
            ->whereNotIn('status_project', ['validé', 'annulé'])
            ->latest()
            ->get();

        $tasksEndingThisWeek = Task::whereDate('deadline', '<=', Carbon::now()->endOfWeek()->format('Y-m-d'))
            ->whereNotIn('status', ['validée'])
            ->latest()
            ->get();


        return view('home', compact("tasksEndingThisWeek","projectsEndingThisWeek", "projectCount", "tasksCount", "totalBudget", "usersCount", "actifUsersCount", "projectsByMonth", "projectStatusByMonth", "projectsByDepartment"));
    }
}
