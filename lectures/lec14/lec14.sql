-- Add album 'Fight On' by artist 'Spirit of Troy'
INSERT INTO albums (title, artist_id)
VALUES ('Fight On', (
SELECT artist_id FROM artists
WHERE name = 'Spirit of Troy'));

-- Get the artist_id of 'Spirit of Troy'
SELECT 
    *
FROM
    artists
WHERE
    name LIKE '%spirit%';
-- There is no artist 'Spirit of Troy' so let's add one
INSERT INTO artists (name)
VALUES ('Spirit of Troy');
-- Appends to end of list

SELECT 
    *
FROM
    albums
ORDER BY album_id DESC;

-- Update track 'All my Love' composed by E. Schrody to be part of the Fight On Album and be composed
-- by Tommy Trojan
UPDATE tracks 
SET 
    composer = 'Tommy Trojan',
    album_id = 348
WHERE
    name = 'All My Love' AND track_id = 3316;

SELECT 
    *
FROM
    tracks
WHERE
    name = 'All my Love' AND track_id = 3316;


-- DELETE the album Fight On
SELECT 
    *
FROM
    albums
WHERE
    album_id = 348;

DELETE FROM albums 
WHERE
    album_id = 348;

-- Throws an error: must delete all tracks in album first

UPDATE tracks 
SET 
    album_id = NULL
WHERE
    track_id = 3316;

SELECT 
    *
FROM
    albums;

-- Create a view that displays all albums and their artist names
-- Only show album id, album title, and artist name
-- Can call the view anything you want
CREATE OR REPLACE VIEW album_artists AS
    SELECT 
        album_id, title, name
    FROM
        albums
            JOIN
        artists ON albums.artist_id = artists.artist_id;
        
-- "Call" the view
SELECT 
    *
FROM
    album_artists;
    
-- Delete views
DELETE VIEW FROM album_artists;

-- AGGREGATE FUNCTIONS
-- How many tracks are in my DB
SELECT 
    COUNT(*), COUNT(composer)
FROM
    tracks;

-- Min/Max/Avg
-- In tracks table, what's the min/max/average/sum milliseconds?
SELECT 
    MAX(milliseconds),
    MIN(milliseconds),
    AVG(milliseconds),
    SUM(milliseconds)
FROM
    tracks;

-- How long is a specific album?
SELECT 
    SUM(milliseconds)
FROM
    tracks
WHERE
    album_id = 2;
    
-- Generate random number
SELECT RAND();    

-- Order tracks by random
SELECT * FROM tracks
ORDER BY RAND();

-- How long is the shortest track for EACH album
SELECT tracks.album_id, albums.title, MIN(milliseconds)
FROM tracks
JOIN albums
	ON tracks.album_id = albums.album_id
GROUP BY album_id;

-- For each artist, show artists and number of their albums
SELECT albums.artist_id, artists.name, COUNT(*)
FROM albums
JOIN artists
	ON albums.artist_id = artists.artist_id
GROUP BY albums.artist_id;