<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extension extends Model
{
    use HasFactory;

    public $table = 'extension';

    protected $fillable = [
        "name",
        "appointment1_id",
        "mou_file",
        "beneficiary",
        "ppmp_file",
        "pr_file",
        "do_email",
        "ues_email",
        "president_email",
        "moa_file",
        "board_email",
        "osg_email",
        "proponents1",
        "proponents2",
        "proponents3",
        "proponents4",
        "proponents5",
        "implementation_proper",
        "topics",
        "subtopics",
        "appointment2_id",
        "appointment2_id",
        "post_evaluation_attendance",
        "evaluation_form",
        "capsule_detail",
        "certificate",
        "attendance",
        "status",
        "user_id",
    ];
}
