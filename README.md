## GreenRobot Open-source Adserver
This adserver rotates banner ads between AdSense/AdMob, LifeStreetmedia, MoPub, and others based on RPM. For AdSense/AdMob, Lifestreetmedia and MoPub, the RPM is automatically retrieved by the server using network APIs, for other networks you will have to edit the RPM yourself.

This adserver is for desktop sites and mobile web, as well as native mobile apps.  Specifically, I use it on a Facebook app, which is also accessible outside of the Facebook frame once you're logged in via Facebook connect.  It should also work fine on desktop or mobile web sites not using Facebook login.  I also do mobile development, I will be working on some open source code to interface with this adserver for native mobile apps. Right now the adserver returns some weightages of Admob/Adsense and MoPub and you will have to implement parsing the JSON and choosing between MoPub and AdMob in custom code for Android. For iOS, I've released some open source code: https://github.com/greenrobotllc/adserver-ios-sdk

![Screenshot 1](https://github.com/greenrobotllc/adserver/blob/master/sampleimages/image1.png)
![Screenshot 2](https://github.com/greenrobotllc/adserver/blob/master/sampleimages/image2.png)
![Screenshot 3](https://github.com/greenrobotllc/adserver/blob/master/sampleimages/image3.png)
![Screenshot 4](https://github.com/greenrobotllc/adserver/blob/master/sampleimages/image4.png)
![Screenshot 5](https://github.com/greenrobotllc/adserver/blob/master/sampleimages/image5.png)


## Requirements:
I recommend using Linux or Mac OS X. I have not tried this under Windows. For production/linux, I have it deployed to a Centos server on Linode and it's running currently. For development I use Mac OS X with Laravel Homestead development environment.

## Steps to install:
0. You must use PHP 7.x or greater. I tested with PHP 5.5, 5.6 and 7.1.1. With all versions but 7.1.1 I got a zend error.
1. Git clone the adserver code from Github
2. Edit database/seeds/UserTableSeeder.php with your preferred email and password.
3. Install PHP Composer
4. php composer.phar install
5. Install Laravel
6. Create database
7. Edit config/database.php with your database credentials.
8. Run php artisan migrate
9. Run php artisan db:seed
10. You should setup a new subdomain for this adserver, and point it to the public folder.
11. Login with your email and password and setup your Google Client secrets, Google Account Info and LifeStreetMedia account info.
12. What is the route I am suppose to provide for the Adsense Oauth Callback when setting up the google_clients_secrets.json? The route would be the address of your webserver. You should setup a domain or subdomain for it to work. For example: https://yoursubdomain.greenrobot.com/refresh
13. Setup something like the following in cron (your path to artisan may vary): * * * * * php /var/www/html/adserver/artisan schedule:run >> /dev/null 2>&1
14. If you are using less than PHP 7, after running the adserver for awhile, you may run into the problem with `zend_mm_heap corrupted` in your PHP log file, and no adserver pages load properly. This problem is currently unsolved. See below for more info.

## `zend_mm_heap corrupted` error
After awhile, I was getting the error: `zend_mm_heap corrupted` in my php error log and the page was blank. I tried a variety of things, I will go through them all here. I edited my `php.ini` to include:

`opcache.enable_cli = 0`

`report_memleaks = Off`

`report_zend_debug = 0`

(https://github.com/laravel/framework/issues/6721). 

Even then after awhile, with those settings, I was still getting that error. I then ran the command: `export USE_ZEND_ALLOC=0` (http://stackoverflow.com/a/10092026/211457)

Even then after awhile, I was still getting the eror. I hired getmyadmin.com to look into this and they added `output_buffering = 8192` to `php.ini` and that fixed the problem for me for awhile.

I then noticed the problem again. I updated to the latest version of PHP and Centos and Laravel. The problem was still there sporadically. I opened my first PHP bug about this issue: https://bugs.php.net/bug.php?id=73598. This was thanks to this very helpful Stackoverflow answer: http://stackoverflow.com/questions/2247977/what-does-zend-mm-heap-corrupted-mean/36350601#36350601

Update: 2/23/2017. I have updated to PHP 7.1.1 on a new server and have not experienced this error since upgrading. I think PHP 7 is required in order to run this adserver without the zend corruption.

## Developer Notes
Note for developers: I have set debug to false in config/app.php so this is ready to go for production installs. If you wish to debug, set this value to true. Setting it to true may cause your database password to be exposed if a connection error occurs.

## Contact / Security Bugs
You can use Github issues for regular bugs and feature requests. For security issues or if you have any questions you don't want to discuss publicly you can email me: andy@greenrobot.com

## Facebook Discussion Group
Join the discussion on Facebook about GreenRobot Adserver: https://www.facebook.com/groups/greenrobotadserver/

## Twitter Updates
Follow GreenRobot Adserver on Twitter: https://twitter.com/GRAdserver
