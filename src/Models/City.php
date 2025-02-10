<?php

namespace Tuna976\CSC\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name', 'state_id', 'zip_code'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
