<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'start_date', 'end_date', 'description',
    ];

    public function hashes() {
        return $this->hasMany(Hash::class);
    }
}
