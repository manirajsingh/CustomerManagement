1. Set up new Laravel project with command line.
    composer create-project --prefer-dist laravel/customerMgmt
2. Set upa  passport for authentication.
     composer require laravel/passport
3. Requirements for Creating a customer with UI
    create Migration **php artisan make:migration create_customers_table**
   Migrate to create schema in database **php artisan migrate**
   Customer model
   Customer Web routes in web.php
4. PHP artisan serve command to run project (http://127.0.0.1:8000) my local url
5. Login user from web **http://127.0.0.1:8000/login**
6. MFA code will be sent on respective email, and also check spam if not in the inbox (Used Google email credentials in env file).
7. Verify the MFA code, and then the dashboard page will be open.
8. We can add a customer, edit, and  delete a customer  (http://127.0.0.1:8000/customers).
9. Log out the user.
10. Register api to create users  (http://127.0.0.1:8000/api/register) (required param name,first_name,password,password_confirmation)
11. Login api http://127.0.0.1:8000/api/login (required param email,password). This will return token that is used for apis.
12. Created test cases for customer  in tests/features/CustomerApiTest.php folder.
13. Php artisan test command to run test cases.
14. Steps to install docker
15. Steps to install docker
https://docs.docker.com/desktop/setup/install/windows-install/
(Place mysql.env, .env, db.sql it in root folder)
If Docker not enabled 
wsl —install —web-download 



   


    
   
