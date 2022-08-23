<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'duration',
        'leave_type',
        'reason',
        'status'
    ];
    // protected $dates = ['start_date', 'end_date', 'request_date'];

    protected $casts = [
    'start_date'     => 'date:d-M-Y',
    'end_date'     => 'date:d-M-Y',
    'created_at'     => 'date:d-M-Y',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    
}