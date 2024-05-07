<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    public $table = 'assessment';

    protected $guarded = ['id'];

    protected $fillable = [
        'date',
        'name',
        'address',
        'age',
        'status',
        'sex',
        'phone',
        'education_level',
        'employment',
        'employment_state',
        'training',
        'training1',
        'training2',
        'training3',
        'rank1',
        'rank2',
        'rank3',
        'rank4',
        'rank5',
        'rank6',
        'rank7',
        'rank8',
        'rank9',
        'rank10',
    ];
}
