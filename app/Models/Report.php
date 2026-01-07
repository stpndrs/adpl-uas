<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $guarded = ['id'];
    public $fillable = [
        'monitoring_id',
        'date',
        'file',
        'comment',
        'status',
    ];

    public function monitoring() {
        return $this->belongsTo(Monitoring::class);
    }
}
