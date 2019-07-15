<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Rules\DateAndTitleUnique;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        return $this->search($title = $request->input('title'), $next = $request->input('next'), $skip = $request->input('skip'));
    }

    public function search($title, $next = false, $skip = 0)
    {
        $length = Movie::get()->count();

        if ($next){
            return Movie::where('title', 'LIKE', '%'.$title.'%')->skip($skip)->take($next)->get();
        }
        else if($skip){
            return Movie::where('title', 'LIKE', '%'.$title.'%')->skip($skip)->take($length)->get();
        }   

        return Movie::where('title', 'LIKE', '%'.$title.'%')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $movie = new Movie();

        //Ne treba ovako
        $this->validate($request, ['title' => new DateAndTitleUnique($request->input('releaseDate'))]);

        $request->duration = intval($request->duration);
        
        $this->validate($request, Movie::STORE_RULES);

        $movie->title = $request->input('title');
        $movie->director = $request->input('director');
        $movie->imageUrl = $request->input('imageUrl');
        $movie->duration = $request->input('duration');
        $movie->releaseDate = $request->input('releaseDate');
        $movie->genre = $request->input('genre');

        $movie->save();

        return $movie;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Movie::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $movie = Movie::find($id);

        $this->validate($request, ['title' => new DateAndTitleUnique()]);

        $request->duration = intval($request->duration);

        $this->validate(request(), Movie::STORE_RULES);

        $movie->title = $request->input('title');
        $movie->director = $request->input('director');
        $movie->imageUrl = $request->input('imageUrl');
        $movie->duration = $request->input('duration');
        $movie->releaseDate = $request->input('releaseDate');
        $movie->genre = $request->input('genre');

        $movie->save();

        return $movie;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);

        $movie->delete();

        return 'Movie ' . $movie->title . ' succesfully deleted!';
    }
    
    private function dateAndTitleUnique(){

    }
}
