<?php

namespace App\Models;

use App\Models\Traits\PrimaryAsUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Actor extends Model
{
    use PrimaryAsUuid;

    public $incrementing = false;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    protected $fillable = ['name', 'bio', 'born_at'];

    public function movies(){
        return $this->belongsToMany(\App\Models\Movie::class, \App\Models\MovieRole::class);
    }

    public function genres(){
        return collect( DB::table('genre_movie')->whereIn('movie_id', $this->movies->pluck('id'))->join('genres', 'id', 'genre_movie.genre_id')->get() );
    }

}
