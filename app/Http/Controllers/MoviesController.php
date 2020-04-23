<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;

class MoviesController extends Controller
{
    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/popular?api_key=f58db137115b5ace10ffab5475c4d2fb')
            ->json()['results'];

        $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/now_playing?api_key=f58db137115b5ace10ffab5475c4d2fb')
            ->json()['results'];

        $genres = Http::get('https://api.themoviedb.org/3/genre/movie/list?api_key=f58db137115b5ace10ffab5475c4d2fb')
            ->json()['genres'];

        // $genres = collect($genresArray)->mapWithKeys(function($genre) {
        //     return [$genre['id'] => $genre['name']];
        // });

        // return view('index', [
        //     'popularMovies' => $popularMovies,
        //     'nowPlayingMovies' => $nowPlayingMovies,
        //     'genres' => $genres
        // ]);

        $viewModel = new MoviesViewModel(
            $popularMovies,
            $nowPlayingMovies,
            $genres
        );

        return view('movies.index', $viewModel );
    }

    public function create()
    {
        //
    }
    
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //https://api.themoviedb.org/3/movie/481848?append_to_response=credits,videos,images&api_key=f58db137115b5ace10ffab5475c4d2fb
        $movie = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/'.$id.'?append_to_response=credits,videos,images'.'&api_key=f58db137115b5ace10ffab5475c4d2fb')
            ->json();

        // dump($movie);

        $viewModel = new MovieViewModel($movie);

        return view('movies.show', $viewModel);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
