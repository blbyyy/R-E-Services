<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    use HasFactory;

    public $table = 'appointments';

    protected $fillable = [
        "purpose",
        "date",
        "time",
        "status",
        "user_id",
    ];

}
