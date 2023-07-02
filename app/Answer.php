<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'response',
        'question_id',
        'voucher_id',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function assistant()
    {
        return $this->belongsTo(Assistant::class);
    }
}
