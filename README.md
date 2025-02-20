# 📋 Task Manager API

A simple **Laravel 10** RESTful API for managing tasks with **authentication** using **Laravel Sanctum**.

---

## 🚀 Features

- User Authentication (Login/Register) with **Laravel Sanctum**.
- CRUD operations for managing tasks.
- Tasks linked to authenticated users.
- API routes secured with Sanctum.

---

## 🛠️ Tech Stack

- **Laravel 10**
- **Laravel Sanctum** (for API authentication)
- **MySQL** (or any preferred database)
- **PHP 8.1+**

---

## ⚙️ Setup Instructions

1. **Clone the repository:**

```bash
git clone https://github.com/ahmedTarek14/Laravel-Assignment.git
cd Laravel-Assignment
```

2. **Install dependencies:**

```bash
composer install
```

3. **Setup environment variables:**

```bash
cp .env.example .env
```

Update **`.env`** with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

4. **Generate application key:**

```bash
php artisan key:generate
```

5. **Run migrations:**

```bash
php artisan migrate
```

6. **Install & Configure Sanctum:**

```bash
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

7. **Run the development server:**

```bash
php artisan serve
```

API now runs at **`http://127.0.0.1:8000`** 🚀

---

## 🔐 Authentication (Sanctum)

1. **Register:**

```http
POST /api/register

{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password",
  "password_confirmation": "password"
}
```

2. **Login:**

```http
POST /api/login

{
  "email": "john@example.com",
  "password": "password"
}
```

🔑 The login will return a **Bearer Token**. Use it to authorize API requests:

```http
Authorization: Bearer YOUR_TOKEN_HERE
```

---

## 📋 API Endpoints

All routes are prefixed with **`/api`** and protected by **Sanctum**.

### 🔑 Auth Routes

- **POST** `/api/auth/register` — Register a new user.
- **POST** `/api/auth/login` — Login and get token.

### ✅ Task Routes

- **GET** `/api/task/all` — Get all tasks.
- **POST** `/api/task/create` — Create a new task.
- **PUT** `/api/task/update/{id}` — Update an existing task.
- **DELETE** `/api/task/delete/{id}` — Delete a task.

---

## 🗃️ Task Model Structure

| Field     | Type    | Description                     |
|-----------|---------|---------------------------------|
| id        | integer | Auto-increment primary key      |
| title     | string  | Title of the task (required)    |
| status    | enum    | pending, in-progress, completed |
| user_id   | integer | Linked user (foreign key)       |
| created_at| timestamp| Auto-generated                 |
| updated_at| timestamp| Auto-generated                 |

---

## 📖 License

This project is **open-source** and available under the [MIT License](LICENSE).

---

✨ Built with ❤️ using **Laravel 10**

