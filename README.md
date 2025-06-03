# 📚 Online Bookstore

A powerful, multilingual online bookstore built with a clean and modern frontend and a robust admin dashboard. Designed for seamless user experience, efficient book management, and insightful analytics.

---

## 🚀 Features

### 🛍️ Frontend (User Panel)

- 🌐 Multilingual Support (e.g., English / Arabic)
- 🔍 Live Search on Homepage (using Livewire)
- 🏷️ Home Sections: Best Sellers, Recommended Books, Flash Sale with Countdown
- 📚 Books Page with:
  - Add to Wishlist
  - Add to Cart
  - Filters (Category, Publisher, Year Range)
- 🛒 Cart Page with Livewire updates
- 💳 Secure Checkout with Paymob (Builder Design Pattern)
- 🔐 Authentication:
  - Login/Register
  - Social Login (Facebook, Google, GitHub) via Laravel Socialite
  - Email Verification
  - Forgot Password
- 🙍‍♂️ Profile Page & Order History
- 📄 About Us & Contact Us Pages

### 🛠️ Admin Dashboard

- 👤 Admin Management
- 🎁 Discounts & Flash Sales
- 🗂️ Categories, Publishers, Authors, Books Management
- 🌍 Shipping Areas
- 📦 Orders Management
- 📊 Reports:
  - Sales (Books, Total Revenue, Weekly/Yearly Trends)
  - Best Selling (Books, Categories, Authors)
- 📥 Excel Import/Export
- 🔎 Advanced Filtering & Search
- 📬 Message Management

---

## 💻 Tech Stack

- **Laravel** + **Livewire**
- **PHP**, **MySQL**
- **Bootstrap**
- **Paymob API**
- **Laravel Socialite**
- **Blade Templates**

---

Follow the steps below to run the project locally.

### 1. Clone the repository

```bash
git clone https://github.com/youssefreda4/book-store.git
cd book-store
```

### 2. Install dependencies
```bash
composer install
npm install && npm run dev
```

### 3. Set up environment file

cp .env.example .env
```bash
php artisan key:generate
```

### 4. Configure .env
Open the .env file and configure the following:

-✅ Database Settings
-🔑 Paymob API Keys
-🔐 Socialite Credentials (Google, Facebook, GitHub)

### 5. Run migrations and seeders
```bash
php artisan migrate --seed
```
### 6. Link storage and serve the app
```bash
php artisan serve
```
