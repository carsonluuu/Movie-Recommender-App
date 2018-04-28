 +- Folder
     |
     +- readme.txt
     |
     +- team.txt
     |
     +- create.sql
     |
     +- load.sql
     |
     +- queries.sql
     |
     +- query.php
     |
     +- violate.sql

The Movie table: This table describes information regarding movies in the database. It specifies an identification number unique to each movie, the title of the movie, the year the movie was released, the MPAA rating given to the movie, and the production company that produced the movie. The schema of the Movie table is given as follows:

Movie(id, title, year, rating, company)
Name
Type
Description
id
INT
Movie ID
title
VARCHAR(100)
Movie title
year
INT
Release year
rating
VARCHAR(10)
MPAA rating
company
VARCHAR(50)
Production company
The load file for the table is movie.del in the zip file.

The Actor table: This table describes information regarding actors and actresses of movies. It specifies an identification number unique to all people (which is shared between actors and directors), the last name of the person, the first name of the person, the sex of the person, the date of birth of the person, and the date of death of the person if applicable. The schema of the Actor table is given as follow:

Actor(id, last, first, sex, dob, dod)
Name
Type
Description
id
INT
Actor ID
last
VARCHAR(20)
Last name
first
VARCHAR(20)
First name
sex
VARCHAR(6)
Sex of the actor
dob
DATE
Date of birth
dod
DATE
Date of death
There are three load files for the table: actor1.del, actor2.del, and actor3.del. You will have to load each file only once to the table.

The Director table: It describes information regarding directors of movies. It specifies an identification number of the director, the last name of the director, the first name of the director, the date of birth of the director, and the date of death to the director if applicable. The schema of the Director table is given as follow:

Director(id, last, first, dob, dod)
Name
Type
Description
id
INT
Director ID
last
VARCHAR(20)
Last name
first
VARCHAR(20)
First name
dob
DATE
Date of birth
dod
DATE
Date of death
Note that the ID is unique to all people (which is shared between actors and directors). That is, if a person is both an actor and a director, the person will have the same ID both in the Actor and the Director table.

The load file for the table is director.del.

The MovieGenre table: It describes information regarding the genre of movies. It specifies the identification number of a movie, and the genre of that movie. The schema of the MovieGenre table is given as follow:

MovieGenre(mid, genre)
Name
Type
Description
mid
INT
Movie ID
genre
VARCHAR(20)
Movie genre
The load file for the table is moviegenre.del.

The MovieDirector table: It describes the information regarding the movie and the director of that movie. It specifies the identification number of a movie, and the identification number of the director of that movie. The schema of the MovieDirector table is given as follow:

MovieDirector(mid, did)
Name
Type
Description
mid
INT
Movie ID
did
INT
Director ID
The load file for the table is moviedirector.del.

The MovieActor table: It describes information regarding the movie and the actor/actress of that movie. It specifies the identification number of a movie, and the identification number of the actor/actress of that movie. The schema of the MovieActor table is given as follow:

MovieActor(mid, aid, role)
Name
Type
Description
mid
INT
Movie ID
aid
INT
Actor ID
role
VARCHAR(50)
Actor role in movie
The load files for the table are movieactor1.del and movieactor2.del. You will have to load each file only once.

The Review table: Later in Project 1C, you will create a Web interface where the users of your system can add “reviews on a movie (similarly to Amazon product reviews). The Review table stores the reviews added in by the users in the following schema:

Review(name, time, mid, rating, comment)
Name
Type
Description
name
VARCHAR(20)
Reviewer name
time
TIMESTAMP
Review time
mid
INT
Movie ID
rating
INT
Review rating
comment
VARCHAR(500)
Reviewer comment
Each tuple specifies the name of the reviewer, the timestamp of the review, the movie id, the rating that the reviewer gave the movie (i.e., x out of 5), and additional comments the reviewer gave about the movie.
