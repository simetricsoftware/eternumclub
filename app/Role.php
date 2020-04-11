<?php

namespace App;

use Spatie\Permission\Models\Role as BaseModel;

class Role extends BaseModel
{
    public function scopeSearch($query, $keyword) {
        if($keyword){
            return $query->where('name', 'like', "%$keyword%")
            ->orWhere('description', 'like', "%$keyword%");
        }
    }
}
