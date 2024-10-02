<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalInstitution extends Model
{
    use HasFactory;
    protected $table = 'educational_institutions';
    protected $primaryKey = 'institutionalId';
    protected $fillable = ['institutionalId', 'name', 'address', 'city', 'country', 'status'];
}