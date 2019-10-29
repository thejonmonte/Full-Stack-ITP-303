-- Display albums that have the word “on” somewhere in the album title. Sort results in alphabetical order by album title.
SELECT * FROM albums
WHERE title LIKE '%on%'
ORDER BY title;

-- Same as #1, but only show album title and artist name (no artist_id) columns.
SELECT albums.title, artists.name
FROM albums
	JOIN artists
    ON albums.artist_id = artists.artist_id
WHERE albums.title LIKE '%on%'
ORDER BY title;

-- Display tracks that have ‘AAC audio file’ format. Only show track name (aliased as track_name), 
-- composer, media type name (aliased as media_type), and unit price columns.
SELECT tracks.name AS track_name, tracks.composer, media_types.name AS media_type, tracks.unit_price
FROM tracks
	JOIN media_types
    ON tracks.media_type_id = media_types.media_type_id
WHERE media_types.name = 'AAC audio file';

-- Display R&B/Soul and Jazz tracks that have a composer (not NULL). Sort results in reverse-alphabetical
-- order by track name. Only show track ID, track name (track_name), composer, milliseconds, and genre name (genre_name) columns.
SELECT tracks.track_id, tracks.name AS track_name, tracks.composer, tracks.milliseconds, genres.name AS genre_name
FROM tracks
	JOIN genres
    ON tracks.genre_id = genres.genre_id
WHERE composer IS NOT NULL AND (genres.name = 'R&B/Soul' OR genres.name = 'Jazz')
ORDER BY tracks.name DESC;