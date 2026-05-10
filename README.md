# Shoe Seller E-Commerce Web Application

A full-featured e-commerce web application for selling shoes, built with PHP and MySQL using custom MVC architecture.

## Features

**User Management**: Registration, login, profile management, and role-based access control (Member/Admin)

**Product Catalog**: Browse products by category, search products by keyword, view product details

**Shopping Cart**: Add to cart, update quantity, remove items, and checkout process

**Order Management**: Track order status, view order history

**Admin Dashboard**:
- Manage homepage content (Hero banner, featured products, brand marquee)
- Product management (add, edit, delete, search by category/keyword)
- Order management (view, update status: pending/processing/shipped/delivered/cancelled)
- Customer contact management (view, mark as read/replied, delete)
- Website settings (company info, logo, social media links)

**Contact System**: Contact form with admin panel to manage inquiries

**Responsive Design**: Mobile-friendly interface with custom CSS

## Prerequisites

XAMPP (v8.0 or higher recommended)
- Includes Apache, MySQL, and PHP
- Download from: https://www.apachefriends.org/

## Installation & Setup

### 1. Install XAMPP
Download and install XAMPP for Windows
- Install to the default location (usually `C:\xampp`)
- Launch XAMPP Control Panel

### 2. Clone/Download the Project
Place the project folder in XAMPP's htdocs directory:
```
C:\xampp\htdocs\Shoe-Seller\
```
Or clone using Git:
```bash
cd C:\xampp\htdocs
git clone <repository-url> Shoe-Seller
```

### 3. Configure Database
**Start MySQL Server:**
- Open XAMPP Control Panel
- Click "Start" for MySQL module
- Wait until it shows "Running"

**Create Database:**
- Click "Admin" button next to MySQL (opens phpMyAdmin)
- Click "New" in the left sidebar
- Enter database name: `shoe_seller`
- Select Collation: `utf8mb4_unicode_ci`
- Click "Create"

**Import Database Schema:**
- Select your newly created database
- Click "Import" tab
- Click "Choose File" and select `database/schema.sql` from the project
- Scroll down and click "Import"
- Wait for success message

### 4. Configure Environment
Edit `config/config.php` with your settings:
```php
<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'shoe_seller');

// Application Configuration
define('BASE_URL', 'http://localhost/Shoe-Seller');
define('APP_NAME', 'Shoe Seller');

// Paths
define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . '/app');
define('PUBLIC_PATH', ROOT_PATH . '/public');
```

**Note:** Default XAMPP MySQL credentials are:
- Username: `root`
- Password: (empty/blank)

### 5. Set Folder Permissions
Ensure the following directories are writable:
```
public/images/
public/uploads/product/
public/uploads/news/
```
In Windows, right-click each folder → Properties → Security → Edit → Add write permissions for your user.

### 6. Start the Application
**Start Apache Server:**
- Open XAMPP Control Panel
- Click "Start" for Apache module
- Wait until it shows "Running"

**Access the Application:**
- Open your web browser
- Navigate to: `http://localhost/Shoe-Seller`

## Default Credentials

The `schema.sql` file includes demo users (password for all: `password`):

**Admin Account**
- Email: `admin@shoeseller.com`
- Password: `password`

**Member Account**
- Email: `john.doe@shoeseller.com`
- Password: `password`

## Project Structure

```
Shoe-Seller/
├── database/
│   └── schema.sql              # Database schema and sample data
├── config/
│   └── config.php             # Application configuration
├── app/
│   ├── core/
│   │   ├── App.php           # Application bootstrap & routing
│   │   ├── Controller.php    # Base controller class
│   │   └── Database.php      # Database connection (PDO)
│   ├── controllers/           # Application controllers
│   │   ├── HomeController.php
│   │   ├── ProductController.php
│   │   ├── CartController.php
│   │   ├── CheckoutController.php
│   │   ├── OrderController.php
│   │   ├── UsersController.php
│   │   ├── ContactController.php
│   │   ├── AboutController.php
│   │   ├── ProfileController.php
│   │   ├── HomepageController.php
│   │   └── AdminController.php
│   ├── models/                # Data models
│   │   ├── CoreModel.php
│   │   ├── Users.php
│   │   ├── Product.php
│   │   ├── Order.php
│   │   ├── Settings.php
│   │   └── Contacts.php
│   ├── views/                 # View templates
│   │   ├── layouts/           # Header, Footer
│   │   ├── pages/             # Public pages
│   │   └── admin/             # Admin pages
│   └── router/
│       └── routes.php         # Route definitions
├── public/                    # Public web root
│   ├── index.php             # Front controller
│   ├── css/                  # Stylesheets
│   ├── js/                   # JavaScript files
│   ├── images/               # Static images
│   └── uploads/              # User uploaded files
└── README.md                  # This file
```

## Database Schema

### Tables Overview

| Table | Purpose |
|-------|---------|
| `users` | User accounts with roles (admin/member) and status (active/banned) |
| `categories` | Product categories (Sneakers, Boots, Sandals, Formal Shoes) |
| `products` | Product catalog with name, description, price, image |
| `product_attributes` | Product sizes and stock quantities |
| `orders` | Order headers with status tracking |
| `order_details` | Order line items (product, size, quantity, price) |
| `contacts` | Customer messages with status (unread/read/replied) |
| `faqs` | FAQ entries |
| `settings` | Website configuration (key-value pairs) |

### Key Database Features
- UTF-8 Unicode support for Vietnamese text
- Foreign key constraints for data integrity
- ENUM types for status fields
- Timestamp tracking for created dates

## Troubleshooting

### Apache Won't Start
**Port 80 in use:** Another application is using port 80 (like Skype, IIS)
- **Solution:** Change Apache port in XAMPP Config → Apache (httpd.conf)
- Change `Listen 80` to `Listen 8080`
- Access site at `http://localhost:8080/Shoe-Seller`

### MySQL Won't Start
**Port 3306 in use:** Another MySQL/database service is running
- **Solution:** Stop other database services or change MySQL port in XAMPP

### "Access Denied" Database Error
- Check `config/config.php` has correct database credentials
- Ensure database name matches the one you created
- Default XAMPP MySQL user is `root` with empty password

### Page Not Found / Blank Page
- Check Apache is running in XAMPP Control Panel
- Verify mod_rewrite is enabled in Apache
- Check `.htaccess` file exists in project root

### File Upload Errors
- Ensure upload directories have write permissions
- Check PHP upload limits in `php.ini`:
  ```
  upload_max_filesize = 10M
  post_max_size = 10M
  ```

### CSS/JS Not Loading
- Verify `BASE_URL` in `config.php` matches your actual URL
- Clear browser cache (Ctrl+F5 for hard refresh)

## Development

### Accessing Admin Panel
After logging in with admin credentials, access the admin dashboard at:
```
http://localhost/Shoe-Seller/admin
```

Or through the navigation menu (visible when logged in as admin).

### Making Changes
- **PHP Files:** Edit files in `app/` directory, refresh browser to see changes
- **CSS/JS:** Edit files in `public/css/` and `public/js/`, hard refresh browser (Ctrl+F5)
- **Database:** Make changes via phpMyAdmin or update `schema.sql` for fresh installs

### Debugging
- Check Apache error logs: `C:\xampp\apache\logs\error.log`
- Check PHP errors: Enable error reporting in `config.php`
- Use `var_dump()` or `print_r()` for debugging variables

## MVC Architecture

This project uses a custom MVC (Model-View-Controller) pattern:

**Model**: Handles database operations (query, insert, update, delete)
**View**: HTML templates that display data
**Controller**: Processes requests, calls models, renders views

Example flow:
1. User visits `/product`
2. `App.php` routes to `ProductController::index()`
3. Controller calls `Product` model to get data
4. Controller loads `views/pages/product.php` view with data

## Support

For issues or questions, please refer to:

- **XAMPP Documentation:** https://www.apachefriends.org/docs.html
- **PHP Documentation:** https://www.php.net/manual/
- **MySQL Documentation:** https://dev.mysql.com/doc/

## License

This project is for educational purposes only.

---

**Last Updated**: May 10, 2026  
**Version**: 1.0

