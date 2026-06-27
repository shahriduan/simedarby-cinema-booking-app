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

### ⚙️ API Scope & Static Data

The backend APIs developed for this project strictly cover the primary booking flow. To meet the assessment timeline, the following supporting data sets are currently static/hardcoded:
- Movie reviews
- Available showtimes
- Cinema hall layouts and seat maps
- Movie & seat pricing (uniform pricing across all sheets)
- Food and beverage menus
- Promo code listings

### 🎯 Out of Scope & Future Enhancements

This implementation focuses purely on the primary booking flow and core wireframes. To keep the core engine clean, the following features were excluded from this version:
- User registration & profiles
- Movie categories (New Release, Popular, Recommended)
- Movie ratings, reviews, and favorites/bookmarks
- User booking history & ticket barcodes
- Bank transfer & crypto wallet payments
- Email notifications

### 🏷️ Promo code (Testing)

A static promo code is available to test the discount logic during the checkout flow:
- Code: PROMO5
- Benefit: RM5.00 flat discount


### 📖 API documentation

Detailed API documentation is automatically generated using Laravel Scribe. You can access the interactive docs directly through your browser at: <br>
`http://<yourIpAddress>/apidocs`