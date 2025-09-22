# Laravel Contact Management API

This is a **Laravel 12 API project** for managing contacts with full CRUD functionality and XML import support.

## Requirements

-   PHP >= 8.1
-   Composer
-   MySQL
-   Laravel 12
-   Postman (for API testing)

---

## Installation

1. Clone the repository:

```bash
git clone <repository-url>
cd contacts-crud
```

2. Install dependencies:

```bash
composer install or composer install --ignore-platform-reqs
```

3. Copy `.env` file:

```bash
cp .env.example .env
```

4. Generate application key:

```bash
php artisan key:generate
```

---

## Configuration

Update your `.env` with database credentials:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=contacts_db
DB_USERNAME=root
DB_PASSWORD=
```

---

## Database Migration

Run migrations to create the contacts table:

```bash
php artisan migrate
```

(Optional) Seed sample data:

```bash
php artisan db:seed
```

---

## Running the Application

Start the Laravel development server:

```bash
php artisan serve
```

The API will be available at `http://127.0.0.1:8000/api`.

---

## API Endpoints

| Action         | Method | URL                        | Request Body                                        |
| -------------- | ------ | -------------------------- | --------------------------------------------------- |
| List contacts  | GET    | `/api/contacts`            | -                                                   |
| Show contact   | GET    | `/api/contacts/{id}`       | -                                                   |
| Create contact | POST   | `/api/contacts`            | `{ "name": "Sarika Singh", "phone": "1234567890" }` |
| Update contact | PUT    | `/api/contacts/{id}`       | `{ "name": "Updated Name", "phone": "0987654321" }` |
| Delete contact | DELETE | `/api/contacts/{id}`       | -                                                   |
| Import XML     | POST   | `/api/contacts/import-xml` | Form-data: key=`file`, value=`contacts.xml`         |

---

## Testing

1. Run all tests:

```bash
php artisan test
```
