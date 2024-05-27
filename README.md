## This is a fully functional login, registration system build using PHP Laravel 11

**Prerequisites**

-   laravel 11
-   XAMPP (tested on 3.3.0)
    -   Apache v. 2.4.58
    -   PHP v. 8.2.12
    -   MySQL server
-   Composer v. 2.7.6
-   Pusher account [link](https://dashboard.pusher.com/accounts/sign_up)

# how to run

```
git clone https://github.com/Anuradha2k21/complete
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```

then you need to input **Pusher** app keys at `.env` file

```
PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=
```

go to `http://127.0.0.1:8000` to access the system

## Note

after running `php artisan db:seed` it creates admin account along with 50 fake employee accounts.

_admin credentials_  
_email:_ `admin@example.com`  
_password:_ `password`
