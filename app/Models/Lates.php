<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lates extends Model
{
    use HasFactory;

    protected $table = 'lates';

    protected $fillable = [
        'student_id',
        'date_time_late',
        'information',
        'bukti',
    ];
    public function student(){
        return $this->belongsTo(Students::class , 'student_id', 'id');
    }
}
