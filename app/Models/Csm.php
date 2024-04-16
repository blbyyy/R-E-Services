<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Csm extends Model
{
    use HasFactory;

    public $table = 'csm';

    protected $fillable = [
        "email",
        "rated_office",
        "date",
        "time",
        "email_address",
        "name",
        "user_type",
        "transaction_purpose",
        "facilitator",
        "cc1",
        "cc2",
        "cc3",
        "cc3_explanation",
        "q1",
        "a1",
        "q2",
        "a2",
        "q3",
        "a3",
        "q4",
        "a4",
        "q5",
        "a5",
        "q6",
        "a6",
        "q7",
        "a7",
        "q8",
        "a8",
        "comprehensive_type",
        "complaint_message",
    ];
}
