<?php

namespace App\Models;

use Database\Factories\StaffFactory;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class Staff
 *
 * @version August 6, 2021, 10:17 am UTC
 *
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone_number
 * @property string $password
 * @property string $gender
 * @property string $role
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static StaffFactory factory(...$parameters)
 * @method static Builder|Staff newModelQuery()
 * @method static Builder|Staff newQuery()
 * @method static Builder|Staff query()
 * @method static Builder|Staff whereCreatedAt($value)
 * @method static Builder|Staff whereEmail($value)
 * @method static Builder|Staff whereFirstName($value)
 * @method static Builder|Staff whereGender($value)
 * @method static Builder|Staff whereId($value)
 * @method static Builder|Staff whereLastName($value)
 * @method static Builder|Staff wherePassword($value)
 * @method static Builder|Staff wherePhoneNumber($value)
 * @method static Builder|Staff whereUpdatedAt($value)
 *
 * @mixin Model
 *
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[]
 *     $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 *
 * @method static Builder|Staff permission($permissions)
 * @method static Builder|Staff role($roles, $guard = null)
 */
class Staff extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasRoles;

    protected $table = 'staff';

    const PROFILE = 'profile';

    public $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'password',
        'gender',
        'role',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'first_name' => 'string',
        'last_name' => 'string',
        'email' => 'string',
        'phone_number' => 'string',
        'password' => 'string',
        'gender' => 'string',
        'role' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|same:password_confirmation|min:6',
        'contact' => 'nullable|unique:users,contact',
        'gender' => 'required',
        'role' => 'required',
    ];
}
