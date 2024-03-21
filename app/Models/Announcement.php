<?php

namespace App\Models;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'announcements';
    public function course() {
        return $this->belongsTo('App\Models\Course');
    }
}
