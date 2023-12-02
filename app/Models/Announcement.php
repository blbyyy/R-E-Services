<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = ['title','content','user_id'];

    protected $dates = ['created_at'];

    public function announcementsphoto() {
        return $this->hasMany('App\Models\AnnouncementsPhoto','announcements_id');
    }

    public function announcementcomments() {
        return $this->hasMany('App\Models\Comment','announcements_id');
    }

}
