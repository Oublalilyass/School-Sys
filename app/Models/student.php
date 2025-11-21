<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;



class student extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'class_id', 'section_id'];

    protected $with = ['class', 'section'];

    public function class()
    {
        return $this->belongsTo(classes::class, 'class_id');
    }
    public function section()
    {
        return $this->belongsTo(section::class, 'section_id');
    }


    public function scopeSearch(Builder $query, Request $request)
    {
        return $query->where(function ($query) use ($request) {
            return $query->when($request->search, function ($query) use ($request) {
                return $query->where(function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('email', 'like', '%' . $request->search . '%');
                });
            })->when($request->class_id, function ($query) use ($request) {
                return $query->where('class_id', $request->class_id);
            });
        });
    }

}
