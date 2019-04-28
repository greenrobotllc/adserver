
You must use PHP 7.1 or greater. Make a new folder to put the code:
```
mkdir adserver
```

Git clone the adserver code from Github: https://github.com/greenrobotllc/adserver:
```
cd adserver; git clone https://github.com/greenrobotllc/adserver .
```

Change your username and password from the default:
Edit database/seeds/UsersTableSeeder.php with your email and password. I would like if someone were to make this part easier.

In the project folder, move .env.example to .env and fill in your database credentials:
```
cp .env.example .env
```

Create the adserver database. I used Sequel Pro on Mac OS X.

Run php composer to install the components:
```
php composer.phar install --no-scripts
mkdir bootstrap/cache
php composer.phar install

```

Migrate the database. Run:
```
php artisan migrate
php artisan db:seed
```

Reset the cached config files:
```
php artisan key:generate
php artisan config:cache
php artisan config:clear
```
Laradock deployment:

If you want to deploy the adserver with laradock, run the following to install the git submodule:

```
git submodule update --init --recursive
```

Enter the laradock folder and rename env-example to .env.
```
cd laradock; cp env-example .env
```
Change your database credentials in the laradock .env to match that of the adserver .env file.

Run your containers:
```
docker-compose down
docker-compose up -d nginx mysql
```
Open up http://localhost in your web browser

--More instructions available at https://laradock.io/

Setup something like the following in cron (your path to artisan may vary):
```
* * * * * php /var/www/html/adserver/artisan schedule:run >> /dev/null 2>&1
```
Login with your email and password and setup your Google Client secrets, Google Account Info and LifeStreetMedia account info.

