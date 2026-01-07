<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presences extends Model
{
    protected $guarded = ['id'];
    public $fillable = [
        'monitoring_id',
        'date',
        'checkin_time',
        'checkout_time',
        'status',
        'notes',
        'location',
    ];

    public function monitoring()
    {
        return $this->belongsTo(Monitoring::class);
    }
}
