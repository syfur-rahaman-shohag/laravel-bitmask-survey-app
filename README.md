# Laravel + Bitmask + Survey + APP

Laravel survey form generated based on bitmasking so that huge number of fields can be stored in database in an optimized way.
Suppose, a survey form has 100 questions that belongs several dropdown or multiselect values for each questions. But we can't incorporate 100 fields in database or save multiselect/checkbox values in comma seperated. We've stored the data in one column in database using binary bit value (bitmask) for each option values.

# How Bitmask Works
For each option it uses 2^0 to 2^59 for each option fields like select or checkboxes. 
Such as 
Male, 2^0 = 1     (    1)
Female, 2^1 = 2   (   10)
Other, 2^2 = 4    (  100)
OptionA, 2^3 = 8  ( 1000) 
OptionB, 2^4 = 16 (10000)

If an user select Male and checked both OptionA and OptionB, 
bitmask = 1 + 8 + 16 = 25 
or binary OR operation = 1 | 1000 | 10000 = 11001, which is equivalent to Decimal 25.
Now if we want to extract OptionB value that was checked earlier or nott, we will execute AND operation with its corresponding bit value with the bitmask.
So, 16 & 25 -> 10000 & 11001 === 16, whereas, if you see the 1's bit in OptionB is presented in the same position (5th place) in bitmask that returns the true and same bit value after AND operation. 

# Technology Adopts
I saw this bitmasking used in vBulletin (OOP PHP) on 2019 which is a populer PHP framework for trading forums. All the admin panel settings and permission management used for all option values using bitmasking and xml configurations. Later on, I used this technology to solve a healthcare related survey problems came across me with 144 questions (maximum quetions belonged 5 options) for a single participant.

# Some Limitations
Though Laravel has no specific functionalities for bitmasking, we have implemented survey with Laravel 12.
When you have more than 59 options and you checked all, it will overflow unsigned bigint in mysql and will return inappropriate values. In that case, you have to use Decimal with Scale 0. Previously, I have segregated 12 questions for each set which means setA contained 12 questions(5 options for each questions) and Other questions in setB,... and so on.
But this approach is not ideal if option changes randomly while production is going on. 

## Project Details

- **GitHub Repository**: [https://github.com/shohag-cse-knu/laravel-bitmask-survey-app.git](https://github.com/shohag-cse-knu/laravel-bitmask-survey-app.git)

## Features
- **List**: A list of survey participants
- **Add Survey**: Add a participant survey
- **Update Survey**: Update a participant survey
- **Delete Survey**: Soft delete a participant survey
- **Report**: A sample report extracting question information from the bitmask.

## Prerequisites

- **Laravel**: The minimum Laravel version required 12.
- **PHP**: PHP version 8.2 or higher.
- **MySQL**: Mysql 8
- **Composer**: Since Laravel is installed via Composer, make sure you have Composer installed on your system.

## Setup Instructions

### 1. Clone the Repository
```bash
git clone https://github.com/shohag-cse-knu/laravel-bitmask-survey-app.git
````
### 2. Copy .env.example to .env
```bash
cp .env.example .env
````
Modify Database name, DB user and password.

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
### 5. Seed and observe already saved survey
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
