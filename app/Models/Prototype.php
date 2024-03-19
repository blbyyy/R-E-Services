<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prototype extends Model
{
    use HasFactory;

    public $table = 'prototype';

    protected $fillable = [
        "letter",
        "nda",
        "coa",
        "pre_evaluation_survey",
        "mid_evaluation_survey",
        "post_evaluation_survey",
        "capsule_detail",
        "certificate",
        "attendance",
    ];
}
