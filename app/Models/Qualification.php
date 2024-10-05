<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Qualification
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $degree
 * @property string|null $university
 * @property string|null $year
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Qualification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Qualification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Qualification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Qualification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Qualification whereDegree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Qualification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Qualification whereUniversity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Qualification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Qualification whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Qualification whereYear($value)
 *
 * @mixin \Eloquent
 */
class Qualification extends Model
{
    /**
     * @var string
     */
    protected $table = 'qualifications';

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'degree',
        'university',
        'year',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'degree' => 'string',
        'university' => 'string',
        'year' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'degree' => 'required',
        'university' => 'required',
        'year' => 'required',
    ];
}
