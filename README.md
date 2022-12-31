# Junior Software Engineer Backend Coding challenge

Welcome to your Laravel project! This project is designed to manage products and categories through both a command line interface (CLI) and a web interface.

## Prerequisites

Before you get started, make sure you have the following software installed on your machine:

- php  >= 7.3
- MySQL >= 5.7
- Composer

## Installation

1. Clone this repository to your local machine:
```console
git clone https://github.com/youssefhoussaf/YOUCAN_CODING_CHALLENGE.git
```
2. Navigate to the project directory:
```console
cd YOUCAN_CODING_CHALLENGE
```
3. Install the required dependencies:
```console
composer install
```
4. Create a copy of the .env.example file and rename it to .env. Update the .env file with your database and other configuration details.
5. Generate an application key:
```console
php artisan key:generate
```
6. Run the database migrations:
```console
php artisan migrate
```
7. Create the symbolic link
```console
php artisan storage:link
```

## usage

#### Web Interface
To use the web interface, start the development server:

```console
php artisan serve
```

You can then access the web interface at http://localhost:8000.

#### Command Line Interface (CLI)

1. To create a new Category , run the following command (parent_category is not required):

```console
php artisan create:category --name=category1 --parent_category=1
```

2. to delete a category , run the following command:

```console
php artisan delete:category --id=1
```

3. To create a new product , run the following command:

```console
php artisan create:product --name=product1 --description=product --price=1000 --category_id=1
```

4. to delete a product , run the following command:

```console
php artisan delete:product --id=1
```

## Other Technologies used

- VUEJS
- BOOTSTRAP
- AXIOS
- FONTAWESOME
- MOMENT.JS
- SWEETALERT

## Testing

To use tests, run the following command:
```console
php artisan test
```