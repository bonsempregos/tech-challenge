<?php

namespace App\Models;

use App\Models\Traits\PrimaryAsUuid;
use Illuminate\Database\Eloquent\Model;


class Movie extends Model
{
    use PrimaryAsUuid;

    public $incrementing = false;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    protected $fillable = ['name', 'year', 'synopsis', 'runtime', 'released_at', 'cost'];

    public function actors(){
        return $this->belongsToMany(\App\Models\Actor::class, \App\Models\MovieRole::class)->withTimestamps()->withPivot('name');
    }

    public function genres(){
        return $this->belongsToMany(\App\Models\Genre::class, \App\Models\GenreMovie::class)->withTimestamps();
    }
}
