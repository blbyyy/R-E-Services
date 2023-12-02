<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public $table = 'comments';

    protected $guarded = ['id'];

    protected $fillable = ['name','content','user_id','announcement_id'];

    public function comments() {
        return $this->belongsTo('App\Models\Comment');
    }

    public function repliescomments() {
        return $this->hasMany('App\Models\Replies','comment_id');
    }
}
