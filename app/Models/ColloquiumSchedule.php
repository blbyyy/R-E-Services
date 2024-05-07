<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColloquiumSchedule extends Model
{
    use HasFactory;

    public $table = 'colloquium_schedule';

    protected $fillable = [
        "date",
        "time",
        "status",
        "researchProposal_id",
    ];
}
