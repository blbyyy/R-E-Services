<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultyRequestAccess extends Model
{
    use HasFactory;

    public $table = "faculty_request_access";

    protected $fillable = [
        "requestor_id",
        "requestor_type",
        "research_id",
        "purpose",
        "status",
        "start_access_date",
        "end_access_date"
    ];
}
