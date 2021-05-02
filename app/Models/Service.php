<?php

namespace App\Models;

use App\Models\Departement;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Service
 * @package App\Models
 * @version April 10, 2021, 2:49 pm UTC
 *
 * @property string $name
 * @property integer $responsible_id
 * @property integer $departement_id
 */
class Service extends Model
{

    use HasFactory;

    public $table = 'services';

    public $fillable = [
        'name',
        'responsible_id',
        'departement_id',
    ];
    protected $with = ['chefService', 'departement'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'responsible_id' => 'integer',
        'departement_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'responsible_id' => 'required',
        'departement_id' => 'required',
    ];

    /**
     * Get the user associated with the Departement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function chefService()
    {
        return $this->hasOne(User::class, 'id', 'responsible_id');
    }

    /**
     * Get the departement that owns the Service
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departement()
    {
        return $this->belongsTo(Departement::class, 'departement_id');
    }

}
