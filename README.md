# task and budget manager
<!--installation procedure-->

# installation Guide
## Prerequisites
1. PHP >= 8.0
2. Composer
3. Node.js and npm
4. XAMPP or any other local server environment
# Step 1: Clone the Repository

``` 
git clone (https://github.com/SusmitaBiswasAdor/task-and-budget.git)
cd your-repository-name
```

# Step 2: Install PHP Dependencies
```
composer install
```

# Step 3: Install Node.js Dependencies
```
npm install
```
# Step 4: Set Up Environment File

Copy the example environment file and generate an application key:

# Step 5: Configure Database
```
```
Open the .env file and update the database configuration to match your local environment:
```

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_manager
DB_USERNAME=root
```


# Step 6: Run Migrations
Run the database migrations:
```

php artisan migrate
```

# Step 7: Compile Assets
Compile the assets using Vite:
```

npm run dev
```

For production builds, use:
```

npm run build
```




# Step 8: Clear Cache
Clear your application cache to ensure the changes take effect:
```

php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```


# Step 11: Start the Development Server
Start your Laravel development server:
```
php artisan serve
```


# Step 10: Access Your Application
Now, you should be able to access your Laravel application by navigating to http://your-project.local or http://localhost:8000 in your web browser.

Troubleshooting
If you encounter any issues, ensure that:

All dependencies are installed correctly.
The .env file is configured properly.
The database is set up and migrations have been run.
The virtual host configuration is correct and Apache has been restarted.
The hosts file entry is correct and saved properly.
By following these steps, you should be able to install and run the Laravel project on your computer. If you still encounter issues, please provide more details about the error messages or behavior you are experiencing.
