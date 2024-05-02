<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSatisfactionSurvey extends Model
{
    use HasFactory;

    public $table = 'customer_satisfaction_survey';

    protected $fillable = [
        "email",
        "rated_department",
        "transaction_purpose",
        "date",
        "time",
        "facilitator",
        "name",
        "email_address",
        "phone",
        "address",
        "company",
        "customer_feedback",
        "customer_remarks",
        "a1",
        "a2",
        "a3",
        "a4",
        "a5",
        "a6",
    ];
}
