# Pendar Test

The **News System** is a web application built using the Laravel framework that allows users to read, create, and interact with articles and comments. It provides a platform for publishing news articles and engaging with other users through comments, likes, and dislikes.

## Features

1. **Article Management**: Users can create, read, update, and delete articles.
2. **Comment System**: Users can leave comments on articles.
3. **Like and Dislike**: Users can like or dislike comments.
4. **RESTful API**: The application provides a RESTful API for interacting with articles and comments.
5. **Search and Pagination**: Users can search for articles and comments, and pagination is implemented for better user experience.
6. **Notification System**: Administrators receive notifications via email or other channels when a new article is published.

## Installation and Setup

To install and set up the News System on your local machine, follow these steps:

1. Clone the repository to your local machine:

   ```bash
   git clone https://github.com/kiani-coder/pendar-test

2. Install dependencies using Composer:

    ```bash
    composer install

3. Copy the .env.example file to .env and configure your environment variables, including database settings and mail configuration:

    ```bash
    cp .env.example .env

4. Generate an application key:
    ```bash
    php artisan key:generate

5. Run database migrations and seeders to create and populate the database:

    ```bash
    php artisan migrate --seed

6. Serve the application:

    ```bash
    php artisan serve


## Usage

To use the News System, follow these steps:

- **Article Management**: Logged-in users can create, view, edit, and delete articles.
- **Commenting**: Users can leave comments on articles.
- **Interaction**: Users can like or dislike comments.
- **Search and Pagination**: Users can search for articles and comments, with pagination implemented for large datasets.
- **Notification**: Administrators receive notifications via email or other channels when a new article is published.

## Testing

To run the tests, use the following command:

```bash
php artisan test
