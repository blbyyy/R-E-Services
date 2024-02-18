<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    public $table = "faculty";
    public $timestamps = false;
    public $primaryKey = "id";
    public $guarded = [
        "id"
    ];

    protected $fillable = [
        "fname",
        "lname",
        "mname",
        "department",
        "tup_id",
        "email",
        "gender",
        "phone",
        "address",
        "birthdate",
        "avatar",
        "user_id"
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
