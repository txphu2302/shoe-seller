# Shoe Seller - Web Application Project

## Project Overview

**Shoe Seller** is a web-based e-commerce platform for a shoe company/business built as a semester project for Web Programming course (HK2 2025-2026). The project implements a custom MVC (Model-View-Controller) architecture without using any PHP frameworks, following academic requirements.

---

## Current Project Status

### ✅ Already Implemented
- **MVC Architecture**: Custom routing system with App.php router
- **Database Design**: Complete MySQL schema with all necessary tables
- **Project Structure**: Organized folder structure for controllers, models, views, and configuration
- **Session Management**: Session handling for user authentication
- **Database Configuration**: Config file for database connection setup
- **Core Classes**: 
  - `App.php` - Router and application kernel
  - `Controller.php` - Base controller class
  - `Database.php` - Database connection management
- **Home Controller**: Basic home page controller
- **Database Tables**:
  - `users` - User accounts with roles (admin, member)
  - `products` - Product catalog with categories
  - `categories` - Product categories
  - `product_attributes` - Product sizes and stock management
  - `orders` & `order_details` - Order management
  - `contacts` - Customer contact messages
  - `faqs` - Frequently asked questions
  - `settings` - Website configuration (logo, phone, address, etc.)

### ⏳ To Be Implemented
- User authentication (registration, login, logout)
- User profile management (change password, avatar, info)
- Admin dashboard
- Product management system
- Shopping cart and checkout
- Order management
- Comment/review system
- News/Blog management
- Contact form handling
- FAQ management
- Image upload functionality
- Search and filtering features
- Pagination for listings

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
├── index.php                 # Entry point with autoloader
├── config/
│   └── config.php           # Database and path configuration
├── app/
│   ├── core/
│   │   ├── App.php          # Router and application kernel
│   │   ├── Controller.php   # Base controller class
│   │   └── Database.php     # Database connection class
│   ├── controllers/
│   │   └── HomeController.php
│   ├── models/              # Model classes (to be created)
│   └── views/
│       ├── home/
│       │   └── index.php
│       └── layouts/
│           ├── header.php
│           └── footer.php
├── database/
│   └── schema.sql           # Database schema
├── public/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   ├── images/
│   └── admin_assets/        # Dashboard template resources
└── README.md
```

---

## Installation & Setup

### Prerequisites
- PHP 7.0 or higher
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
   - Import `database/schema.sql` file

3. **Configure Database Connection**
   - Edit `config/config.php`
   - Update DB_HOST, DB_USER, DB_PASS, DB_NAME if needed
   - Update BASE_URL to match your setup

4. **Set File Permissions**
   - Make upload directories writable (e.g., public/images/)

5. **Start Apache and MySQL**
   - Via XAMPP Control Panel or terminal
   - Access: http://localhost:8080/Shoe-Seller

6. **Default Admin Account**
   - Username: admin@shoeseller.com
   - Password: admin123
   - *(Create from schema.sql insertion)*

---

## Group Task Assignment

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

**Last Updated**: May 2026  
**Project Status**: In Development  
**Version**: 1.0-alpha
