<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $table = 'location';
    protected $primaryKey = 'location_id';
    public $timestamps = false; 


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
