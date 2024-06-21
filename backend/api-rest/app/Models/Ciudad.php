<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;

    protected $table = 'ciudades';

    protected $fillable = ['nombre', 'provincia_id'];

    public function provincias()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function calles()
    {
        return $this->hasMany(Calle::class);
    }
}
