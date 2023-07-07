<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $casts = [
        'assinged_to' => 'array',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class,'project_id')->with('user');
    }

}
