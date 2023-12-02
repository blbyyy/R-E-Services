<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    public $table = 'certificates';

    protected $guarded = ['id'];

    protected $fillable = ['control_id','certificate_file'];

}
