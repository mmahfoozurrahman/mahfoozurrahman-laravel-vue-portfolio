# Mahfoozur Rahman — Personal Portfolio (Craftsman Hub)

A full-stack personal portfolio and content-management web application for **Mahfoozur Rahman**, built with **Laravel 13**, **Inertia.js 3**, and **Vue 3**. The public side showcases Home, Experience Timeline, Portfolio, GitHub Repos, and a Contact form. The private `/admin` panel allows the owner to manage every piece of content (projects, experience timeline, site settings, contact inquiries) through a protected dashboard.

The frontend ships with a polished UI: dark/light theme, AOS scroll animations, an animated preloader, page-transition spinner, a floating AI assistant widget, and a SweetAlert2 confirmation flow.

---

## ✨ Features

### Public Portfolio (Inertia + Vue 3)
- **Home** — Hero, intro, dynamic owner settings from the database.
- **Experience Timeline** — Career milestones rendered from `Experience` model, ordered by `sort_order`.
- **Portfolio** — Project showcase grid with tech stack, demo & GitHub links, featured flag.
- **GitHub** — Cached repository listing (stars, forks, language, last push) sorted by star count.
- **Contact** — Public form (name, email, subject, message) with server-side validation; submissions are stored in the `contact_messages` table and visible in the admin inbox.
- **AI Chat Widget** — Floating assistant on every public page with a configurable welcome message.

### Admin Panel (`/admin`)
- **Authentication** — Email + password login, "Keep me signed in" toggle, session regeneration on success, CSRF-protected logout.
- **Dashboard** — Live metrics: total projects, total experiences, total messages, unread messages, plus 5 most recent inquiries.
- **Projects (CRUD)** — Title, slug (auto), category, short + long description, tech stack (array), demo URL, GitHub URL, image upload (jpeg/png/jpg/gif/svg, max 2 MB), featured flag, status, sort order.
- **Experiences (CRUD)** — Role, company, location, start/end dates, accomplishments (array), skills (array), image upload, featured flag, sort order.
- **Site Settings** — Single-row settings manager: owner name/role/bio, avatar upload, location, relocation notice, email, LinkedIn, GitHub, AI assistant welcome message, meta description, resume PDF upload (max 5 MB).
- **Messages Inbox** — List, view (auto-marks as read on view), mark-read, archive, delete, IP captured per submission.

### UX & Design
- **Dark / Light theme** toggle, persisted in `localStorage` and reflected via CSS variables.
- **AOS (Animate On Scroll)** for section reveals.
- **Preloader** on initial load + **page-switch spinner** during Inertia navigation.
- **SweetAlert2** confirmations and toasts.
- **Bootstrap 5** grid + utility classes, scoped component styles.
- Fully responsive (mobile, tablet, desktop).

---

## 🧱 Tech Stack

| Layer       | Technology |
|-------------|------------|
| Backend     | PHP 8.3, Laravel 13.8 |
| Frontend    | Vue 3.5, Inertia.js 3.3 |
| Bundler     | Vite 8 + `laravel-vite-plugin` |
| Styling     | Bootstrap 5.3, Font Awesome, custom CSS variables |
| Animation   | AOS 2.3, SweetAlert2 11 |
| Database    | SQLite (default `database/database.sqlite`) — swap to MySQL/Postgres via `.env` |
| Testing     | PHPUnit 12, Mockery, Faker, Laravel Pint |
| Dev tools   | `concurrently`, Laravel Pail (log tailing), `nunomaduro/collision` |

---

## 📁 Project Structure

```
app/
├── Http/Controllers/
│   ├── AppLayoutController.php        # Renders public Inertia pages
│   ├── ContactController.php          # Stores public contact submissions
│   └── Admin/
│       ├── AuthController.php         # Admin login / logout
│       ├── DashboardController.php    # Admin metrics
│       ├── ProjectController.php      # Projects CRUD
│       ├── ExperienceController.php   # Experience CRUD
│       ├── SiteSettingController.php  # Global site settings
│       └── ContactMessageController.php # Inbox manager
└── Models/
    ├── User.php
    ├── Project.php
    ├── Experience.php
    ├── GithubRepo.php
    ├── ContactMessage.php
    └── SiteSetting.php

resources/js/
├── app.js                              # Vite entry
├── Layouts/
│   ├── AppLayout.vue                   # Public layout (Navbar/Footer/AI/Preloader)
│   └── AdminLayout.vue                 # Admin layout
├── Components/
│   ├── Navbar.vue
│   ├── Footer.vue
│   └── AIChatWidget.vue
└── Pages/
    ├── Home.vue / Experience.vue / Portfolio.vue / GitHub.vue / Contact.vue
    └── Admin/
        ├── Dashboard.vue
        ├── Login.vue
        ├── Projects/  (Index.vue, Form.vue)
        ├── Experiences/ (Index.vue, Form.vue)
        ├── Messages/ (Index.vue, Show.vue)
        └── Settings/Form.vue

routes/web.php                          # All public + admin routes
database/migrations/                    # users, projects, experiences, contact_messages, github_repos, site_settings
```

---

## 🚀 Getting Started

### Prerequisites
- PHP **8.3+**
- Composer **2.x**
- Node.js **20+** & npm
- A database (SQLite by default; MySQL/PostgreSQL also supported)

### Installation

```bash
# 1. Clone the repository
git clone <your-repo-url> mahfoozurrahman-portfolio
cd mahfoozurrahman-portfolio

# 2. Install PHP dependencies
composer install

# 3. Install JS dependencies
npm install --ignore-scripts

# 4. Create environment file
cp .env.example .env
php artisan key:generate

# 5. Create SQLite database (or configure MySQL in .env)
# On Windows / Linux / macOS:
touch database/database.sqlite   # macOS/Linux
# On Windows PowerShell: New-Item database/database.sqlite -ItemType File

# 6. Run migrations
php artisan migrate

# 7. (Optional) Seed an admin user
php artisan tinker
# >>> App\Models\User::create(['name' => 'Admin', 'email' => 'admin@example.com', 'password' => bcrypt('password')]);

# 8. Build frontend assets
npm run build
```

### Development

```bash
# Run everything in parallel (server, queue, logs, vite)
composer run dev

# Or run individually:
php artisan serve
npm run dev
```

Visit:
- Public site → http://127.0.0.1:8000
- Admin login → http://127.0.0.1:8000/admin/login

### Testing

```bash
php artisan test
```

---

## 🔐 Admin Access

All admin routes live under `/admin` and are protected by Laravel's `auth` middleware (login routes are wrapped in `guest`).

| Route                       | Method   | Purpose                         |
|----------------------------|----------|---------------------------------|
| `/admin/login`             | GET/POST | Admin authentication            |
| `/admin/dashboard`         | GET      | Metrics & recent messages       |
| `/admin/projects`          | CRUD     | Manage portfolio projects       |
| `/admin/experiences`       | CRUD     | Manage career timeline          |
| `/admin/settings`          | GET/POST | Edit global site settings       |
| `/admin/messages`          | GET      | Inbox listing                   |
| `/admin/messages/{id}`     | GET      | View message (auto marks read)  |
| `/admin/messages/{id}/mark-read` | POST | Mark a message as read         |
| `/admin/messages/{id}/archive`  | POST | Archive a message              |
| `/admin/messages/{id}`     | DELETE   | Delete a message                |
| `/admin/logout`            | POST     | Log out                         |

---

## 🗃 Data Models (high level)

| Model             | Purpose |
|-------------------|---------|
| `User`            | Admin user for `/admin` |
| `Project`         | Portfolio entries — `tech_stack` cast to array, `is_featured` boolean, auto-generated `slug` |
| `Experience`      | Career timeline — `accomplishments` & `skills` cast to arrays |
| `GithubRepo`      | Cached GitHub repos for the `/github` page (stars, forks, language, last push) |
| `ContactMessage`  | Inquiries from the public form — `status` ∈ {unread, read, archived}; IP captured |
| `SiteSetting`     | Single-row global config (owner info, socials, AI welcome, avatar, resume) |

---

## ⚙️ Configuration

Key `.env` variables (beyond Laravel defaults):

```dotenv
APP_NAME="Mahfoozur Rahman Portfolio"
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=sqlite           # or mysql/pgsql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=portfolio
# DB_USERNAME=root
# DB_PASSWORD=

SESSION_DRIVER=database        # required if you want sessions persisted
QUEUE_CONNECTION=database
```

Storage link (required for uploaded images / resumes):

```bash
php artisan storage:link
```

---

## 🧪 Scripts

| Command             | Description |
|---------------------|-------------|
| `composer run dev`  | Run server, queue listener, log tail, and Vite together |
| `npm run dev`       | Vite dev server with HMR |
| `npm run build`     | Production frontend build |
| `php artisan test`  | Run PHPUnit test suite |
| `vendor/bin/pint`   | Laravel Pint code formatter |

---

## 🤝 Contributing

This is a personal portfolio codebase — feel free to fork it as a template for your own portfolio. PRs to the upstream are welcome for bug fixes only.

## 📄 License

The Laravel framework is open-sourced under the [MIT license](https://opensource.org/licenses/MIT). The portfolio content and branding of this repository belong to Mahfoozur Rahman.

---

**Author:** Mahfoozur Rahman · **Stack:** Laravel 13 · Inertia.js 3 · Vue 3 · Vite 8 · Bootstrap 5
