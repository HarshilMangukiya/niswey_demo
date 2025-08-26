# Contact Management System

A professional Laravel application for managing contacts with full CRUD functionality and XML bulk import capabilities.

## Features

- **Full CRUD Operations**: Create, Read, Update, and Delete contacts
- **Bulk XML Import**: Import multiple contacts from XML files
- **Professional UI**: Clean Bootstrap-based interface with Font Awesome icons
- **Data Validation**: Comprehensive form validation and error handling
- **Sample Data**: 20 pre-seeded sample contacts
- **Duplicate Prevention**: Automatic handling of duplicate email addresses

## Requirements

- PHP 8.1 or higher
- MySQL 5.7 or higher
- Composer
- Laravel 12.x

## Installation

1. **Clone the repository**
   ```bash
   git clone <your-repo-url>
   cd niswey_task
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Environment configuration**
   - Copy `.env.example` to `.env`
   - Update database settings in `.env`:
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=niswey_task_db
     DB_USERNAME=root
     DB_PASSWORD=your_password
     ```

4. **Generate application key**
   ```bash
   php artisan key:generate
   ```

5. **Run migrations and seeders**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Start the development server**
   ```bash
   php artisan serve
   ```

## Usage

### Managing Contacts

- **View All Contacts**: Navigate to `/contacts` to see all contacts
- **Add Contact**: Click "Add Contact" button or visit `/contacts/create`
- **Edit Contact**: Click the edit button on any contact row
- **View Details**: Click the view button to see full contact information
- **Delete Contact**: Use the delete button with confirmation

### XML Import

1. Navigate to "Import XML" in the navigation
2. Upload an XML file with the following structure:
   ```xml
   <?xml version="1.0" encoding="UTF-8"?>
   <contacts>
       <contact>
           <first_name>John</first_name>
           <last_name>Doe</last_name>
           <email>john.doe@example.com</email>
           <phone>+1-555-0101</phone>
       </contact>
   </contacts>
   ```
3. The system will automatically:
   - Validate the XML format
   - Skip duplicate emails
   - Import valid contacts
   - Show import results

### Demo XML File

A sample XML file is included at `storage/app/demo/demo-contacts.xml` for testing the import functionality.