# Assignment

## General Information
This assignment project sets up an API which adds organizations and their relations (parent->child) into a database with a POST request and ouputs a given organization with all its relationships (parent, sister, daughter) on a GET request. 

## Requirements
1. PHP >=7.4.3
2. MySQL >=8.0

## How-to
1. Set up a MySQL server with an empty database.
2. Modify the database parameters in dbConfig.php.
3. Run api.php locally as a server, which handles GET and POST requests (`php -S localhost:8000 api.php`)
4. OPTIONAL: Run tests/populateDB.php to populate the database with example data. (`php populateDB.php`)

### Sending POST and GET requests
1. POST requests have to be sent to localhost:8000 in JSON and the required format. Check tests/postExample.json. Use reqbin.com (Chrome Extension required for a local server), Postman or any other alternative tool.
2. GET requests parameters:  
    2.1 REQUIRED: org_name  
    2.2 OPTIONAL: page  
3. Example GET request: http://localhost:8000/api?org_name=Black%20Banana&page=0

## Detailed example setup running php locally 
1. Install PHP (at least 7.4.3)
2. Download and install WAMP from the following [link](https://www.wampserver.com/en/).
3. When WAMP is running, go to localhost on your browser and navigate to PhpMyAdmin 5.1.1. Log in using the set user (default: root) and password (default empty).
4. Create a new database 'acty'.
5. OPTIONAL: Run tests/populateDB.php to populate the database with example data. Navigate to /tests and run `php populateDB.php`.
6. Navigate to the assignment directory and run api.php as a server `php -S localhost:8000 api.php`.
7. Use localhost:8000 to send POST requests. 
8. Use localhost:8000/?org_name=ORG%20NAME&page=PAGE to send GET requests

## Detailed example setup using WAMP as a server
1. Download and install WAMP from the following [link](https://www.wampserver.com/en/).
2. When WAMP is running, go to localhost on your browser and navigate to PhpMyAdmin 5.1.1. Log in using the set user (default: root) and password (default empty).
3. Create a new database 'acty'.
4. Navigate to the www directory in the wamp installation folder (C:\wamp64\www), create a directory '/acty' and paste the repository files into the folder.
5. Go back to localhost, you should see 'acty' in 'Your Projects' tab. Navigate to Tools->Add a Virtual Host, name the Virtual Host 'acty' and add the path of the folder (C:\wamp64\www\acty).
6. OPTIONAL: Run tests/populateDB.php to populate the database with example data. Navigate to /tests in a terminal and run `php populateDB.php`.
7. Send POST requests to localhost/acty/api.php in JSON format.
8. Example GET request: Go to localhost/acty/api.php?org_name=Black%20Banana&page=0 in your browser.