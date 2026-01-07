<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $guarded = ['id'];
    public $fillable = [
        'name',
        'address',
        'phone',
        'limit',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
