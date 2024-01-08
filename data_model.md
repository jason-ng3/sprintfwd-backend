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
city (optional)
state (optional)
country (optional)

# Project_Members (Cross-Reference JOIN table for Many:Many relationship)
projectID (FK)
memberID (FK)