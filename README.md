# HTTP Status Checker

## About

This repository is for checking the status of urls. It will give you the status, and the redirect path.

## Prerequisites

- PHP
- MySQL
- Apache/NGINX
- [Composer](https://getcomposer.org/)

*Hint: It's easiest to use [Laravel Valet](https://laravel.com/docs/5.7/valet)

## Setup
1. Clone this repository
1. Run `cp .env.example .env`
1. Update your .env file with the correct database values
1. Run `composer install`
1. Run `php artisan key:generate`

## How to use

1. Paste in urls to check, one line at a time