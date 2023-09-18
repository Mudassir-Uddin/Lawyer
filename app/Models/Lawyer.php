<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lawyer extends Model
{
    use HasFactory;

    
    protected $table = "lawyere";
    protected $primaryKey = "id";

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }    
}
