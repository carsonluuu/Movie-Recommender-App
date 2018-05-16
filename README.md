# Movie-Database-Web-App

The project is to build a Web site on movies, actors and their reviews, supported by a relational database system. The system manages all of its data at the back-end in a MySQL database and provides a Web interface to the users at the front-end.

I used the MySQL DBMS and the Linux operating system and the PHP programming language to access MySQL and the Apache2 Web server to provide a Web interface. Apache and PHP is one of the most popular method these days to implement a database-backed server for a small-to-medium scale Web site.

## MySQL
    create.sql and load.sql

## Four input pages:
	page_l1.php: A page that lets users to add actor and/or director information. Here are some name examples: X.M.L Smith, J'son Lee, etc.
	page_l2.php: A page that lets users to add movie information.
	Some name examples: Beware the BLOB -- A Sequel, Willy Wonka and the Chocolate Factory
	page_l3.php: A page that lets users to add "actor to movie" relation(s). i.e. Ryan Rosario stars in Alice in Wonderland (as the Madhatter, of course!)
	page_l4.php: A page that lets users to add "director to movie" relation(s). i.e. Johnny Depp directs Alice in Wonderland

## Comment pages:
    comment.php: A page can select a movie and give comment
    comment_movie.php: A jump page from a movie info page to give comment for THIS movie

## Show pages:
    show_actor.php: page that shows actor info
    show_movie.php: page that shows movie info

## Search pages:
    search_all.php: return result of BOTH movies and actors
    search_movie.php: return result of movies only
    search_actor.php: return result of actor only

## Other:
    index.php: landing page
    landing.css langing page css file
    hearder.php: for nav bar and head includes
    about.php: personal info

## Asset:
    contains required frameworks
    -bootstrap.min.css
    -jquery-3.3.1.min.js
    -popper.min.js
    -bootstrap.min.js

## Pic:
    landing page slide show image

<a href="http://www.youtube.com/watch?feature=player_embedded&v=9itAJ-hcCq4E" target="_blank"><img src="http://img.youtube.com/vi/9itAJ-hcCq4EE/0.jpg"  alt="Demo" width="240" height="180" border="10" /></a>
