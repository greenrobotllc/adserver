## GreenRobot Open-source Adserver
This adserver rotates banner ads between AdSense/AdMob, LifeStreetmedia, and others based on RPM. For AdSense/AdMob and Lifestreetmedia, the RPM is automatically retrieved by the server using network APIs, for other networks you will have to edit the RPM yourself.

This adserver is for desktop sites and mobile web, as well as native mobile apps.  Specifically, I use it on a Facebook app, which is also accessible outside of the Facebook frame once you're logged in via Facebook connect.  It should also work fine on desktop or mobile web sites not using Facebook login.  For mobile apps, I have made some code available to work with the adserver. I am still working on this, including adding documentation.

For iOS: https://github.com/greenrobotllc/adserver-ios-sdk

For Android: https://github.com/greenrobotllc/adserver-android-sdk

![Screenshot 1](https://raw.githubusercontent.com/greenrobotllc/adserver/master/sampleimages/image1.png)
![Screenshot 2](https://raw.githubusercontent.com/greenrobotllc/adserver/master/sampleimages/image2.png)
![Screenshot 3](https://raw.githubusercontent.com/greenrobotllc/adserver/master/sampleimages/image3.png)
![Screenshot 4](https://raw.githubusercontent.com/greenrobotllc/adserver/master/sampleimages/image4.png)
![Screenshot 5](https://raw.githubusercontent.com/greenrobotllc/adserver/master/sampleimages/image5.png)


## Requirements:
I recommend using Linux or Mac OS X. I have not tried this under Windows. For production/linux, I have it deployed to a Centos server on Linode and it's running currently. For development I use Mac OS X with Laravel Homestead development environment.

## Steps to install:
0. You must use PHP 7.1 or greater.
Make a new folder to put the code:

`mkdir adserver`

1. Git clone the adserver code from Github: https://github.com/greenrobotllc/adserver:

`cd adserver; git clone https://github.com/greenrobotllc/adserver`.

2. Run php composer to install the components:

`php composer.phar install --no-scripts`

`mkdir bootstrap/cache`

`php composer.phar install`

Change your username and password from the default
3. Edit database/seeds/UsersTableSeeder.php with your preferred email and password.

4. In the project folder, move .env.example to .env and fill in your database credentials:
`cp .env.example .env`

-Create the adserver database. I used Sequel Pro on Mac OS X.

-Migrate the database. Run:

`php artisan migrate`
`php artisan db:seed`


-Reset the cached config files:
`php artisan key:generate`
`php artisan config:cache`
`php artisan config:clear`


Laradock deployment:
-If you want to deploy the adserver with laradock, run the following to install the git submodule:
Command:
`git submodule update --init --recursive`

Enter the laradock folder and rename env-example to .env.
`cd laradock; cp env-example .env`

Run your containers:
`docker-compose down`
`docker-compose up -d nginx mysql`

Open up http://localhost in your web browser


More instructions available at https://laradock.io/


-Setup something like the following in cron (your path to artisan may vary): 
`* * * * * php /var/www/html/adserver/artisan schedule:run >> /dev/null 2>&1`


Finally:
-Login with your email and password and setup your Google Client secrets, Google Account Info and LifeStreetMedia account info.


FAQ:
What is the route I am suppose to provide for the Adsense Oauth Callback when setting up the google_clients_secrets.json? The route would be the address of your webserver. You should setup a domain or subdomain for it to work. For example: https://yoursubdomain.greenrobot.com/refresh


## Developer Notes
Note for developers: I have set debug to false in config/app.php so this is ready to go for production installs. If you wish to debug, set this value to true. Setting it to true may cause your database password to be exposed if a connection error occurs.

## Contact / Security Bugs
You can use Github issues for regular bugs and feature requests. For security issues or if you have any questions you don't want to discuss publicly you can email me: andy@greenrobot.com

## Facebook Discussion Group
Join the discussion on Facebook about GreenRobot Adserver: https://www.facebook.com/groups/greenrobotadserver/

## Twitter Updates
Follow GreenRobot Adserver on Twitter: https://twitter.com/GRAdserver


## TODO
-Document iOS & Android sdk integration

-I would like to add Facebook Audience network to this adserver.

## Contributing

We take openness and inclusivity very seriously. To that end we have adopted the following code of conduct.

[Contributor Code of Conduct](CODE_OF_CONDUCT.md)
