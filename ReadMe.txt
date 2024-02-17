Telegram Bot Task

Brief description of your project.

Setup Instructions:

1. Clone the Repository:
   git clone <repository-url>
   cd <project-directory>

2. Set Up Configuration:
   - Copy env.example.php to env.php.
   - Fill in the required values in env.php:
     - APP_URI: URI of the application.
     - TELEGRAM_TOKEN: Telegram Bot token.
     - DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD: Database connection details.
     - PUSHER_APP_ID, PUSHER_KEY, PUSHER_SECRET, PUSHER_CLUSTER: Pusher keys.

3. Import Database Schema:
   - Run the SQL scripts to create the required database tables:
     mysql -u <username> -p <database-name> < meessages.sql
     mysql -u <username> -p <database-name> < answer_questions.sql

4. Install Dependencies:
   - Install project dependencies using Composer:
     composer install

5. Run the Application:
   - Start the PHP built-in web server:
     php -S localhost:8000

   - Access the application in your web browser at http://localhost:8000.

