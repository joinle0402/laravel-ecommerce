<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasFactory;

    private $display_name;
    private $group;

    public function getDisplayNameAttribute()
    {
        return $this->attributes['display_name'];
    }

    public function setDisplayNameAttribute($value)
    {
        $this->attributes['display_name'] = $value;
    }

    public function getGroupAttribute()
    {
        return $this->attributes['group'];
    }

    public function setGroupAttribute($value)
    {
        $this->attributes['group'] = $value;
    }

    protected $fillable = [
        'name',
        'display_name',
        'group',
        'guard_name',
    ];
}
