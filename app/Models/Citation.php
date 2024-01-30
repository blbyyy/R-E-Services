<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citation extends Model
{
    use HasFactory;

    public $table = 'citations';

    protected $guarded = ['id'];

    protected $fillable = [
        'researchTitle',
        'conferenceForum',
        'date',
        'venue',
        'country'.
        'presentor1',
        'presentor2',
        'presentor3',
        'presentor4',
        'presentor5',
        'presentation',
        'publication',
        'author1',
        'author2',
        'author3',
        'author4',
        'author5',
        'document',
        'user_id',
    ];

}