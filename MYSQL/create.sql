-- DROP TABLE IF EXISTS MovieGenre;
-- DROP TABLE IF EXISTS MovieDirector;
-- DROP TABLE IF EXISTS MovieActor;
-- DROP TABLE IF EXISTS Review;
-- DROP TABLE IF EXISTS MaxPersonID;
-- DROP TABLE IF EXISTS MaxMovieID;

-- DROP TABLE IF EXISTS Movie;
-- DROP TABLE IF EXISTS Actor;
-- DROP TABLE IF EXISTS Director;

CREATE TABLE Movie  (
	id		 	INT NOT NULL,
	title		VARCHAR(100) NOT NULL,
	year		INT,
	rating 		VARCHAR(10),
	company		VARCHAR(50),
	PRIMARY KEY (id)
	/* primary key constraints */
	)
ENGINE = INNODB;

CREATE TABLE Actor (
	id 		INT NOT NULL,
	last 	VARCHAR(20),
	first 	VARCHAR(20),
	sex 	VARCHAR(6),
	dob		DATE NOT NULL,
	dod 	DATE,
	PRIMARY KEY (id),
	/* primary key constraints */
	CHECK (DATEDIFF(dob, dod) >= 0)
	/*The value of substraction must not be negative, using DATEDIFF() from HW1 */
	)
ENGINE = INNODB;

CREATE TABLE Director  (
	id 		INT NOT NULL,
	last 	VARCHAR(20),
	first 	VARCHAR(20),
	dob		DATE,
	dod 	DATE,
	PRIMARY KEY (id),
	/* primary key constraints */
	CHECK (DATEDIFF(dob, dod) >= 0)
	/*The value of substraction must not be negative, using DATEDIFF() from HW1 */
	)
ENGINE = INNODB;

CREATE TABLE MovieGenre  (
	mid 	INT NOT NULL,
	genre 	VARCHAR(20),
	FOREIGN KEY (mid) REFERENCES Movie(id)
	/* mid is foreign key */
	)
ENGINE = INNODB;

CREATE TABLE MovieDirector  (
	mid 	INT NOT NULL,
	did 	INT NOT NULL,
	FOREIGN KEY (mid) REFERENCES Movie(id),
	FOREIGN KEY (did) REFERENCES Director(id)
	/* mid is foreign key */
	/* did is foreign key */
	)
ENGINE = INNODB;

CREATE TABLE MovieActor  (
	mid 	INT NOT NULL,
	aid 	INT NOT NULL,
	role	VARCHAR(50),
	FOREIGN KEY (mid) REFERENCES Movie(id),
	FOREIGN KEY (aid) REFERENCES Actor(id)
	/* mid is foreign key */
	/* aid is foreign key */
	)
ENGINE = INNODB;

CREATE TABLE Review  (
	name 	VARCHAR(20) NOT NULL,
	time 	TIMESTAMP NOT NULL,
	mid 	INT NOT NULL,
	rating 	INT NOT NULL,
	comment VARCHAR(500) NOT NULL,	
	FOREIGN KEY (mid) REFERENCES Movie(id),
	/* mid is foreign key */
 	CHECK (0 <= rating AND rating <= 5)
 	/*The value of rating must be in the range from 0 to 5*/
	)
ENGINE = INNODB;

CREATE TABLE MaxPersonID  (
	id INT NOT NULL
	)
ENGINE = INNODB;

CREATE TABLE MaxMovieID  (
	id INT NOT NULL
	)
ENGINE = INNODB;