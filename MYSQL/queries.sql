-- the names of all the actors in the movie 'Die Another Day'. 
-- Please also make sure actor names are in this format:  <firstname> <lastname> 
-- (separated by single space, **very important**).

SELECT 
	fullname 
FROM
	MovieActor,
	Movie, 
	(SELECT
		id, CONCAT(first, " ",last) AS fullname
	FROM
		Actor
	) AS actorsFullname
WHERE MovieActor.mid = Movie.id AND MovieActor.aid = actorsFullname.id AND title = 'Die Another Day'
;

-- the count of all the actors who acted in multiple movies
SELECT COUNT(*)
FROM
	(SELECT
		aid, num
	FROM
		(SELECT
			aid, COUNT(aid) AS num
		FROM 
			MovieActor
		GROUP BY aid) AS temp_table 
	WHERE 
		num > 1 ) AS temp
	;


-- list the each genre and counts and order the result
SELECT genre, count(genre) AS counts
FROM MovieGenre
GROUP BY genre
ORDER BY counts DESC;

-- The director had the most movies
SELECT did, count(mid) as counts
FROM MovieDirector
GROUP BY did
ORDER BY counts DESC LIMIT 1;

-- The actor had the most movies roled
SELECT aid, count(mid) as counts
FROM MovieActor
GROUP BY aid
ORDER BY counts DESC LIMIT 1;



