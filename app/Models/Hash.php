<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hash extends Model
{
    use HasFactory;

    protected $fillable = [
        'hash',
        'file',
        'voucher',
        'was_used',
        'approved_at',
    ];

    public function user()
    { 
        return $this->belongsTo(User::class);
    }

    public function notUsed(): Attribute 
    { 
        return Attribute::make( 
            get: fn() => $this->was_used != 1 
        );
    }

    public function notAssigned(): Attribute 
    { 
        return Attribute::make( 
            get: fn() => $this->user_id === null
        );
    }

    public function assigned(): Attribute 
    { 
        return Attribute::make( 
            get: fn() => !$this->not_assigned
        );
    }

    public function notVoucher(): Attribute 
    { 
        return Attribute::make( 
            get: fn() => $this->voucher === null
        );
    }

    public function scopeFilterHash(Builder $query, ?string $hash) 
    { 
        if($hash !== null)
            return $query->where('hash', $hash);
    }
}
