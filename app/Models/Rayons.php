<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rayons extends Model
{
    use HasFactory;

    protected $fillable = [
        'rayon',
        'user_id',
    ];
    public function user(){
        return $this->belongsTo(Users::class , 'user_id', 'id');
    }
    public function student(){
        return $this->belongsTo(Students::class , 'rayon_id', 'id');
    }
}
