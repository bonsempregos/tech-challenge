<?php

namespace App\Models;

use App\Models\Traits\PrimaryAsUuid;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use PrimaryAsUuid;

    public $incrementing = false;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    protected $fillable = ['name', 'bio', 'born_at'];

    public function movies(){
        return $this->belongsToMany(\App\Models\Movie::class, \App\Models\MovieRole::class)->withTimestamps()->withPivot('name');
    }
}
