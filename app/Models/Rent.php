<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = ['user_id', 'car_id', 'start_date', 'end_date','pj_satu','pj_dua','status'];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pjSatu()
    {
        return $this->belongsTo(User::class, 'pj_satu');
    }

    public function pjDua()
    {
        return $this->belongsTo(User::class, 'pj_dua');
    }
}
