<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    protected $fillable =[ 'user_id', 'user_agent', 'ip', 'url', 'action', 'url'];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
