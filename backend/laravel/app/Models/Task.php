<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, 'assinged_to');
    }
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
