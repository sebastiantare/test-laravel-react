<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $table = 'regiones';
    protected $primaryKey = 'id';

    protected $fillable = ['nombre'];

    public function provincia()
    {
        return $this->hasMany(Provincia::class);
    }
}
