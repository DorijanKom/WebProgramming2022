# Librarian
## Software Engineering

### Project: Book store inventory managment system 

This project is a book store management system with laravel web application framework. The main idea of our application is for bookstores and such to track how many books they have in store.
It can become frustrating for owners of forementioned businesses to write everything down on paper and having to manage them in a physical format. Responsive,  managable and viewable application that offers its consumers a great experience, without having to worry about their data being lost.

The features included in the release:

### Books and Writers

    - GET /baw endpoint, returns all baws (Books and Writers) from the api 
    - GET /baw/@id endpoint, returns a single baw by id
    - POST/baw endpoint, adds a new baw to database
    - PUT /baw/@id endpoint, update a baw from the db by id

### Books

    - GET /books endpoint, returns all books from the api
    - GET /books/@id endpoint, returns a single book by id
    - GET /books/search/@name endpoint, returns a number of books that match the given paramater
    - GET /search_books/writer endpoint, return the provided books from the api
    - POST /books endpoint, adds a new book to the db
    - PUT /books/@id endpoint, updates the selected book by id

### Orders

    - GET /orders endpoint, returns all orders from the api
    - GET /orders/@id endpoint, returns an order by id
    - POST /orders endpoint, adds a new order to the db
    - PUT /orders/@id endpoint, updates an order in db by id
    - DELETE /orders/@id endpoint, deletes an order from db by its id

### Publishers

    - GET /publishers endpoint, returns all publishers from the api
    - GET /publishers/@id endpoint, returns a single publisher by id
    - POST /publishers endpoint, adds a new publisher to the db
    - PUT /publishers/@id endpoint, updates one publisher

### Purchases

    - GET /purchases endpoint, returns all purchases from the API
    - GET /purchases/@id endpoint, returns a single purchase by id
    - POST /purchases endpoint, add a new purchase to db

### Users

    - GET /users endpoint, returns all users from the API
    - GET /users/@id endpoint, returns a single user by id
    - POST /login endpoint, with password and email for login

### Writers

    - GET /writers endpoint, returns all writers from the api
    - GET /writers/@id endpoint, returns a single writer by id
    - POST /writers endpoint, add a new writer to db
    - PUT /writers/@id endpoint, updates a writer in db by id

### Documentation

    - /rest/docs endpoint, access swagger documentation


``The project was made using HTML, CSS and PHP, while also using jQuery library and FlightPHP framework.``

---
> Dorijan Komšić and Kenan Lokvančić,
> 
> Students of International Burch University
> 
> *2021 © International Burch University*