<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;

    protected $table = 'provincias';

    protected $fillable = ['nombre', 'region_id'];

    public function regiones()
    {
        return $this->belongsTo(Region::class);
    }

    public function ciudades()
    {
        return $this->hasMany(Ciudad::class);
    }
}
