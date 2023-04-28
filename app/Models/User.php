<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles, HasPermissions;

    protected $table = 'users';

    protected $guard_name = 'web';

    const USER_AVATAR_PATH = 'assets/images/avatar';
    const DEFAULT_AVATAR = 'assets/images/avatar/default-avatar.png';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'avatar',
        'status',
        'status_update',
        'country',
        'state',
        'city'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the faculty associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function faculty(): HasOne
    {
        return $this->hasOne(Faculty::class, 'user_id', 'id');
    }

    /**
     * check if student
     *
     * @return Bool
     */
    public function isStudent(): bool
    {
        return auth()->user()->hasRole(Role::ROLE_STUDENT);
    }

    /**
     * check the faculty with higher authority (HOD, PC)
     *
     * @return Bool
     */
    public function isAuthoritativeUser(): bool
    {
        return  auth()->user()->hasRole(Role::ROLE_HOD) ||
            auth()->user()->hasRole(Role::ROLE_PROJECT_CONVENER);
    }
}
