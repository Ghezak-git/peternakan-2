<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusKep extends Model
{
    use HasFactory;
    protected $table = 'skala_kepemilikan';
    protected $primaryKey = 'id_sp';
    public $timestamps = false; 


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}
