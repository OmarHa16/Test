<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Preferred_sources extends Model
{
    use HasFactory;

    public function author()
    {
        return $this->hasMany(User::class, 'Preferred_sources');
    }
    public function source()
    {
        return $this->hasMany(sources::class, 'Preferred_sources');
    }
}
