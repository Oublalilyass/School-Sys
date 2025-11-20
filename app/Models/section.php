<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class section extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'class_id'];

    public function class()
    {
        return $this->belongsTo(classes::class);
    }
    
    public function students()
    {
        return $this->hasMany(student::class);
    }
}
