# Task Management Application

This is a Laravel-based task management application that allows users to manage tasks with features like filtering, due dates, and more.

## Features

- Create, update, delete tasks.
- Filter tasks by status (e.g., completed, pending).
- Add and display due dates for tasks.
- View tasks categorized by users and categories.

## Requirements

- PHP 8.1 or higher
- Composer
- MySQL
- Node.js & npm (for front-end dependencies)
- Laravel 11.x

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/your-username/task-management-app.git
   cd task-management-app

Install PHP dependencies using Composer:
composer install

Copy the .env.example file to .env:
cp .env.example .env

Update the .env file with your database and other configurations:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password




Generate the application key:

php artisan key:generate





Seed the database with sample data:

php artisan db:seed



Serve the application:

php artisan serve



The application will be available at http://127.0.0.1:8000.




