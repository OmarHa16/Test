<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Preferred_authors extends Model
{
    use HasFactory;


    public function User()
    {
        return $this->hasMany(User::class, 'Preferred_authors');
    }
    public function source()
    {
        return $this->hasMany(authors::class, 'Preferred_authors');
    }
}
