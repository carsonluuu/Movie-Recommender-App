# Movie Recommender System

## Overview
In this project, I built a movie recommender system based on Item Collaborative Filtering using Hadoop MapReduce in Java.


## Data
Data comes from the training dataset of Netflix Prize Challenge. The following is the information from its README.

#### Training dataset file description

The file "training_set.tar" is a tar of a directory containing 17770 files, one
per movie.  The first line of each file contains the movie id followed by a
colon.  Each subsequent line in the file corresponds to a rating from a customer
and its date in the following format:

CustomerID,Rating,Date

- MovieIDs range from 1 to 17770 sequentially.
- CustomerIDs range from 1 to 2649429, with gaps. There are 480189 users.
- Ratings are on a five star (integral) scale from 1 to 5.
- Dates have the format YYYY-MM-DD.

#### Data preprocessing

I preprocessed the original dataset in two steps:

1. Change the data in each movie file into the following format: UserID, MovieID, Rating.
2. Merge 17770 movie files into one big input file since Hadoop is not good for dealing with lots of small files. And the big input file is the input of our recommender system.


## Building Steps

* Divide data by user id
* Build co-occurrence matrix
* Normalize the co-occurrence matrix
* Build rating matrix
* Multiply co-occurrence matrix and rating matrix
* Generate recommendation list


## How to run


```
cd src
cd RecommenderSystem # 进入解压出的目录
hdfs dfs -mkdir /input
hdfs dfs -put input/* /input 
hdfs dfs -rm -r /dataDividedByUser
hdfs dfs -rm -r /coOccurrenceMatrix
hdfs dfs -rm -r /Normalize
hdfs dfs -rm -r /Multiplication
hdfs dfs -rm -r /Sum
cd src/main/java/
hadoop com.sun.tools.javac.Main *.java
jar cf recommender.jar *.class
hadoop jar recommender.jar Driver /input /dataDividedByUser /coOccurrenceMatrix /Normalize /Multiplication /Sum
hdfs dfs -cat /Sum/*
```

* args0: original dataset
* args1: output directory for DividerByUser job
* args2: output directory for coOccurrenceMatrixBuilder job
* args3: output directory for NormalizeCoOccurrenceMatrix job
* args4: output directory for MultiplicationMapperJoin job
* args5: output directory for MultiplicationSum job
* args6: output directory for RecommenderListGenerator job



# Movie-Database-Web-App

The project is to build a Web site on movies, actors and their reviews, supported by a relational database system. The system manages all of its data at the back-end in a MySQL database and provides a Web interface to the users at the front-end.

I used the MySQL DBMS and the Linux operating system and the PHP programming language to access MySQL and the Apache2 Web server to provide a Web interface. Apache and PHP is one of the most popular method these days to implement a database-backed server for a small-to-medium scale Web site.

## YouTube Video:
<a href="http://www.youtube.com/watch?feature=player_embedded&v=9itAJ-hcCq4E" target="_blank"><img src="resource/Demo.png"  alt="Demo" width="960" height="500" border="10" /></a>

## MySQL
    create.sql: creat database
    load.sql: load data

## Input pages:
	page_l1.php: A page that lets users to add actor and/or director information. Here are some name examples: X.M.L Smith, J'son Lee, etc.
	page_l2.php: A page that lets users to add movie information. Some name examples: Beware the BLOB -- A Sequel, Willy Wonka and the Chocolate Factory
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
    

