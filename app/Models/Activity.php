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
}
