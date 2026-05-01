<p align="center">
  <img src="public/logo.svg" alt="Karivio Logo" width="200">
</p>

<h1 align="center">Karivio</h1>

<p align="center">
  <strong>Modern Job Application & CV Management System</strong><br>
  Built with Laravel, Livewire, and Google API Integration.
</p>

---

## 🚀 Features

- **📄 CV Builder**: Create and manage professional CVs with dynamic data entry.
- **✉️ Cover Letter Generator**: Tailor your cover letters for every job application.
- **📧 Gmail Integration**: Send job applications directly from the platform using Google API.
- **📊 Application Tracking**: Keep track of sent emails and application history.
- **📁 File Management**: Centralized dashboard for managing your career documents.
- **📥 PDF Export**: High-quality PDF generation for CVs and Cover Letters.
- **🔐 Google OAuth**: Secure and easy authentication via Google.

## 🛠️ Tech Stack

- **Framework**: [Laravel 13](https://laravel.com)
- **Frontend**: [Livewire 4](https://livewire.laravel.com) & [Alpine.js](https://alpinejs.dev)
- **PDF Engine**: [Laravel-DomPDF](https://github.com/barryvdh/laravel-dompdf)
- **Integration**: [Google API Client](https://github.com/googleapis/google-api-php-client)
- **Database**: MySQL / PostgreSQL

## 💻 Getting Started

### Prerequisites
- PHP 8.4+
- Composer
- Node.js & NPM
- MySQL

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/karivio.git
   cd karivio
   ```

2. **Run setup script**
   This project includes a shorthand setup command:
   ```bash
   composer setup
   ```
   *This will install dependencies, create `.env`, generate app key, and run migrations.*

3. **Configure Environment**
   Update your `.env` file with Google API credentials:
   ```env
   GOOGLE_CLIENT_ID="your-id"
   GOOGLE_CLIENT_SECRET="your-secret"
   GOOGLE_REDIRECT_URI="http://127.0.0.1:8000/oauth/google/callback"
   ```

4. **Launch Application**
   ```bash
   php artisan serve
   ```

## 📄 License

The Karivio platform is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

