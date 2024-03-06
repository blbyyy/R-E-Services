<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestAccess extends Model
{
    use HasFactory;

    public $table = 'request_access';

    protected $fillable = [
        "requestor_id",
        "requestor_type",
        "research_title",
        "purpose",
        "status",
        "file",
    ];

}
