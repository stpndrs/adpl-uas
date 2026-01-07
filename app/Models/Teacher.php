<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $guarded = ['id'];
    public $fillable = [
        'name',
        'address',
        'gender',
        'nip',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
