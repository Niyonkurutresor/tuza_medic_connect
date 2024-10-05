<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Lab404\Impersonate\Models\Impersonate;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $contact
 * @property string|null $dob
 * @property int $gender
 * @property int $status
 * @property string|null $language
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Address|null $address
 * @property-read Doctor|null $doctor
 * @property-read string $full_name
 * @property-read string $profile_image
 * @property-read MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @property-read DatabaseNotificationCollection|DatabaseNotification[]
 *     $notifications
 * @property-read int|null $notifications_count
 * @property-read Patient|null $patient
 *
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereContact($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereDob($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereFirstName($value)
 * @method static Builder|User whereGender($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereLanguage($value)
 * @method static Builder|User whereLastName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereStatus($value)
 * @method static Builder|User whereUpdatedAt($value)
 *
 * @property int|null $type
 * @property string|null $blood_group
 * @property-read mixed $role_name
 * @property-read Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read Collection|Qualification[] $qualifications
 * @property-read int|null $qualifications_count
 * @property-read Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 *
 * @method static Builder|User permission($permissions)
 * @method static Builder|User role($roles, $guard = null)
 * @method static Builder|User whereBloodGroup($value)
 * @method static Builder|User whereType($value)
 *
 * @property-read \App\Models\Staff|null $staff
 * @property string|null $region_code
 *
 * @method static Builder|User whereRegionCode($value)
 */
class User extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable, InteractsWithMedia, HasRoles, Impersonate;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'contact',
        'dob',
        'gender',
        'status',
        'password',
        'language',
        'blood_group',
        'type',
        'region_code',
        'email_verified_at',
        'email_notification',
        'time_zone',
        'dark_mode',
    ];

    const LANGUAGES = [
        'en' => 'English',
        'es' => 'Spanish',
        'fr' => 'French',
        'de' => 'German',
        'ru' => 'Russian',
        'pt' => 'Portuguese',
        'ar' => 'Arabic',
        'zh' => 'Chinese',
        'tr' => 'Turkish',
        'it' => 'Italian',
    ];

    const LANGUAGES_IMAGE = [
        'en' => 'web/media/flags/united-states.svg',
        'es' => 'web/media/flags/spain.svg',
        'fr' => 'web/media/flags/france.svg',
        'de' => 'web/media/flags/germany.svg',
        'ru' => 'web/media/flags/russia.svg',
        'pt' => 'web/media/flags/portugal.svg',
        'ar' => 'web/media/flags/iraq.svg',
        'zh' => 'web/media/flags/china.svg',
        'tr' => 'web/media/flags/turkey.svg',
        'it' => 'web/media/flags/italy.svg',
    ];

    const PROFILE = 'profile';

    const ADMIN = 1;

    const DOCTOR = 2;

    const PATIENT = 3;

    const STAFF = 4;

    const TYPE = [
        self::ADMIN => 'Admin',
        self::DOCTOR => 'Doctor',
        self::PATIENT => 'Patient',
        self::STAFF => 'Staff',
    ];

    const ALL = 2;

    const ACTIVE = 1;

    const DEACTIVE = 0;

    const STATUS = [
        self::DEACTIVE => 'Deactive',
        self::ACTIVE => 'Active',
        self::ALL => 'All',
    ];

    const TIME_ZONE_ARRAY = [
        'Africa/Abidjan',
        'Africa/Accra',
        'Africa/Algiers',
        'Africa/Bissau',
        'Africa/Cairo',
        'Africa/Casablanca',
        'Africa/Ceuta',
        'Africa/El_Aaiun',
        'Africa/Johannesburg',
        'Africa/Juba',
        'Africa/Khartoum',
        'Africa/Lagos',
        'Africa/Maputo',
        'Africa/Monrovia',
        'Africa/Nairobi',
        'Africa/Ndjamena',
        'Africa/Sao_Tome',
        'Africa/Tripoli',
        'Africa/Tunis',
        'Africa/Windhoek',
        'America/Adak',
        'America/Anchorage',
        'America/Araguaina',
        'America/Argentina/Buenos_Aires',
        'America/Argentina/Catamarca',
        'America/Argentina/Cordoba',
        'America/Argentina/Jujuy',
        'America/Argentina/La_Rioja',
        'America/Argentina/Mendoza',
        'America/Argentina/Rio_Gallegos',
        'America/Argentina/Salta',
        'America/Argentina/San_Juan',
        'America/Argentina/San_Luis',
        'America/Argentina/Tucuman',
        'America/Argentina/Ushuaia',
        'America/Asuncion',
        'America/Atikokan',
        'America/Bahia',
        'America/Bahia_Banderas',
        'America/Barbados',
        'America/Belem',
        'America/Belize',
        'America/Blanc-Sablon',
        'America/Boa_Vista',
        'America/Bogota',
        'America/Boise',
        'America/Cambridge_Bay',
        'America/Campo_Grande',
        'America/Cancun',
        'America/Caracas',
        'America/Cayenne',
        'America/Chicago',
        'America/Chihuahua',
        'America/Costa_Rica',
        'America/Creston',
        'America/Cuiaba',
        'America/Curacao',
        'America/Danmarkshavn',
        'America/Dawson',
        'America/Dawson_Creek',
        'America/Denver',
        'America/Detroit',
        'America/Edmonton',
        'America/Eirunepe',
        'America/El_Salvador',
        'America/Fort_Nelson',
        'America/Fortaleza',
        'America/Glace_Bay',
        'America/Godthab',
        'America/Goose_Bay',
        'America/Grand_Turk',
        'America/Guatemala',
        'America/Guayaquil',
        'America/Guyana',
        'America/Halifax',
        'America/Havana',
        'America/Hermosillo',
        'America/Indiana/Indianapolis',
        'America/Indiana/Knox',
        'America/Indiana/Marengo',
        'America/Indiana/Petersburg',
        'America/Indiana/Tell_City',
        'America/Indiana/Vevay',
        'America/Indiana/Vincennes',
        'America/Indiana/Winamac',
        'America/Inuvik',
        'America/Iqaluit',
        'America/Jamaica',
        'America/Juneau',
        'America/Kentucky/Louisville',
        'America/Kentucky/Monticello',
        'America/La_Paz',
        'America/Lima',
        'America/Los_Angeles',
        'America/Maceio',
        'America/Managua',
        'America/Manaus',
        'America/Martinique',
        'America/Matamoros',
        'America/Mazatlan',
        'America/Menominee',
        'America/Merida',
        'America/Metlakatla',
        'America/Mexico_City',
        'America/Miquelon',
        'America/Moncton',
        'America/Monterrey',
        'America/Montevideo',
        'America/Nassau',
        'America/New_York',
        'America/Nipigon',
        'America/Nome',
        'America/Noronha',
        'America/North_Dakota/Beulah',
        'America/North_Dakota/Center',
        'America/North_Dakota/New_Salem',
        'America/Ojinaga',
        'America/Panama',
        'America/Pangnirtung',
        'America/Paramaribo',
        'America/Phoenix',
        'America/Port_of_Spain',
        'America/Port-au-Prince',
        'America/Porto_Velho',
        'America/Puerto_Rico',
        'America/Punta_Arenas',
        'America/Rainy_River',
        'America/Rankin_Inlet',
        'America/Recife',
        'America/Regina',
        'America/Resolute',
        'America/Rio_Branco',
        'America/Santarem',
        'America/Santiago',
        'America/Santo_Domingo',
        'America/Sao_Paulo',
        'America/Scoresbysund',
        'America/Sitka',
        'America/St_Johns',
        'America/Swift_Current',
        'America/Tegucigalpa',
        'America/Thule',
        'America/Thunder_Bay',
        'America/Tijuana',
        'America/Toronto',
        'America/Vancouver',
        'America/Whitehorse',
        'America/Winnipeg',
        'America/Yakutat',
        'America/Yellowknife',
        'Antarctica/Casey',
        'Antarctica/Davis',
        'Antarctica/DumontDUrville', // https://bugs.chromium.org/p/chromium/issues/detail?id=928068
        'Antarctica/Macquarie',
        'Antarctica/Mawson',
        'Antarctica/Palmer',
        'Antarctica/Rothera',
        'Antarctica/Syowa',
        'Antarctica/Troll',
        'Antarctica/Vostok',
        'Asia/Almaty',
        'Asia/Amman',
        'Asia/Anadyr',
        'Asia/Aqtau',
        'Asia/Aqtobe',
        'Asia/Ashgabat',
        'Asia/Atyrau',
        'Asia/Baghdad',
        'Asia/Baku',
        'Asia/Bangkok',
        'Asia/Barnaul',
        'Asia/Beirut',
        'Asia/Bishkek',
        'Asia/Brunei',
        'Asia/Chita',
        'Asia/Choibalsan',
        'Asia/Colombo',
        'Asia/Damascus',
        'Asia/Dhaka',
        'Asia/Dili',
        'Asia/Dubai',
        'Asia/Dushanbe',
        'Asia/Famagusta',
        'Asia/Gaza',
        'Asia/Hebron',
        'Asia/Ho_Chi_Minh',
        'Asia/Hong_Kong',
        'Asia/Hovd',
        'Asia/Irkutsk',
        'Asia/Jakarta',
        'Asia/Jayapura',
        'Asia/Jerusalem',
        'Asia/Kabul',
        'Asia/Kamchatka',
        'Asia/Karachi',
        'Asia/Kathmandu',
        'Asia/Khandyga',
        'Asia/Kolkata',
        'Asia/Krasnoyarsk',
        'Asia/Kuala_Lumpur',
        'Asia/Kuching',
        'Asia/Macau',
        'Asia/Magadan',
        'Asia/Makassar',
        'Asia/Manila',
        'Asia/Nicosia',
        'Asia/Novokuznetsk',
        'Asia/Novosibirsk',
        'Asia/Omsk',
        'Asia/Oral',
        'Asia/Pontianak',
        'Asia/Pyongyang',
        'Asia/Qatar',
        'Asia/Qostanay', // https://bugs.chromium.org/p/chromium/issues/detail?id=928068
        'Asia/Qyzylorda',
        'Asia/Riyadh',
        'Asia/Sakhalin',
        'Asia/Samarkand',
        'Asia/Seoul',
        'Asia/Shanghai',
        'Asia/Singapore',
        'Asia/Srednekolymsk',
        'Asia/Taipei',
        'Asia/Tashkent',
        'Asia/Tbilisi',
        'Asia/Tehran',
        'Asia/Thimphu',
        'Asia/Tokyo',
        'Asia/Tomsk',
        'Asia/Ulaanbaatar',
        'Asia/Urumqi',
        'Asia/Ust-Nera',
        'Asia/Vladivostok',
        'Asia/Yakutsk',
        'Asia/Yangon',
        'Asia/Yekaterinburg',
        'Asia/Yerevan',
        'Atlantic/Azores',
        'Atlantic/Bermuda',
        'Atlantic/Canary',
        'Atlantic/Cape_Verde',
        'Atlantic/Faroe',
        'Atlantic/Madeira',
        'Atlantic/Reykjavik',
        'Atlantic/South_Georgia',
        'Atlantic/Stanley',
        'Australia/Adelaide',
        'Australia/Brisbane',
        'Australia/Broken_Hill',
        'Australia/Currie',
        'Australia/Darwin',
        'Australia/Eucla',
        'Australia/Hobart',
        'Australia/Lindeman',
        'Australia/Lord_Howe',
        'Australia/Melbourne',
        'Australia/Perth',
        'Australia/Sydney',
        'Europe/Amsterdam',
        'Europe/Andorra',
        'Europe/Astrakhan',
        'Europe/Athens',
        'Europe/Belgrade',
        'Europe/Berlin',
        'Europe/Brussels',
        'Europe/Bucharest',
        'Europe/Budapest',
        'Europe/Chisinau',
        'Europe/Copenhagen',
        'Europe/Dublin',
        'Europe/Gibraltar',
        'Europe/Helsinki',
        'Europe/Istanbul',
        'Europe/Kaliningrad',
        'Europe/Kiev',
        'Europe/Kirov',
        'Europe/Lisbon',
        'Europe/London',
        'Europe/Luxembourg',
        'Europe/Madrid',
        'Europe/Malta',
        'Europe/Minsk',
        'Europe/Monaco',
        'Europe/Moscow',
        'Europe/Oslo',
        'Europe/Paris',
        'Europe/Prague',
        'Europe/Riga',
        'Europe/Rome',
        'Europe/Samara',
        'Europe/Saratov',
        'Europe/Simferopol',
        'Europe/Sofia',
        'Europe/Stockholm',
        'Europe/Tallinn',
        'Europe/Tirane',
        'Europe/Ulyanovsk',
        'Europe/Uzhgorod',
        'Europe/Vienna',
        'Europe/Vilnius',
        'Europe/Volgograd',
        'Europe/Warsaw',
        'Europe/Zaporozhye',
        'Europe/Zurich',
        'Indian/Chagos',
        'Indian/Christmas',
        'Indian/Cocos',
        'Indian/Kerguelen',
        'Indian/Mahe',
        'Indian/Maldives',
        'Indian/Mauritius',
        'Indian/Reunion',
        'Pacific/Apia',
        'Pacific/Auckland',
        'Pacific/Bougainville',
        'Pacific/Chatham',
        'Pacific/Chuuk',
        'Pacific/Easter',
        'Pacific/Efate',
        'Pacific/Enderbury',
        'Pacific/Fakaofo',
        'Pacific/Fiji',
        'Pacific/Funafuti',
        'Pacific/Galapagos',
        'Pacific/Gambier',
        'Pacific/Guadalcanal',
        'Pacific/Guam',
        'Pacific/Honolulu',
        'Pacific/Kiritimati',
        'Pacific/Kosrae',
        'Pacific/Kwajalein',
        'Pacific/Majuro',
        'Pacific/Marquesas',
        'Pacific/Nauru',
        'Pacific/Niue',
        'Pacific/Norfolk',
        'Pacific/Noumea',
        'Pacific/Pago_Pago',
        'Pacific/Palau',
        'Pacific/Pitcairn',
        'Pacific/Pohnpei',
        'Pacific/Port_Moresby',
        'Pacific/Rarotonga',
        'Pacific/Tahiti',
        'Pacific/Tarawa',
        'Pacific/Tongatapu',
        'Pacific/Wake',
        'Pacific/Wallis',
    ];

    // protected $with = ['media', 'roles'];

    protected $appends = ['full_name', 'profile_image', 'role_name', 'role_display_name'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    const MALE = 1;

    const FEMALE = 2;

    const GENDER = [
        self::MALE => 'Male',
        self::FEMALE => 'Female',
    ];

    public static $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:users,email|regex:/(.*)@(.*)\.(.*)/',
        'contact' => 'nullable|unique:users,contact',
        'password' => 'required|same:password_confirmation|min:6',
        'dob' => 'nullable|date',
        'experience' => 'nullable|numeric',
        'specializations' => 'required',
        'gender' => 'required',
        'status' => 'nullable',
        'postal_code' => 'nullable',
        'profile' => 'nullable|mimes:jpeg,png,jpg|max:2000',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'first_name' => 'string',
        'last_name' => 'string',
        'email' => 'string',
        'contact' => 'string',
        'dob' => 'string',
        'gender' => 'integer',
        'status' => 'boolean',
        'password' => 'string',
        'language' => 'string',
        'blood_group' => 'string',
        'type' => 'integer',
        'region_code' => 'string',
        'email_notification' => 'boolean',
        'time_zone' => 'string',
        'dark_mode' => 'boolean',
    ];

    public function getProfileImageAttribute(): string
    {
        /** @var Media $media */
        $media = $this->getMedia(self::PROFILE)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }
        $gender = $this->gender;
        if ($gender == self::FEMALE) {
            return asset('web/media/avatars/female.png');
        }

        return asset('web/media/avatars/male.png');
    }

    public function getRoleNameAttribute()
    {
        $role = $this->roles->first();

        if (! empty($role)) {
            return $role->display_name;
        }
    }

    public function getRoleDisplayNameAttribute()
    {
        $role = $this->roles->first();

        if (! empty($role)) {
            return $role->name;
        }
    }

    public function getFullNameAttribute(): string
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'owner');
    }

    public function doctor(): HasOne
    {
        return $this->hasOne(Doctor::class, 'user_id');
    }

    public function qualifications(): HasMany
    {
        return $this->hasMany(Qualification::class, 'user_id');
    }

    public function patient(): HasOne
    {
        return $this->hasOne(Patient::class, 'user_id');
    }

    public function staff(): HasOne
    {
        return $this->hasOne(Staff::class);
    }

    public function gCredentials(): HasOne
    {
        return $this->hasOne(GoogleCalendarIntegration::class, 'user_id');
    }
}
