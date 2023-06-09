<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        // добавляем телефон
        'phone',
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
    // создаем связь один ко многим для чтения ролей пользователя
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }
    // здесь мы даем название фун для вывода ролей из бд с названием поля ролей
    public function hasRole($role)
    {
        return $this->roles->contains('name', $role);
    }
    public function driverFiles()
    {
        return $this->hasMany(DriverFile::class, 'driver_id');
    }
    
}
