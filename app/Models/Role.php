<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public function users() 
    {
        // связь одна ко многим для role  чтобы читать user
        return $this->belongsToMany(User::class, 'user_role');
    }
}
