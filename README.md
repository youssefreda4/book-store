# 📚 Online Bookstore

A powerful, multilingual online bookstore built with a clean and modern frontend and a robust admin dashboard. Designed for seamless user experience, efficient book management, and insightful analytics.

---

## 🚀 Features

### 🛍️ Frontend (User Panel)

- 🌐 Multilingual Support (e.g., English / Arabic)
- 🔍 Live Search on Homepage (using Livewire)
- 🏷️ Home Sections: Best Sellers, Recommended Books, Flash Sale with Countdown
- 📚 Books Page with Wishlist, Add to Cart, Filters (Category, Publisher, Year)
- 🛒 Cart Page with Livewire updates
- 💳 Secure Checkout with Paymob (Builder Design Pattern)
- 🔐 Social Login (Facebook, Google, GitHub) via Socialite
- 🔁 Email Verification, Password Reset, Full Authentication System
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

## 📦 Installation

Clone the repository:

```bash
git clone https://github.com/youssefreda4/book-store.git
cd book-store

Install dependencies:
```bash
composer install
npm install && npm run dev

Set up environment variables:
cp .env.example .env
php artisan key:generate
Configure your .env file:

Set your database credentials

Add Paymob API keys

Add Socialite credentials (Google, Facebook, GitHub)

Run migrations and seeders:

bash
Copy
Edit
php artisan migrate --seed
Link storage and serve the app:

bash
Copy
Edit
php artisan storage:link
php artisan serve
You can now access the app at http://127.0.0.1:8000.

