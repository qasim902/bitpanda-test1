<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class userModel extends Model
{
    protected $table = 'users';

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function nationality()
    {
        return $this->hasOneThrough(nationalityModel::class, userDetailsModel::class,'user_id','id','id','citizenship_country_id');
    }

    public function details(){
        return $this->hasOne(userDetailsModel::class,'user_id','id');
    }
}
