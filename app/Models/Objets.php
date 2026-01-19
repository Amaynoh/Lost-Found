<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objets extends Model
{
    use HasFactory;
    protected $table = 'objets';
    protected $fillable = [
        'title',
        'description',
        'type',
        'location',
        'date',
        'image',
        'status',
        'user_id',
    ];
     public function user()
    {
        return $this->belongsTo(User::class);
    }
}
