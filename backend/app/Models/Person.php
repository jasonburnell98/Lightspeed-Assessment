<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = "person";

    protected $fillable = [
      'name',
      'email',
      'phone'
    ];


    public function taskdetails()
    {
        return $this->hasmany('App\Models\TaskDetails', 'task_id', 'id');
    }

}
