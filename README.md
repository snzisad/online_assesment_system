# Online Assessment System
This project was developed for a private company to assess their employees. Technology: Laravel, MySQL, JQuery, Bootstrap, etc.

## Features

* User Panel
    * Login with Employee ID
    * Submit 10 random MCQ questions (Timed)
    * Submit 2 video questions (Timed)
    
* Admin Panel
    * Login with Employee ID
    * Can add employees (CRUD Operation)
    * Give admin access to other employee
    * Add MCQ Questions (CRUD Operation)
    * Import questions with Excel sheet
    * View Results
    * Export results in Excel sheet
    * Download the results and video responses in a zip file    


## How to run

Download and Install Composer
```bash
https://getcomposer.org/download/
```

Download and Install Xampp for PHP, MySQL, and Apache server
```bash
https://www.apachefriends.org/
```

Copy ENV file
```bash
cp .env.example .env
```

Install Laravel libraries
```bash
composer install
or
php composer.phar install
```

Generate laravel api-key
```bash
php artisan key:generate
```

Update .env file with api-key and database information 

Migrate the schemas into database
```bash
php artisan migrate
```

Run project
```bash
php artisan serve
```
