<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryTrack extends Model
{
    use HasFactory;

    protected $table = 'history_track';
    protected $primaryKey = 'id_ht';
    public $timestamps = false; 

    public function indikatorj()
    {
        return $this->belongsTo(Indikator::class, 'indikator');
    }

    public function ternak_track()
    {
        return $this->belongsTo(TrackTernak::class, 'id_tp');
    }
}
