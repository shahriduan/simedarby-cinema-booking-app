# <font color="#89CFF0">Setup Instruction</font>

## 🚀 Prerequisites
- **PHP:** `^8.3` or higher
- **Package Manager:** Composer
- **Database:** MySQL 8
- **Web Server:** Apache or Nginx

> 💡 **Tip for Local Windows Computer:** Instead of installing these components individually, you can use local pre-configured environments such as **Laragon**, **XAMPP**, or **WAMP**.

## 🛠️ Laravel Backend Setup

1. Duplicate <font color="orange">**.env.example**</font> file and rename to <font color="orange">**.env**</font>
2. Please set this variable inside <font color="orange">**.env**</font> file
```
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```
3. Open terminal on this project folder and run this command
    - Run `composer install`
    - Run `php artisan key:generate`
    - Run `php artisan storage:link`
    - Run `php artisan migrate`
    - Run `php artisan db:seed`

# <font color="#89CFF0">Important Notes You Should Know</font>

### 🚀 Things that I hardcoded, that not use API
- List movie reviews
- List available showtime
- List cinema hall layout and seats
- List movie and seats price all are same
- List of Food and beverages
- List of Promo code

API that I develop only cover main booking flow only

### 🚀 Feature that not cover in this booking app

- Favourite or bookmark list movie
- Profile
- Write a movie rating & reviews
- Bank transfer and crypto wallets payment
- View ticket barcode
- List of user booked movie
- Movie category for example new release, popular in cinema and recommended for you.
- New user registration
- Email notification

I do feature based on main booking flow and wireframe only

### 🚀 Promo code

You can use promo code PROMO5 to get RM5 discount