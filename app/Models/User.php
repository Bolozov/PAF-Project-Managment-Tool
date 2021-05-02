<?php

namespace App\Models;

use App\Models\Project;
use App\Models\Service;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Notifications\Notifiable;


/**
 * Class User
 * @package App\Models
 * @version April 9, 2021, 3:54 pm UTC
 *
 * @property string $name
 * @property string $email
 * @property string|\Carbon\Carbon $email_verified_at
 * @property string $password
 * @property integer $cin
 * @property integer $num_tel
 * @property string $remember_token
 */
class User extends Authenticatable
{
    use HasFactory, HasRoles, Notifiable;

    public $table = 'users';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['last_login_at'];
    protected $primaryKey = 'id';

    public $fillable = [
        'name',
        'email',
        'password',
        'cin',
        'num_tel',
        'last_login_at',
        'departement_id',
        'service_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'string',
        'cin' => 'integer',
        'num_tel' => 'integer',
        'remember_token' => 'string',
        'departement_id' => 'integer',
        'service_id' => 'integer',

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required|string|max:255',
        'cin' => 'required|integer|digits:8|unique:users,cin',
        'num_tel' => 'nullable|integer|digits:8',
        'role' => 'required',
    ];

    /**
     * The channels the user receives notification broadcasts on.
     *
     * @return string
     */
    public function receivesBroadcastNotificationsOn()
    {
        return 'users.' . $this->id;
    }

    /**
     * Returns an avatar(URL) from ui-avatars with name's initials
     * @return string
     */
    public function getAvatarUrlAttribute()
    {
        return 'https://ui-avatars.com/api/?name=' . str_replace(' ', '+', $this->name) . '&background=fff&color=6777ef&size=100';
    }

    public function getTeamAvatarUrlAttribute()
    {
        return 'https://ui-avatars.com/api/?name=' . str_replace(' ', '+', $this->name) . '&background=f4f6f9
&color=6777ef&size=100';
    }

    /**
     * Get the department of the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Departement::class, 'departement_id');
    }

    /**
     * Get the service that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    /**
     * The projects that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

}
