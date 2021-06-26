<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackTernak extends Model
{
    use HasFactory;

    protected $table = 'track_peternakan';
    protected $primaryKey = 'id_tp';
    public $timestamps = false; 


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    
    public function indikatorj()
    {
        return $this->belongsTo(Indikator::class, 'indikator');
    }

    public function history()
    {
        return $this->hasMany(HistoryTrack::class, 'id_tp');
    }
}
