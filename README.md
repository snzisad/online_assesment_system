# Online Assessment System
This project was developed for a private company to assess their employees. Technology: Laravel, MySQL, JQuery, Bootstrap, etc.

## Features

* User Panel
    * Login with Employee ID
    * Answer 10 random MCQ questions (Timed)
    * Answer 2 video questions (Timed)
    
* Admin Panel
    * Login with Employee ID
    * Can add employees (CRUD Operation)
    * Give admin access to other employee
    * Add MCQ and Video Questions (CRUD Operation)
    * Import questions with Excel sheet
    * View Results
    * Export results in Excel sheet
    * Download the results and video responses in a zip file    


## How to run

Download and Install MySQL
```bash
https://www.mysql.com/downloads/
```

Download and Install Composer
```bash
https://getcomposer.org/download/
```

While installing the composer, select the project php file (from 'php' folder) in order to run the project.

Install Laravel libraries
```bash
composer install
```

Copy ENV file
```bash
cp .env.example .env
```

Generate laravel api-key
```bash
php artisan key:generate
```

Update .env file with database information 

Migrate the schemas into database
```bash
php artisan migrate
```

Run project
```bash
php artisan serve
```
