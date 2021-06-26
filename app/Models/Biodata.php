<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;
    
    protected $table = 'biodata';
    protected $primaryKey = 'id_bio';
    public $timestamps = false; 


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
