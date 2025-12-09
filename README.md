# 🚀 LPK MUDA GEMILANG - Official Website

This is the official repository for the LPK MUDA GEMILANG website, built using the **Laravel** framework and **Blade** templates, with **Livewire** components for dynamic interfaces.

## 🌟 Features

- **Public Portal:** Detailed information about the LPK (Training Center), including services, testimonials, and contact information.
- **Program Pages:** Dedicated pages for specific programs like "Pemagangan Jepang," "Tokutei Ginou," and "IM Japan."
- **Online Registration:** Form submission for prospective students (`/form-pendaftaran`).
- **Admin Dashboard:** Secure backend area for managing users and content (requires authentication).
- **Livewire Integration:** Used for dynamic elements in the dashboard and user settings (e.g., login, profile management).

## 🛠️ Technology Stack

- **Framework:** Laravel
- **Frontend:** Blade Templates, Vanilla JS/jQuery (or similar), CSS/Bootstrap
- **Dynamic UI:** Laravel Livewire
- **Database:** (Specify your database here, e.g., MySQL, PostgreSQL)

## 📦 Installation Guide

Follow these steps to get a local copy up and running for development and testing.

### Prerequisites

- PHP (8.1+)
- Composer
- Node.js & npm
- A Database (e.g., MySQL)

### 1. Clone the Repository

```bash
git clone [https://github.com/titanaprilian/lpk-muda-gemilang](https://github.com/titanaprilian/lpk-muda-gemilang)
cd lpk-muda-gemilang
```

### 2. Install Dependencies

```bash
composer install
npm install
npm run dev # or npm run build for production assets
```

### 3. Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Migration & Seeding

```bash
php artisan migrate --seed
```

### 5. Start the Server

```bash
php artisan serve
```

## 🤝 Contributing

We welcome contributions! If you have suggestions or want to report a bug, please open an issue or submit a pull request.

## 📜 License

The Laravel framework is open-sourced software licensed under the MIT license.
