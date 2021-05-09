<?php

namespace App\Models;

use Eloquent as Model;
use App\Models\Project;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
/**
 * Class Task
 * @package App\Models
 * @version April 21, 2021, 7:31 am UTC
 *
 * @property \App\Models\User $user
 * @property Project $project
 * @property string $name
 * @property string $deadline
 * @property integer $user_id
 * @property integer $project_id
 * @property string $status
 * @property string $verification_file
 * @property integer $budget
 * @property string $note

 */
class Task extends Model
{

    use HasFactory;

    public $table = 'tasks';
    protected $with = ['user' , 'project']; //always load the user details with each task.



    public $fillable = [
        'name',
        'deadline',
        'user_id',
        'project_id',
        'status',
        'verification_file',
        'budget',
        'note'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'deadline' => 'date',
        'user_id' => 'integer',
        'project_id' => 'integer',
        'status' => 'string',
        'verification_file' => 'string',
        'budget' => 'integer',
        'note' => 'string'

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'deadline' => 'required|date',
        'user_id' => 'required|integer',
        'project_id' => 'required|integer',
        'budget' => 'required|integer',
        'note' => 'string|nullable'


    ];

    /**
     * @return BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return BelongsTo
     **/
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

}
