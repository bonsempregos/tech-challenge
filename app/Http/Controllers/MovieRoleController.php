<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\HasFetchAllRenderCapabilities;
use App\Http\Requests\MovieRoleRequest;
use App\Models\MovieRole;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MovieRoleController extends Controller
{

    use HasFetchAllRenderCapabilities;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->setGetAllBuilder(MovieRole::query());
        $this->setGetAllOrdering('name', 'asc');
        $this->parseRequestConditions($request);
        return new ResourceCollection($this->getAll()->paginate());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovieRoleRequest $request)
    {
        $movieRole = new MovieRole($request->validated());
        $movieRole->save();

        return new \App\Http\Resources\MovieRole($movieRole);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MovieRole  $movieRole
     * @return \Illuminate\Http\Response
     */
    public function show(MovieRole $movieRole)
    {
        return new \App\Http\Resources\MovieRole($movieRole);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MovieRole  $movieRole
     * @return \Illuminate\Http\Response
     */
    public function update(MovieRole $movieRole, MovieRoleRequest $request)
    {
        $movieRole->fill($request->validated());
        $movieRole->save();

        return new \App\Http\Resources\MovieRole($movieRole);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MovieRole  $movieRole
     * @return \Illuminate\Http\Response
     */
    public function destroy(MovieRole $movieRole)
    {
        $movieRole->delete();

        return response()->noContent();
    }
}
