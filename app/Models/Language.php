<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Language extends Model
{
    use SoftDeletes, Userstamps;

    protected $guarded = [ 'id' ];

    public function scopeIsActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeIsDefault($query)
    {
        return $query->where('is_default', true);
    }
}
