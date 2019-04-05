# Warehouse Management
Warehouse management based on Laravel 5.4 upgraded from Laravel 5.0, is used to manage inventory within warehouse.

## System Requirement
- PHP >= 7.0
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- MySql


## Prerequisite
Composer :Install Composer by following the [official instructions](https://getcomposer.org/download/).

## Installation
1. Clone the repo on to a server 
2. Run "composer install" 
3. Copy ".env.example" and rename to ".env"
4. Update database credentials 
5. run "php artisan key:generate"
6. run "php artisan migrate -seed"
7. Ensure the entry point for the server is "public" folder
8. Load the application using the ip address or url


## Login Credentials
### Admin
- username: admin@example.com
- password: admin123

### User
- username: user@example.com
- password: user123
