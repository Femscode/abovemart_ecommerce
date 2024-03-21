<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminAccess extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'admin_accesses';
    protected $casts = [
        'access' => 'array'
    ];
    public function admin() {
        return $this->belongsTo(User::class,'admins','id');
    }
    public function course() {
        return $this->belongsTo(Course::class,'course_id','id');
    }
}
