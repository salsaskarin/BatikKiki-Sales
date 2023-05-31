<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dailysells extends Model
{
    use HasFactory;

    protected $table = 'dailysells';

    protected $fillable = [
        'date',
        'total'
    ];
}
