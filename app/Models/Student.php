<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function evaluation()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function cluster()
    {
        return $this->belongsTo(Cluster::class);
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
}
