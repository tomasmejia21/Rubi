<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Response;

class Activity extends Model
{
    use HasFactory;
    protected $primaryKey = 'activityId';
    protected $table = 'activities';

    public function responses()
    {
        return $this->hasMany('App\Models\Response', 'activity_id');
    }

    public function module()
    {
        return $this->belongsTo('App\Models\Module', 'moduleId');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_activities', 'activityId', 'userId');
    }
}
