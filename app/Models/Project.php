<?php

namespace App\Models;

use App\Models\Departement;
use App\Models\Service;
use App\Models\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Project
 * @package App\Models
 * @version April 19, 2021, 5:00 am UTC
 *
 * @property integer $ref_project
 * @property string $name_project
 * @property integer $budget_project
 * @property string $start_date_project
 * @property string $end_date_project
 * @property string $status_project
 * @property integer $responsible_id_project
 */
class Project extends Model
{

    use HasFactory;

    public $table = 'projects';

    public $fillable = [
        'ref_project',
        'name_project',
        'budget_project',
        'start_date_project',
        'end_date_project',
        'status_project',
        'responsible_id_project',
        'departement_id',
        'service_id',
        'users_id',

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'ref_project' => 'integer',
        'name_project' => 'string',
        'budget_project' => 'integer',
        'start_date_project' => 'date',
        'end_date_project' => 'date',
        'status_project' => 'string',
        'responsible_id_project' => 'integer',
        'departement_id' => 'integer',
        'service_id' => 'integer',
        'users_id' => 'array'

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'ref_project' => 'required|numeric',
        'name_project' => 'required',
        'budget_project' => 'required',
        'start_date_project' => 'required|date',
        'end_date_project' => 'required|date|after:start_date_project',
        'responsible_id_project' => 'required',
        'responsible_id_project' => 'required',
        'departement_id' => 'required',
        'users_id' => 'required|array',
    ];

    /**
     * Get the responsible that owns the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function responsible()
    {
        return $this->belongsTo(User::class, 'responsible_id_project');
    }

    /**
     * Get the departement that owns the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departement()
    {
        return $this->belongsTo(Departement::class, 'departement_id');
    }

    /**
     * Get the service that owns the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    /**
     * Get all of the users of the Project
     * (Project Team)
     * @return HasMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get all Project's Tasks
     * @return HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Get the project Progress
     */
    public function projectFinishedTasks(){

        return $this->hasMany(Task::class)->where('status','validée');
    }

    public function getProjectProgressAttribute()
    {
        $finishedTasksCount = $this->projectFinishedTasks()->count();
        $totalTasksCount =  $this->tasks()->count();

        if( $totalTasksCount  > 0){
            return round(($finishedTasksCount / $totalTasksCount) * 100 ,2);
        }
        return 0;
    }





}
