## Task-Tracker app

Simple application for tracking projects and tasks:

-   Register
-   Login
-   Add project (create, update, delete)
-   Add task to project (create, update, delete)
-   Assign task to a user
-   Define task types (create, update, delete)
-   Define categories (create, update, delete)
-   Define priorities (create, update, delete)
-   Define statuses (create, update, delete)
-   Filter tasks by type
-   Toggle active/inactive tasks
-   Add comment related to task and more...

## Project setup

1.  Download / clone project. Navigate to project folder.</br>
2.  Install composer dependencies

    ```
    composer install
    ```

3.  Install npm dependencies

    ```
    npm install
    ```

4.  Create .env file (copy from .env.example).</br>
    Generate application key:</br>

    ```
    php artisan key:generate
    ```

5.  Create empty DB and set up .env file with database information.</br>
6.  Run initial migrations and seeders:

    ```
    php artisan migrate --seed
    ```

    Users table contain demo user:</br>
    admin@test.com (password 12345678)</br>

7.  Create symlink

    ```
    php artisan storage:link
    ```

8.  Run server

    ```
    php artisan serve
    ```
