<?php

namespace App\Models;

use Eloquent as Model;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Departement
 * @package App\Models
 * @version April 10, 2021, 1:52 pm UTC
 *
 * @property string $name
 * @property integer $responsible_id
 */
class Departement extends Model
{

    use HasFactory;

    public $table = 'departements';


    public $fillable = [
        'name',

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'responsible_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
    ];

    /**
     * Get the user associated with the Departement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function chefDepartement()
    {
        return $this->hasOne(User::class, 'id', 'responsible_id');
    }

    /**
     * Get all of the services of the Departement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services()
    {
        return $this->hasMany(Service::class, 'departement_id', 'id');
    }

    /**
     * Get all of the users for the Departement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class, 'departement_id', 'id');
    }

}
