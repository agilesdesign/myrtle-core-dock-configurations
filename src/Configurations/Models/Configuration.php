<?php

namespace Myrtle\Core\Configurations\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $casts = ['options' => 'array'];

    protected $fillable = ['group', 'options'];

    public function scopeByGroup($query, $group)
    {
        return $query->where('group', $group);
    }
}
