# Ball Shop

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## About

This project is for managing your events, participate and chat with them, and handle the events in a calendar. I used PHP for backend and React and MUI for frontend.

## Table of Contents

- [Prerequisites](#prerequisites)
- [Backend Setup](#backend-setup)
    - [First step](#first-step)
    - [Second step](#second-step)
    - [Third step](#third-step)
- [Frontend Setup](#frontend-setup)
- [Conclusion](#conclusion)
- [Contact](#contact)

## Prerequisites

Before getting started, make sure you have the following prerequisites installed on your system:

### Backend

- Composer v2.5.5
- PHP v8+ ![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
- Laravel v10+ ![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
- MySQL v8 ![MySQL](https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white)

### Frontend

- nodeJS v19.8.1 ![NodeJS](https://img.shields.io/badge/node.js-6DA55F?style=for-the-badge&logo=node.js&logoColor=white) (Developed and tested with this version)

- ![MUI Logo](https://img.shields.io/badge/Material%20UI-007FFF?style=for-the-badge&logo=mui&logoColor=white)
- ![JavaScript Logo](https://img.shields.io/badge/JavaScript-323330?style=for-the-badge&logo=javascript&logoColor=F7DF1E)

## Backend Setup

Follow these steps to set up the project:

### First step

1. Create a new file called `.env` and copy the contents from `.env.example`.
2. Fill in the database variables in the `.env` file with the correct database information. Here's a sample:

   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=myDatabase
   DB_USERNAME=root
   DB_PASSWORD=root
   ```

   You may need to modify other variables in the file if necessary.

### Second step

After cloning the repository and opening it, execute the following commands in your terminal:

1. Change directory to the `backend` folder:

`cd backend`

2. Run the `setup.php` script, which performs the following actions:

`php setup.php`

- Installs the project dependencies with Composer:
  usually:

  ```
  composer install
  ```

- Executes the Laravel migrations:
  ```
  php artisan migrate
  ```
- Seeds the database with initial data:
  ```
  php artisan seed
  ```

Make sure all these commands are successfully executed.

Additionally, check your `.env` file to ensure that the **APP_KEY** variable is filled. If it is not filled, generate a new key by running the following command in the terminal:

```
php artisan key:generate
```

### Third step

If you are using Apache server, there's no additional setup required. However, if you are not using Apache, run the following command in the terminal:

```
php artisan serve
```

This command will start the development server, and you will be able to access the home page of the project.

## Frontend Setup

First change directory to the `frontend` folder:

`cd frontend`

- install dependencies

```
npm install
```

- after this installiation you just need to run the dev server

```
npm run start
```

## Conclusion

This project is under development, features like chating and more aren't implemented yet.

## Contact

If you have any questions about the project feel free to get in touch with me:

`ggabor.gabor25@gmail.com`
