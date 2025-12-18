# Laravel + Bitmask + Survey + APP

Laravel survey form generated based on bitmasking so that huge number of fields can be stored in database in an optimized way.
Suppose, a survey form might have 100 questions that belongs several dropdown or multiselect values for each questions. But we can approach 100 fields in database. We've stored the data in one column in database using binary bit value for each option values.
## Project Details

- **GitHub Repository**: [https://github.com/shohag-cse-knu/laravel-bitmask-survey-app.git](https://github.com/shohag-cse-knu/laravel-bitmask-survey-app.git)

## Features
- **List**: 
- **Add Survey**:
- **Update Survey**:
- **Delete Survey**:
- **Report**: 

## Prerequisites

- **Laravel**: The minimum Laravel version required for ACL is Laravel 12.
- **PHP**: Livewire requires PHP version 8.2 or higher.
- **Composer**: Since Laravel is installed via Composer, make sure you have Composer installed on your system.

## Setup Instructions

### 1. Clone the Repository
```bash
git clone https://github.com/shohag-cse-knu/laravel-bitmask-survey-app.git
````
### 2. Change the .env
Modify Database name, db user and password.

### 3. Composer Update
```bash
composer update
````
### 4. Key Generate
```bash
php artisan key:generate
````
### 5. DB Migration
```bash
php artisan migrate
````
### 5. Seeding
```bash
php artisan db:seed
````
### 8. Run 
```bash
php artisan serve
````

## Technologies Used

- **Frontend**: HTML, CSS, Blade
- **Backend**: Laravel, Bitmask, MySql(You can also use other database)

## Contributing

To contribute:

1. Fork the repository.
2. Create a branch (`git checkout -b feature-name`).
3. Commit your changes (`git commit -m 'Add feature'`).
4. Push to the branch (`git push origin feature-name`).
5. Open a pull request.

## Contact

For questions or suggestions, please contact:

- **Name**: Syfur Rahaman Shohag
- **Email**: [syfur.srs@gmail.com](mailto:syfur.srs@gmail.com)
- **GitHub**: [https://github.com/shohag-cse-knu](https://github.com/shohag-cse-knu)
