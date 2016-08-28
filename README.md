## GreenRobot Open-source Adserver
This adserver rotates banner ads between Adsense, LifeStreetmedia and others based on RPM. For Adsense and Lifestreetmedia, the RPM is automatically retrieved by the server using network APIs, for other networks you will have to edit the RPM yourself.

This adserver is for desktop sites and mobile web, not native mobile apps.  Specifically, I use it on a Facebook app, which is also accessible outside of the Facebook frame once you're logged in via Facebook connect.  It should also work fine on desktop or mobile web sites not using Facebook login.  I also do mobile development, so maybe I will get around to building a native apps adserver in the future.

![Screenshot 1](https://github.com/greenrobotllc/adserver/blob/master/sampleimages/image1.png)
![Screenshot 2](https://github.com/greenrobotllc/adserver/blob/master/sampleimages/image2.png)
![Screenshot 3](https://github.com/greenrobotllc/adserver/blob/master/sampleimages/image3.png)
![Screenshot 4](https://github.com/greenrobotllc/adserver/blob/master/sampleimages/image4.png)
![Screenshot 5](https://github.com/greenrobotllc/adserver/blob/master/sampleimages/image5.png)



## Steps to install:

1. Git clone the adserver code from Github
2. Edit database/seeds/UserTableSeeder.php with your preferred email and password.
3. Install PHP Composer
4. php composer.phar install
5. Install Laravel
6. Create database
7. Run php artisan migrate
8. Run php artisan db:seed
9. You should setup a new subdomain for this adserver, and point it to the public folder
10. Login with your email and password and setup your Google Client secrets, Google Account Info and LifeStreetMedia account info.
11. VERY IMPORTANT: Remember to set debug to false in config/app.php in a production install. Otherwise your database password may be exposed if a connection error occurs.
12. I was getting the error: "zend_mm_heap corrupted" in my php error log and the page was blank. I solved this by editing my php.ini to include "opcache.enable_cli = 0". (https://github.com/laravel/framework/issues/6721)
13. Even with that setting, I was still getting that error. I then ran the command: "export USE_ZEND_ALLOC=0" (http://stackoverflow.com/a/10092026/211457)
12. Email me if you have any questions: andy@greenrobot.com


## Open Issue:
Even with the above php.ini settings I was still getting that error in my php error log after running the server for a few days: "zend_mm_heap corrupted". Also no ads or pages would load on the ad server. I used another answer from that Stackoverflow thread referenced above: http://stackoverflow.com/a/5764877/211457

In php.ini make these changes

report_memleaks = Off  
report_zend_debug = 0  

Restart server.

The problem seems to have gone away.

Unfortunately, I don't think this is ideal, so I am still looking for a better solution, and I do expect the problem to come back eventually.
