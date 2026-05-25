# 🚗 Car Rental Management System

A car rental management and booking platform built with Laravel 12. It includes an administration dashboard and secure payment gateway integration using Stripe.

---

## Requirements

- PHP >= 8.2
- Composer
- MySQL / MariaDB

---

## Installation

1. **Clone the repository**
```bash
git clone https://github.com/your-username/car-rental-laravel.git
```
```bash
cd car-rental-laravel
```
2. **Install dependencies**
```bash 
composer install
```
3. **Environment configuration**
```bash 
copy .env.example .env 
```
(Note: If you are on Linux/macOS, use cp .env.example .env instead)

4. **Generate application key**
```bash 
php artisan key:generate
```
5. **Database Migration & Seeding**
```bash 
php artisan migrate --seed
```
6. **Run the application**
```bash 
php artisan serve
```
## Admin Credentials

The administrator account is automatically created via the database seeder. You can log in using the following credentials:

- **Email:** `User@gmail.com`
- **Password:** `12345678`

---

## Stripe Configuration

To activate the Stripe payment gateway, add your API keys at the bottom of your `.env` file:

env
STRIPE_KEY=pk_test_your_publishable_key_here
STRIPE_SECRET=sk_test_your_secret_key_here

Make sure your `config/services.php` includes the following configuration:

```bash 
php
'stripe' => [
    'key' => env('STRIPE_KEY'),
    'secret' => env('STRIPE_SECRET'),
],
```
## Task Scheduling
This project uses Laravel's task scheduler to automatically cancel expired bookings. To run the scheduler locally during development, keep this command running in a separate terminal window:

```bash
php artisan schedule:work
```