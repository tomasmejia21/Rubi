<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleFile extends Model
{
    use HasFactory;
    protected $table = 'module_files';

    // Definir la relación inversa
    public function module()
    {
        return $this->belongsTo(Module::class, 'moduleId', 'moduleId');
    }
}
