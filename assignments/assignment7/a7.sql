-- Part 1: Football Schedule Database

-- 1. Create a view football_schedule that displays full schedule in chronological order. 
-- Show day, date, home team, away team, and venue.

CREATE OR REPLACE VIEW football_schedule AS
	SELECT days.day, schedule.date, home.team AS home, away.team AS away, venues.venue
	FROM schedule
	JOIN days
		ON schedule.day_id = days.id
	JOIN teams as home
		ON schedule.home_team_id = home.id
	JOIN teams as away
		ON schedule.away_team_id = away.id
	JOIN venues
		ON schedule.venue_id = venues.id
	ORDER BY date;

-- 2. Add two games below. Note: Folsom Field is a new venue.
INSERT INTO venues (venue)
	VALUES ('Folsom Field');
INSERT INTO schedule (date, day_id, venue_id, away_team_id, home_team_id)
	VALUES (
    '2017-11-18',
    (
		SELECT id FROM days
        WHERE day = 'Sat'
    ),
    (
		SELECT id FROM venues
        WHERE venue = 'Folsom Field'
	),
    (
		SELECT id FROM teams
		WHERE team = 'UCLA Bruins'
	),
    (
		SELECT id FROM teams
        WHERE team = 'Colorado Buffaloes'
	)
);
INSERT INTO schedule (date, day_id, venue_id, away_team_id, home_team_id)
	VALUES (
    '2017-11-18',
    (
		SELECT id FROM days
        WHERE day = 'Sat'
    ),
    (
		SELECT id FROM venues
        WHERE venue = 'Reser Stadium'
	),
    (
		SELECT id FROM teams
		WHERE team = 'Arizona State Sun Devils'
	),
    (
		SELECT id FROM teams
        WHERE team = 'Oregon State Beavers'
	)
);

-- 3. Make the following changes to 2017-11-18 game between Colorado Buffaloes and UCLA Bruins
UPDATE schedule
SET 
    date = '2017-11-11',
    away_team_id = (
		SELECT id FROM teams
        WHERE team = 'USC Trojans'
    )
WHERE
	date = '2017-11-18' AND
    away_team_id = (
		SELECT id FROM teams
        WHERE team = 'UCLA Bruins'
    ) AND
    home_team_id = (
		SELECT id FROM teams
        WHERE team = 'Colorado Buffaloes'
    )
;

-- 4. Delete 2017-11-18 game between Oregon State Beavers
-- and Arizona State Sun Devils from the database.
DELETE FROM schedule
WHERE 
	date = '2017-11-18' AND
    home_team_id = (
		SELECT id FROM teams
        WHERE team = 'Oregon State Beavers'
    ) AND
    away_team_id = (
		SELECT id FROM teams
        WHERE team = 'Arizona State Sun Devils'
    )
;

-- 5. Display all venues and number of times each venue is used in
-- game_count column. Use an aggregate function.
SELECT venues.id, venues.venue, COUNT(*) AS game_count
FROM venues
	JOIN schedule
		ON venues.id = schedule.venue_id
GROUP BY venues.id;

-- Part 2: DVD Database

-- 1. Create a view dramas that displays all drama DVDs with release date
-- not set to NULL. Show DVD ID, DVD title, release date, award, format, genre, label, rating, and sound.
CREATE OR REPLACE VIEW dramas AS
	SELECT dvd.dvd_title_id, dvd.title, dvd.release_date, dvd.award, formats.format, genres.genre, labels.label, ratings.rating, sounds.sound
	FROM dvd_titles AS dvd
    JOIN formats
		ON dvd.format_id = formats.format_id
	JOIN genres
		ON dvd.genre_id = genres.genre_id
	JOIN labels
		ON dvd.label_id = labels.label_id
	JOIN ratings
		ON dvd.rating_id = ratings.rating_id
	JOIN sounds
		ON dvd.sound_id = sounds.sound_id
	WHERE dvd.release_date IS NOT NULL AND genres.genre = 'Drama'
    ORDER BY dvd.dvd_title_id;

-- 2. Add the movie below:
INSERT INTO dvd_titles(title, release_date, award, label_id, sound_id, genre_id, rating_id, format_id)
VALUES (
	'The Godfather',
    '1972-03-24',
    '45th Academy Award for Best Picture',
    (
		SELECT label_id FROM labels
        WHERE label = 'Paramount'
    ),
	(
		SELECT sound_id FROM sounds
        WHERE sound = 'DTS'
    ),
    (
		SELECT genre_id FROM genres
        WHERE genre = 'Drama'
    ),
    (
		SELECT rating_id FROM ratings
        WHERE rating = 'R'
    ),
    (
		SELECT format_id FROM formats
        WHERE format = 'Fullscreen, Widescreen'
	)
);

-- 3. Make the following changes to the DVD titled Zero Effect:
-- New Label: Columbia TriStar
-- New Genre: Comedy
-- New Format: Fullscreen
UPDATE dvd_titles
SET 
    label_id = (
		SELECT label_id FROM labels
        WHERE label = 'Columbia TriStar'
    ),
    genre_id = (
		SELECT genre_id FROM genres
        WHERE genre = 'Comedy'
    ),
    format_id = (
		SELECT format_id FROM formats
        WHERE format = 'Fullscreen'
    )
WHERE
	title LIKE '%Zero Effect%';

-- 4. Delete Major League 3: Back To The Minors from the database.
DELETE FROM dvd_titles
WHERE
	title LIKE '%Major League 3%';

-- 5. Display number of characters for the longest and shortest title in the database. 
-- Name columns longest_title and shortest_title respectively. Use aggregate functions.
SELECT MAX(count_title) AS longest_title, MIN(count_title) AS shortest_title
FROM (
SELECT CHAR_LENGTH(title) AS count_title
FROM dvd_titles) 
AS count_dvd_titles;

-- 6. Display all genres and number of DVDs belonging to each genre as dvd_count column.
-- Show genre ID, genre name, and DVD count. Use an aggregate function.
SELECT genres.genre_id, genres.genre, COUNT(dvd_titles.title) AS dvd_count
FROM genres
	JOIN dvd_titles
    ON genres.genre_id = dvd_titles.genre_id
GROUP BY genres.genre_id;