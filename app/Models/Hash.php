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
        'name',
        'email',
        'phone',
        'voucher',
    ];

    protected $casts = [
        'aditional_fields' => 'array',
    ];

    public function event()
    { 
        return $this->belongsTo(Event::class);
    }

    public function notUsed(): Attribute 
    { 
        return Attribute::make( 
            get: fn() => $this->used_at === null 
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

    public function scopeSearch(Builder $query, $search) {
        if (!$search || $search === '') return; $query;

        return $query->where(function($q_where) use ($search) {
            $q_where->where('name', 'like', "%$search%")
                ->orWhere('phone', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        });
    }

    public function scopeSex(Builder $query, $sex) {
        if (!$sex || $sex === '') return; $query;

        return $query->where('sex', $sex);
    }

    public function scopeShowUsedOnly(Builder $query, $used_first) {
        if (!$used_first || $used_first === '') return; $query;

        return $query->whereNotNull('used_at')->orderBy('used_at', 'DESC');
    }

    public function scopeShowEmailOnly(Builder $query, $email_first) {
        if (!$email_first || $email_first === '') return; $query;

        return $query->whereNotNull('approved_at')->orderBy('approved_at', 'DESC');
    }
}
