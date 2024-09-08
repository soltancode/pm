<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // Fillable fields for mass assignment
    protected $fillable = ['name', 'description'];

    // Relationship: A project has many tasks
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}