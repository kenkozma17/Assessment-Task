# CRUD Web Application (Company Billing)
A simple CRUD Web Application which serves as an assessment task for Innoscripta.

# Installation and Usage

1. Clone or download the repository to your windows machine and CD into the project.

2. Install composer dependencies.
```
composer install
```

3. Install npm dependencies.
```
npm install
```

4. Create a copy of your .env file.
```
cp .env.example .env
```

5. Generate the projects encrpytion key.
```
php artisan key:generate
```

6. Create an empty database in phpmyadmin.

7. In the .env file, add your database configuration.

8. Run database migrations
```
php artisan migrate
```

9. Run the server
```
php artisan serve
```
