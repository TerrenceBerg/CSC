<?php
namespace Tuna976\csc\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name', 'iso_code', 'phone_code'];

    public function states()
    {
        return $this->hasMany(State::class);
    }
}
