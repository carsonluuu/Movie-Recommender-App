/* 1. Violating Movie ID Primary Key */
INSERT INTO Movie VALUE (2024, "Independence Day 2 sucks", "1996", "PG-13" , "20th Century Fox");
/* Movie ID should be a Primary Key defined, and 2024 is already loaded in the table */
/* ERROR 1062 (23000) at line 2: Duplicate entry '2024' for key 'PRIMARY' */

/* 2. Violating Actor ID Primary Key */
INSERT INTO Actor VALUES (25722, "ss", "xxxx", "Male", "1970-01-01", "1980-01-01");
/* Actor ID should be a Primary Key defined, and 25722 is already loaded in the table */
/* ERROR 1062 (23000) at line 2: Duplicate entry '25722' for key 'PRIMARY' */

/* 3. Violating Director ID Primary Key */
INSERT INTO Director VALUES (58777, "ss", "xxxx", "1970-01-01", "1980-01-01");
/* Director ID should be a Primary Key defined, and 25722 is already loaded in the table */
/* ERROR 1062 (23000) at line 2: Duplicate entry '58777' for key 'PRIMARY' */

/* 4. Violating MovieGenre Foreign Key */
INSERT INTO MovieGenre VALUES (1, "Action");
/* mid does not exist so violating foreign key constraint that mid has to reference Movie.id */
/* ERROR 1452 (23000) at line 2: Cannot add or update a child row: a foreign key constraint fails (`CS143`.`MovieGenre`, CONSTRAINT `MovieGenre_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`)) */

/* 5. Violating MovieDirector Foreign Key */
INSERT INTO MovieDirector VALUES (1,76);
/* mid does not exist so violating foreign key constraint that mid has to reference Movie.id */
/* ERROR 1452 (23000) at line 2: Cannot add or update a child row: a foreign key constraint fails (`CS143`.`MovieDirector`, CONSTRAINT `MovieDirector_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`)) */

/* 6. Violating MovieDirector Foreign Key */
INSERT INTO MovieDirector VALUES (218, 999999);
/* did does not exist so violating foreign key constraint that did has to reference Director.id */
/* ERROR 1452 (23000) at line 2: Cannot add or update a child row: a foreign key constraint fails (`CS143`.`MovieDirector`, CONSTRAINT `MovieDirector_ibfk_2` FOREIGN KEY (`did`) REFERENCES `Director` (`id`)) */

/* 7. Violating MovieActor Foreign Key */
INSERT INTO MovieActor VALUES (1, 36, "human");
/* mid does not exist so violating foreign key constraint that mid has to reference Movie.id */
/* ERROR 1452 (23000) at line 2: Cannot add or update a child row: a foreign key constraint fails (`CS143`.`MovieActor`, CONSTRAINT `MovieActor_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`)) */

/* 8. Violating MovieActor Foreign Key */
INSERT INTO MovieActor VALUES (8, 8, "human");
/* aid does not exist so violating foreign key constraint that aid has to reference Actor.id */
/* ERROR 1452 (23000) at line 2: Cannot add or update a child row: a foreign key constraint fails (`CS143`.`MovieActor`, CONSTRAINT `MovieActor_ibfk_2` FOREIGN KEY (`aid`) REFERENCES `Actor` (`id`)) */

/* 9. Violating CHECK for rating range */
INSERT INTO Review VALUES ("Joker", "1990-01-01 00:00:01", 7, 5, "I so so like the movie!!!!!");
/* mid does not exist so violating foreign key constraint that mid has to reference Movie.id */
/* ERROR 1452 (23000) at line 2: Cannot add or update a child row: a foreign key constraint fails (`CS143`.`Review`, CONSTRAINT `Review_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`)) */


/* 10. Violating CHECK for datediff() not small than 0 */
INSERT INTO Director VALUES (158777, "ss", "xxxx", "1980-01-01", "1970-01-01");
/* dob should be early than dod... so the datediff() value must be positive */
/* ERROR The value of datediff() voilates the CHECK */

/* 11. Violating CHECK for datediff() not small than 0 */
INSERT INTO Actor VALUES (325722, "ss", "xxxx", "Male", "1980-01-01", "1970-01-01");
/* dob should be early than dod... so the datediff() value must be positive */
/* ERROR The value of datediff() voilates the CHECK */

/* 12. Violating CHECK for rating range */
INSERT INTO Review VALUES ("Joker", "1970-01-01 04:00:01", 2024, 100, "I so so like the movie!!!!!");
/* Rating should be 0 <= rating <= 5 */
/* ERROR Violate the constrain 0 <= rating AND rating <= 5 */
