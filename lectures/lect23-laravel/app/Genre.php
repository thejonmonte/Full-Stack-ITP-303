<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
	// Define a Genre class that maps to the genres table in the DB
	protected $table = 'genres';
	protected $primaryKey = 'genre_id';
}

?>