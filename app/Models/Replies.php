<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Replies extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = ['name','content','user_id','comment_id'];

    public function replies() {
        return $this->belongsTo('App\Models\Replies');
    }
}
