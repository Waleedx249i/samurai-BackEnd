Samurai Taxi Backend API
This repository contains the backend API for the Samurai Taxi app. It is built using Laravel 10, MySQL, Twilio for SMS verification, Sanctum for API token authentication, and Pusher for broadcasting.

Prerequisites
PHP 7.4 or higher
Composer (https://getcomposer.org/)
MySQL or any other compatible database management system
Twilio account for SMS verification (https://www.twilio.com/)
Twilio PHP SDK (https://github.com/twilio/twilio-php)
Laravel Sanctum for API token authentication (https://laravel.com/docs/8.x/sanctum)
Pusher account for real-time broadcasting (https://pusher.com/)
Pusher PHP SDK (https://github.com/pusher/pusher-http-php)
Installation
Clone the repository:

bash
Copy
git clone https://github.com/your-repo-url.git
```

Navigate to the project directory:

bash
Copy
cd samurai-backend
```

Install dependencies:

bash
Copy
composer install
```

Create a .env file by copying the .env.example file and update the necessary configuration values:

bash
Copy
cp .env.example .env
```

Update the `DB_*` variables with your MySQL database credentials.

Generate an application key:

bash
Copy
php artisan key:generate
```

Run database migrations:

bash
Copy
php artisan migrate
```

Install and configure Laravel Sanctum:

Install Sanctum:

bash
Copy
composer require laravel/sanctum
Publish the Sanctum configuration:

bash
Copy
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
Generate a Sanctum API token encryption key:

bash
Copy
php artisan sanctum:install
Configure Twilio for SMS verification:

Sign up for a Twilio account if you don't have one already (https://www.twilio.com/).
Obtain your Twilio account SID and auth token.
Update the TWILIO_SID and TWILIO_AUTH_TOKEN variables in the .env file with your Twilio credentials.
Configure Pusher for broadcasting:

Sign up for a Pusher account if you don't have one already (https://pusher.com/).
Create a new Pusher app and obtain the app credentials.
Update the PUSHER_APP_ID, PUSHER_APP_KEY, and PUSHER_APP_SECRET variables in the .env file with your Pusher app credentials.
Start the development server:

bash
Copy
php artisan serve
Usage
The Samurai Taxi backend API provides endpoints for various functionalities of the app, including user registration, login, profile management, trip requests, starting and ending trips, and more.
The API also utilizes Pusher for real-time broadcasting of trip status updates. The broadcasting functionality is integrated into the relevant trip endpoints, allowing clients to receive real-time updates about trip statuses.

Please refer to the code documentation and API routes for a complete list of available endpoints and their usage.

Contributing
Contributions to the Samurai Taxi backend API are welcome! If you find any issues or have suggestions for improvements, please open an issue or submit a pull request.
