# Shoe Seller - Web Application Project

## Project Overview

**Shoe Seller** is a web-based e-commerce platform for a shoe company/business built as a semester project for Web Programming course (HK2 2025-2026). The project implements a custom MVC (Model-View-Controller) architecture without using any PHP frameworks, following academic requirements.

---

## Current Project Status

### ✅ Already Implemented

#### Core Infrastructure
- **MVC Architecture**: Custom routing system without PHP frameworks
- **URL Rewriting**: `.htaccess` configured for clean URLs (e.g., `/users/login` instead of `index.php?url=users/login`)
- **Database Design**: Complete MySQL schema with 9 normalized tables
- **Database Configuration**: Config file for database connection setup (`config/config.php`)
- **Session Management**: Session handling for user authentication
- **Auto-loading**: PSR-4 compatible autoloader for controllers and models

#### Core Classes
- **`App.php`** - Router with URL parsing and controller dispatching
- **`Controller.php`** - Base controller with model() and view() methods for MVC pattern
- **`Database.php`** - PDO-based database class with prepared statements (SQL injection protection)

#### Controllers (3 implemented)
- **`HomeController`** - Homepage display
- **`UsersController`** - User authentication and profile management
  - Login with email/username support
  - Secure password verification (password_verify)
  - User status checking (ban/active)
  - Session management
  - Role-based redirects
- **`AdminController`** - Admin dashboard access with permission checking

#### Views & Frontend
- **Admin Dashboard** - Srtdash template integration
  - `admin/dashboard.php` - Main dashboard page
  - `admin/layouts/header.php` - Admin header with CSS framework (Bootstrap 5)
  - `admin/layouts/footer.php` - Admin footer
- **User Authentication Pages**
  - `users/login.php` - Login form with email/username support
  - `users/register.php` - User registration
  - `users/users.php` - User profile page
- **Public Pages**
  - `home/index.php` - Homepage
- **Layouts**
  - `layouts/header.php` - Public header
  - `layouts/footer.php` - Public footer
- **Styling**
  - `public/css/style.css` - Custom CSS
  - `public/admin_assets/` - Complete Srtdash admin template with CSS and JS libraries
  - Bootstrap, FontAwesome, Themify Icons included

#### Security Features Implemented
- PDO prepared statements for database queries
- Password hashing with PHP's password_verify()
- Session-based authentication
- Admin role checking
- User status verification (ban prevention)
- Input validation on login form

#### Database Tables (9 tables)
1. `users` - User accounts with roles (admin, member) and status (active, banned)
2. `products` - Product catalog with categories
3. `categories` - Product categories
4. `product_attributes` - Product sizes and stock management
5. `orders` - Order headers with status tracking
6. `order_details` - Order line items
7. `contacts` - Customer contact messages with status (unread, read, replied)
8. `faqs` - Frequently asked questions
9. `settings` - Website configuration (logo, phone, address, company name, etc.)

### ⏳ To Be Implemented

#### Models (Database Layer)
- Users model with CRUD operations
- Products model
- Orders model
- Contacts model
- FAQs model
- Comments/Reviews model

#### Views & Pages
- Product listing page with search
- Product details page
- News/Blog listing page with search
- News/Blog detail page
- Cart and checkout pages
- Contact form page
- FAQ display page
- About page
- Price list page
- User profile management
- Admin management pages for all resources

#### Features
- Product search and filtering
- Shopping cart management
- Order management and checkout
- Comment/review system
- News/Blog management
- Contact form submission and management
- FAQ management
- User profile editing (password, avatar, info)
- Pagination for listings
- Image upload functionality
- Admin dashboard operations (CRUD for all resources)

---

## Assignment Requirements (Bài Tập Lớn)

### 📋 Course Information
- **Subject**: Web Programming (Lập trình web)
- **Semester**: HK2 2025-2026
- **Team Size**: Maximum 4 members
- **Status**: Minimum 20-page report required

### 🎯 Main Objectives
1. Design interface and build basic features for a company/business website
2. Use learned technologies: HTML5, CSS3, JavaScript, PHP, and MySQL
3. Understand web frameworks/libraries, basic security, and SEO
4. Implement MVC pattern without using PHP frameworks
5. Create responsive design for multiple devices

### 📚 Technology Stack Requirements
✅ **Allowed**:
- PHP 7.0+
- MySQL
- HTML5 & CSS3
- JavaScript
- CSS3 & JavaScript frameworks/libraries (Bootstrap, jQuery, etc.)
- Dashboard template (Srtdash for admin panel)

❌ **NOT Allowed**:
- PHP Frameworks (Laravel, CodeIgniter, Symfony, etc.)
- CMF (Content Management Framework)
- CMS (Content Management System)
- External image URLs (must upload to server)

### 🔐 Technical Requirements
- Input validation (both JavaScript client-side and PHP server-side)
- W3C HTML5/CSS3 compliance validation
- Responsive design (mobile, tablet, desktop)
- Browser compatibility testing
- Security considerations and protection mechanisms
- SEO optimization
- Pagination for long listings
- Image upload functionality

### 🏗️ Website Structure Required

#### Public Pages
- **Homepage** (Trang chủ)
- **About** (Giới thiệu)
- **Product/Service Info** (Thông tin dịch vụ, sản phẩm)
- **Price List** (Bảng giá)
- **Contact** (Liên hệ)
- **FAQ** (Hỏi/đáp)
- **News/Blog** (Tin tức)
- **Product Listing** (with search capability)
- **Product Details**
- **Shopping Cart** (if applicable)

#### User Pages
- **Registration** (Đăng ký)
- **Login** (Đăng nhập)
- **User Profile** (manage password, avatar, info)
- **Comment/Review** (for products and articles)

#### Admin Dashboard Pages
- **User Management** (view, edit, ban, delete users)
- **Contact Management** (view, mark as read/replied, delete)
- **Product Management** (CRUD operations)
- **Order Management** (view, change status)
- **News/Blog Management** (CRUD operations)
- **Comment Management** (view, manage user comments)
- **Settings Management** (website info, logo, contact details)
- **FAQ Management** (CRUD operations)

### 👥 User Roles & Features

#### Guest (Khách)
- View public information (homepage, products, services, contact info, news)
- Search for resources (news, products, services)
- Register and login

#### Member (Thành viên - Logged In)
- Change personal information, password, avatar
- Write comments and reviews
- View order history
- Other member-specific features

#### Admin (Quản trị viên)
- User management (view, edit, ban, delete)
- Comment/review management
- Customer contact management
- Public page content management
- Product management (add, edit, delete, search)
- Order and cart management
- News management (add, edit, delete, search)
- Website settings management

---

## Database Schema

### Tables Overview

| Table | Purpose |
|-------|---------|
| `users` | User accounts with roles and status |
| `products` | Product catalog |
| `categories` | Product categories |
| `product_attributes` | Product sizes and stock info |
| `orders` | Order headers |
| `order_details` | Order line items |
| `contacts` | Customer messages |
| `faqs` | FAQ entries |
| `settings` | Website configuration |

### Key Database Features
- UTF-8 Unicode support for Vietnamese text
- Foreign key constraints for data integrity
- Timestamp tracking for created dates
- Status enums for users, orders, and contacts
- Role-based user differentiation

---

## Project Structure

```
Shoe-Seller/
├── .git/                     # Git repository
├── .htaccess                 # URL rewriting configuration
├── index.php                 # Entry point with autoloader
├── README.md
├── config/
│   └── config.php           # Database and path configuration
├── app/
│   ├── core/
│   │   ├── App.php          # Router and application kernel
│   │   ├── Controller.php   # Base controller class
│   │   └── Database.php     # PDO database connection class
│   ├── controllers/
│   │   ├── HomeController.php       # Homepage
│   │   ├── UsersController.php      # Authentication & user management
│   │   └── AdminController.php      # Admin dashboard
│   ├── models/              # Model classes (to be created)
│   └── views/
│       ├── home/
│       │   └── index.php            # Homepage view
│       ├── users/
│       │   ├── login.php            # Login page
│       │   ├── register.php         # Registration page
│       │   ├── users.php            # User profile page
│       │   └── img/                 # User-related images
│       ├── admin/
│       │   ├── dashboard.php        # Admin dashboard
│       │   ├── admin.php            # Admin pages
│       │   └── layouts/
│       │       ├── header.php       # Admin header with Srtdash template
│       │       └── footer.php       # Admin footer
│       └── layouts/
│           ├── header.php           # Public header
│           └── footer.php           # Public footer
├── database/
│   └── schema.sql           # MySQL database schema
├── public/
│   ├── css/
│   │   └── style.css               # Custom CSS
│   ├── js/                         # JavaScript files
│   ├── images/                     # Website images
│   └── admin_assets/               # Srtdash dashboard template
│       ├── css/
│       ├── js/
│       ├── images/
│       └── ...
└── [other asset files]
```

**Key Directories:**
- `/app/core` - Core framework classes
- `/app/controllers` - Request handlers (3 controllers implemented)
- `/app/models` - Database models (to be created)
- `/app/views` - Template files for rendering
- `/public` - Static assets (CSS, JS, images)
- `/config` - Configuration files

---

## Installation & Setup

### Prerequisites
- PHP 7.0 or higher (tested with PHP 7.4+)
- MySQL 5.7 or higher
- Apache with mod_rewrite enabled
- XAMPP or similar local development environment

### Installation Steps

1. **Copy project to htdocs**
   ```bash
   cp -r Shoe-Seller C:\xampp\htdocs\
   ```

2. **Create Database**
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Create new database or import `database/schema.sql` file
   - Run the schema to create all 9 tables

3. **Configure Database Connection**
   - Edit `config/config.php`
   - Update database credentials:
     ```php
     define('DB_HOST', 'localhost');     // Your MySQL host
     define('DB_USER', 'root');          // Your MySQL username
     define('DB_PASS', '');              // Your MySQL password (if any)
     define('DB_NAME', 'shoe_seller');   // Database name
     ```
   - Update BASE_URL if needed:
     ```php
     define('BASE_URL', 'http://localhost:8080/Shoe-Seller');
     ```

4. **Set File Permissions**
   - Make upload directories writable:
     ```bash
     chmod 755 public/images/
     chmod 755 public/admin_assets/
     ```

5. **Verify .htaccess is Enabled**
   - Check Apache's `httpd.conf` has `mod_rewrite` enabled
   - Verify `AllowOverride All` is set for the project directory
   - Test with: http://localhost:8080/Shoe-Seller/users/login (should work without index.php)

6. **Start Apache and MySQL**
   - Via XAMPP Control Panel
   - Or via terminal: `xampp start` (Windows)

7. **Access the Application**
   - **Homepage**: http://localhost:8080/Shoe-Seller/
   - **Login**: http://localhost:8080/Shoe-Seller/users/login
   - **Register**: http://localhost:8080/Shoe-Seller/users/register
   - **Admin Dashboard**: http://localhost:8080/Shoe-Seller/admin/

### Default Credentials
- The database schema includes default admin account setup
- Check `database/schema.sql` for initial admin credentials
- Create test users via registration form at `/users/register`

### Database Sample Data
- Insert sample data into tables via phpMyAdmin after schema creation
- Or run INSERT statements from `database/schema.sql`

### Verification Checklist
- [ ] Database connected and tables created
- [ ] `.htaccess` URL rewriting working (clean URLs without index.php)
- [ ] Login page accessible at `/users/login`
- [ ] Admin dashboard accessible at `/admin/` (requires login as admin)
- [ ] Sessions working (login/logout functionality)
- [ ] No 404 errors when accessing controllers

---

## Quick Start - Currently Working Features

### 🌐 Public Accessible Routes
- **Homepage**: `/` or `/home/` - View homepage
- **Login**: `/users/login` - User login form with email/username support
- **Register**: `/users/register` - User registration form

### 🔐 Authenticated Routes
- **User Dashboard**: `/users/` - User profile (requires login)
- **Admin Dashboard**: `/admin/` - Admin dashboard (requires admin role)

### 🔧 Technical Features Ready to Use
- Clean URL routing system (no index.php needed)
- Session-based authentication
- Admin role checking and redirection
- User status verification (ban/active)
- Secure password handling with hashing
- PDO database queries with prepared statements
- MVC pattern with controller-based architecture

### 📝 Next Steps to Complete Core Features
1. Create **Models** for database operations (Users, Products, Orders, etc.)
2. Build **Product Management** (listing, details, search)
3. Implement **Shopping Cart** functionality
4. Develop **Admin CRUD operations** for all resources
5. Create **News/Blog system**
6. Add **Comment/Review system**
7. Implement **Image upload** functionality
8. Add **Search and filtering** features

---

### 🤝 Common Tasks (All Members)
- Design application model (MVC without framework)
- Design relational database
- Design common templates for website
- User registration/login interface and functionality
- User permission/role management
- User management for admin (view, reset password, lock users)
- User profile management (change info, password, avatar)

### 📌 Individual Tasks (Choose One Per Member)

#### Task #1
**Public Pages:**
- Homepage
- Contact page

**Admin Management:**
- Website content management (company info, phone, address, images, logo)
- Customer contact management (view, mark as read/replied, delete)

**Contact Email:** [Team Member 1]

---

#### Task #2
**Public Pages:**
- About page
- FAQ page

**Admin Management:**
- Website content management for assigned pages
- FAQ management (CRUD operations)

**Contact Email:** [Team Member 2]

---

#### Task #3
**Public Pages:**
- Product listing page (with keyword search)
- Product details page
- Shopping cart

**Admin Management:**
- Product management (view/search, add, edit, delete)
- Cart and order management (view info, change status)

**Contact Email:** [Team Member 3]

---

#### Task #4
**Public Pages:**
- News/blog listing page (with keyword search)
- News/blog detail page (read article)

**Admin Management:**
- News management (view/search, add, edit, delete)
- Comment/review management for articles

**Contact Email:** [Team Member 4]

---

## Implementation Notes

### Admin Dashboard
- Use Srtdash template for admin interface
- Repository: https://github.com/puikinsh/srtdash-admin-dashboard
- Demo: https://colorlib.com/polygon/srtdash/index.html

### Important Requirements
1. **Input Validation**: Validate all forms on both client (JavaScript) and server (PHP)
2. **Pagination**: Implement for all long listing pages
3. **Image Upload**: Upload to server, don't use external URLs
4. **W3C Validation**: Test HTML5/CSS3 at validator.w3.org
5. **Security**: Prevent SQL injection, XSS, and other common vulnerabilities
6. **SEO**: Optimize meta tags, keywords, descriptions for each page

---

## Submission Requirements

### 📝 Report (Minimum 20 pages)
Required sections:
- **Cover Page**: Group contact email
- **Introduction**: Understanding of company/business websites
- **Theoretical Foundation**: 
  - Libraries and technologies used (advantages/disadvantages)
  - Web security vulnerabilities and prevention
  - SEO optimization
- **Application Design**: 
  - Database design and table descriptions
  - Source code structure and MVC model
  - Application features and flowcharts
- **Implementation**: 
  - Feature descriptions with screenshots/images
- **Installation Guide**: 
  - Installation steps
  - Required environment and PHP version
- **Team Roles**: 
  - Task distribution among members
- **References**: 
  - Sources and resources used

### 📦 Deliverables
- Source code (all PHP, HTML, CSS, JavaScript files)
- Database file (schema.sql with sample data)
- Installation guide
- Report (hard copy and soft copy)
- Working demo during presentation

### 🎓 Evaluation Criteria
- **Feature Quantity & Quality**: Number and completeness of implemented features
- **UI/UX Design**: Interface beauty and usability
- **Database Design**: Proper normalization and structure
- **Code Quality**: Proper MVC structure, clean code
- **Security**: Input validation, protection against attacks
- **Responsive Design**: Works on mobile, tablet, desktop
- **Browser Compatibility**: Tested on multiple browsers

### ⚠️ Plagiarism Policy
- Copying source code from other websites without original work = 0 points
- Identical code with other groups or previous years = 0 points (fraud)
- All code must be written by group members

---

## Important Notes

### Code Quality Standards
- ✅ Custom MVC implementation (no frameworks)
- ✅ PHP 7.0+ syntax
- ✅ UTF-8 encoding for Vietnamese text
- ✅ Proper autoloading and namespace organization
- ✅ Input validation on both client and server
- ✅ SQL injection prevention (prepared statements)
- ✅ XSS attack prevention

### Bonus Points
- Extra features beyond requirements
- Beautiful and professional UI design
- Advanced database design
- Security best practices implementation
- Advanced JavaScript features (AJAX, animations, etc.)

### Grading Note
- Points are calculated per individual member
- Each member's grade depends on their assigned tasks
- All members must participate and complete their assigned work
- Members not participating will receive 0 points and won't be listed in report

---

## Contact & Questions

For questions about the assignment, contact:
- **Instructor**: [Instructor Name]
- **Lab Session**: [Day and Time]

For group coordination:
- Share contact emails among group members
- Notify instructor of any team changes

---

## Development Timeline

- **Week 1-2**: Planning, database design, MVC structure setup
- **Week 3-4**: Common features (auth, user management)
- **Week 5-6**: Individual feature development
- **Week 7**: Integration, testing, bugfixes
- **Week 8**: Report writing, final polishing
- **Week 9**: Demo presentation and submission

---

## Resources

### Documentation
- W3C Validation: http://validator.w3.org
- Srtdash Dashboard: https://github.com/puikinsh/srtdash-admin-dashboard
- PHP Documentation: https://www.php.net/manual/

### Recommended Libraries
- Bootstrap 5+ (for responsive design)
- jQuery (for DOM manipulation)
- DataTables (for table management)
- WYSIWYG Editors (for rich text)
- File upload libraries

---

---

**Last Updated**: May 5, 2026  
**Project Status**: Core Framework Complete - Feature Development in Progress  
**Version**: 1.0-beta

### Latest Updates (May 2026)
✅ MVC routing system with URL rewriting  
✅ User authentication system (login/register)  
✅ Admin dashboard integration (Srtdash template)  
✅ Session-based access control  
✅ Secure password handling with PDO prepared statements  
✅ Role-based permission checking  
✅ Database schema with 9 normalized tables  
✅ Complete admin template assets integrated  

### In Development
🔄 Database models for data operations  
🔄 Product management system  
🔄 Shopping cart and order processing  
🔄 Blog/News management  
🔄 Comment/Review system  
🔄 Admin CRUD operations
