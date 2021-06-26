<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    use HasFactory;

    protected $table = 'indikator';
    protected $primaryKey = 'id_indikator';
    public $timestamps = false; 

    public function track_ternak()
    {
        return $this->hasMany(TrackTernak::class, 'id_indikator');
    }

    public function history()
    {
        return $this->hasMany(HistoryTrack::class, 'id_indikator');
    }
}
