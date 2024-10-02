<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    protected $table = 'modules';
    protected $primaryKey = 'moduleId';

    // Relación uno a muchos con ModuleFile
    public function files()
    {
        return $this->hasMany(ModuleFile::class, 'moduleId', 'moduleId');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'moduleId', 'moduleId');
    }
}
