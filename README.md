# TasteTrail – Food List Web Application

TasteTrail is a Laravel-based web application that helps users discover restaurants through curated food lists created by other users.
Unlike traditional review platforms, TasteTrail focuses on list-based discovery, allowing users to explore themed collections.
## Features
- User authentication (register/login)
- Create, edit, and delete food lists
- Add restaurants to a list
- Tag system (e.g. spicy, sweet, budget-friendly)
- Upvote/downvote system
- Public feed of food lists
- View detailed list pages with restaurants
- User profiles

# Installation

This project is developed with Laravel. Follow the installation guide below to install and set up this website.

### 1. Clone the repo

```
git clone https://github.com/Adhira216/Server_Side_Development_CA2
```

### 2. Go to the project folder

```
cd Server_Side_Development_CA2
```

### 3. Install the initial dependencies from Composer

```
composer install
```

### 4. Install NPM dependencies

```
npm install
```

### 5. Create a copy of .env.example

`.env` files are not committed to this repo for security purposes, but there's a `.env.example` file that you can use as a base.

```
cp .env.example .env
```

### 6. Update your constants inside `.env`

`DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME` and `DB_PASSWORD`<br>
Update these constants to make sure they're matching your credentials

### 7. Generate the encryption key if needed

```
php artisan key:generate
```

### 8. Create a new empty database

This project is using MySQL. Open your DBMS and create a database called `ssd_ca2`.
You can check the migrations to see all the tables that will be created.

### 9. Migrate the database

```
php artisan migrate:fresh --seed
```

### 10. Run the server
```
php artisan serve
```
Visit:
```
http://127.0.0.1:8000
```
Make sure your MySQL database server is running at the same time (e.g. XAMPP, MAMP), otherwise the application will not be able to connect to the database.
