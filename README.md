# WebProgramming2022
Intro to Web Programming

Project: Book store inventory managment system 

This project is a book store management system with laravel web application framework. The main idea of our application is for bookstores and such to track how many books they have in store.
It can become frustrating for owners of forementioned businesses to write everything down on paper and having to manage them in a physical format. Responsive,  managable and viewable application that offers its consumers a great experience, without having to worry about their data being lost.

The features included in the release:

```
-the /baw endpoint, returns all baws (Books and Writers) from the api 
-the /baw/@id endpoint, returns a single baw by id
-the POST/baw endpoint, adds a new baw to database
-the PUT /baw/@id endpoint, update a baw from the db by id


-the GET /books endpoint, returns all books from the api
-the GET /books/@id endpoint, returns a single book by id
-the GET /books/search/@name endpoint, returns a number of books that match the given paramater
-the GET /search_books/writer endpoint, return the provided books from the api
-the POST /books endpoint, adds a new book to the db
-the PUT /books/@id endpoint, updates the selected book by id


-the GET /orders endpoint, returns all orders from the api
-the GET /orders/@id endpoint, returns an order by id
-the POST /orders endpoint, adds a new order to the db
-the PUT /orders/@id endpoint, updates an order in db by id
-the DELETE /orders/@id endpoint, deletes an order from db by its id


-the GET /publishers endpoint, returns all publishers from the api
-the GET /publishers/@id endpoint, returns a single publisher by id
-the POST /publishers endpoint, adds a new publisher to the db
-the PUT /publishers/@id endpoint, updates one publisher


-the GET /purchases endpoint, returns all purchases from the API
-the GET /purchases/@id endpoint, returns a single purchase by id
-the POST /purchases endpoint, add a new purchase to db


-the GET /users endpoint, returns all users from the API
-the GET /users/@id endpoint, returns a single user by id
-the POST /login endpoint, with password and email for login

-the GET /writers endpoint, returns all writers from the api
-the GET /writers/@id endpoint, returns a single writer by id
-the POST /writers endpoint, add a new writer to db
-the PUT /writers/@id endpoint, updates a writer in db by id


```

The project was made using HTML, CSS and PHP, while also using jQuery library and FlightPHP framework. 