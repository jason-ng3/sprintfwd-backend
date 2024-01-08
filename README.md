<<<<<<< HEAD
### Steps for Using the Application
1. From the backend project directory (sprintfwd-backend), run the script to create a database for the backend and testing.
2. Run `php artisan migrate` to create the requisite tables.
3. The application is broken into a backend application (http://localhost:8000) and a frontend application (http://localhost:8080). 
4. Run the command `php artisan serve` in one terminal window from backend project directory (sprintfwd-backend) to serve the backend.
5. Run the command `php artisan serve --port=8080` in another terminal window from the frontend project directory (sprintfwd-frontend) to serve the frontend.

### Functional Design
1. Use Laravel views with web routes to implement the frontend, the routes of which call the API backend. This way, we have a clear separation of concerns and have the ability to serve multiple different types of clients. 
2. Use a relational database as we have relational data needs (1:Many & Many:Many relationships). 
3. Since a Member must be part of a Team, I choose to express it as a 1:Many relationship in which the 'team_id' field within the Member table must not be null. 
4. Since a Memeber may optionally be assigned to projects, I choose to express it as a Many:Many relationship. 

### Non-Functional Design
1. Relational database is a solid choice for a system with relational needs and potentially heavier on reads (assumes lower likelihood of writes vs. reads), especially with a B-tree based indexing engine that optimizes for efficiency on reads. 

### Testing
1. I used model factories for creating members, projects and teams. In particular a MemberFactory that creates a valid team for `team_id` to reference. 

### Future Work
1. I used DOM manipluation along with asynchronous JavaScript, as well as some storing of 
global state, for the frontend. In the future, I would prefer to use a framework like
React to help manage state, as well as perform more efficient UI updates.

## Data Model
# Teams (1:Many relationship with Members)
teamID (PK)
name (required)

# Project
projectID (PK)
name (required)

# Members (Many:Many relationship with Projects)
memberID (PK)
first_name (required)
last_name (required)
teamID (FK)
city
state
country 

# Project_Members (Cross-Reference JOIN table for Many:Many relationship)
projectID (FK)
memberID (FK)
=======
# sprintfwd-backend
>>>>>>> 733b0e5f7bca8edc00caf920b3e240d3803e4d36
