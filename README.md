## Technical Test Fullstack Developer (Freelance)

### Email and Password

-   Email : admin@example.com | Pass : password
-   Email : superadmin@example.com | Pass : password
-   Email : superadmin@example.com | Pass : password

### Requirement

-   PHP 8.1.16
-   MySQL 8.0.30
-   Composer 2.4.1
-   Laravel 9

### How to install

-   Install in https://github.com/aliffadhil28/car_rent.git
-   run composer install
-   run php artisan key:generate
-   config .env file based database that you use
-   run php artisan migrate:fresh --seed
-   finally run php artisan serve

### How to use

-   Login as Admin input Rents data in https::/localhost::8000/rents or you can use the navigation panel
-   Login as Super Admin 1 then validate the rent application
-   Login as Super Admin 2 then validate the rent application
-   When Return Time is Submited Rent Data will go through History Data where you can extract to Excel Format
