<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\HasFetchAllRenderCapabilities;
use App\Http\Requests\ActorRequest;
use App\Models\Actor;
use Illuminate\Http\Request;
use App\Http\Resources\ActorCollection;
use \App\Http\Resources\MovieCollection;
use \App\Http\Resources\Actor as ActorResource;
use \App\Http\Resources\Genre as GenreResource;


class ActorController extends Controller
{

    use HasFetchAllRenderCapabilities;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->setGetAllBuilder(Actor::query());
        $this->setGetAllOrdering('name', 'asc');
        $this->parseRequestConditions($request);
        return new ActorCollection($this->getAll()->paginate());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActorRequest $request)
    {
        $actor = new Actor($request->validated());
        $actor->save();

        return new ActorResource($actor);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function show(Actor $actor)
    {
        return new ActorResource($actor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function update(Actor $actor, ActorRequest $request)
    {
        $actor->fill($request->validated());
        $actor->save();

        return new ActorResource($actor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Actor $actor)
    {
        $actor->delete();

        return response()->noContent();
    }


    /**
     * Display the specified Actor Movies.
     *
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function movies(Actor $actor)
    {
        return new MovieCollection($actor->movies->unique());
    }

    /**
     * Display the specified Actor Movies.
     *
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function favouriteGenre(Actor $actor)
    {
        return new GenreResource($actor->genres()->groupBy('name')->max()->first());
    }

}
