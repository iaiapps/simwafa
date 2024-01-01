<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class komponen extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function evaluation()
    {
        return $this->hasMany(Evaluation::class);
    }
}
