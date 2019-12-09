<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;

class SongController extends Controller
{
	public function searchForm() {
		// When user goes to home page, run this code before showing the view

		// Connect to the database and get all genres from the genre table
		$genre = new Genre();

		// Pass all the genres to the view. The view will display the genres as a dropdown.
		// Second parameter is an associative array of keys/values to pass to the view
		return view('search_form', [
			'genres' => $genre->all(),
			'info' => 'Hello!!!!!!!']);
	}

	public function search() {

		// Get any user input (genre or track name)
		// Equivalent to $_GET['track_name']
		$track_name = request('track_name');
		$genre = request('genre');

		$track = new Track();

		$results = $track->select('tracks.name AS track_name', 'composer', 'genres.name AS genre');

		if( isset($track_name) && !empty($track_name) ) {
			$results = $results->where('tracks.name', 'LIKE' , '%' . $track_name .'%');
		}
		if( isset($genre) && !empty($genre) ) {
			$results = $results->where('tracks.genre_id', '=' , $genre);
		}
		$results = $results->leftJoin('genres', 'tracks.genre_id', '=', 'genres.genre_id');


		return view('search_results', [
			'tracks' => $results->get()
		]);

	}
}

?>