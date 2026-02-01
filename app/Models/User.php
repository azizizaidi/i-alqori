<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\HasAvatar;
use Bavix\Wallet\Traits\CanPay;



class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $with = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url;
    }


    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'code',
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
        'password' => 'hashed',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return str_ends_with($this->email, '');
        // if ($panel->auth()->user()->roles->contains(1) || $panel->auth()->user()->roles->contains(2) ) {
           // return str_ends_with($this->email, '');
      //  }
 
        //return false;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id')
            ->with('permissions');
    }

    /**
     * Get cached permissions for the user.
     */
    public function getCachedPermissionsAttribute(): \Illuminate\Support\Collection
    {
        return \cache()->remember(
            "user_{$this->id}_permissions",
            3600,
            fn() => $this->getAllPermissions()
        );
    }

}
