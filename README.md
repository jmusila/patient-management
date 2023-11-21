### Patient Management System
#### To Have a copy of the running app 
- Clone this repo `$https://github.com/jmusila/patient-management.git`
- You need to have composer installed in your machine and php >= 8.0
- Run the following commands:
- `$composer install` this will install dependencies
- `$cp .env.exampe .env` this will copy and have a new .env file
- Create a desired database(MySQL)
- Add the database credentials to the .env
- Run `php artisan app:initialize-test-environment`
- Create a user using the endpoint    `{base_url}/api/users` POST method

