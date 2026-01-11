<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    protected $guarded = ['id'];
    public $fillable = [
        'student_id',
        'company_id',
        'teacher_id',
        'start_date',
        'end_date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function attendances()
    {
        return $this->hasMany(Presences::class);
    }
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
