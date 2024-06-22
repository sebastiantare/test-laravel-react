<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;

    protected $table = 'ciudades';

    protected $fillable = ['nombre', 'provincia_id'];

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function calle()
    {
        return $this->hasMany(Calle::class);
    }
}
