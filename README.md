## This is a fully functional login, registration system build using PHP Laravel

**Prerequisites**

-   XAMPP (tested on 3.3.0)
    -   Apache v. 2.4.58
    -   PHP v. 8.2.12
    -   MySQL server
-   Composer v. 2.7.6

# how to run

**Step 1.** clone the repository → `git clone https://github.com/Anuradha2k21/complete`

---

**_run these commands from the cloned root directory_**  
**Step 2.** install PHP dependencies → `composer install`  
**Step 3.** create `.env` file using `.env.example` → `cp .env.example .env`  
**Step 4.** generate an application key → `php artisan key:generate`  
**Step 5.** run database migrations → `php artisan migrate` (and give _yes_)  
**Step 6.** serve the application → `php artisan serve`  
**Step 6.** access the application → go to `http://127.0.0.1:8000`

## instructions 
create a account first. then, you can log in using that credentials to user dashboard. also use that same credentials to login as a admin. admin can view number of leaves of each employee, and assign salaray for new employees etc.
