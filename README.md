## Run Project

Test  API Back-End Test-UVM

To run the test_fast project, the steps are as follows.

1.- Download the github repository https://github.com/Heriberto-Bazan/test_uvm

2.- Create the database for the Project in .env

3.- Run the command composer install o composer update

4.- Run the command generate secret key php artisan jwt:secret 

5.- Run the php artisan migrate 

End Point

The following end_points

1.- Register a user (POST) http://127.0.0.1:8000/api/v1/register

2.- To delete the token (POST) http://127.0.0.1:8000/api/v1/logout

3.- To generate the login (POST) http://127.0.0.1:8000/api/v1/login

4.- Show all users (GET) http://127.0.0.1:8000/api/v1/users

5.- To register student (POST) http://127.0.0.1:8000/api/v1/student-register

6.- To show all Marital Status (GET) http://127.0.0.1:8000/api/v1/status

7.- To show all Gender (GET) http://127.0.0.1:8000/api/v1/gender

8.- To display all Academic Level (GET) http://127.0.0.1:8000/api/v1/level

