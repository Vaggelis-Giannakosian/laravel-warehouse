<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    public const USER_STATUS = [
        self::STATUS_ACTIVE,
        self::STATUS_INACTIVE
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'username',
        'password',
        'name',
        'last_name',
        'address',
        'email',
        'registration_date',
        'status',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'registration_date'
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    protected function setPasswordAttribute($value)
    {
        if (!$value) return;

        $this->attributes['password'] = bcrypt($value);
    }

    protected function getRegistrationDateAttribute($value)
    {
        if(empty($value)) return $value;

        return Carbon::createFromTimestamp( (int) $value);
    }


}
