## GreenRobot Adserver

![Screenshot 1](https://github.com/greenrobotllc/adserver/blob/master/sampleimages/image1.png)
![Screenshot 2](https://github.com/greenrobotllc/adserver/blob/master/sampleimages/image2.png)
![Screenshot 3](https://github.com/greenrobotllc/adserver/blob/master/sampleimages/image3.png)
![Screenshot 4](https://github.com/greenrobotllc/adserver/blob/master/sampleimages/image4.png)
![Screenshot 5](https://github.com/greenrobotllc/adserver/blob/master/sampleimages/image5.png)



Steps to install:
1. Git clone the adserver code from Github
2. Edit database/seeds/UserTableSeeder.php with your preferred email and password.
3. Install PHP Composer
4. php composer.php install
5. Install Laravel
6. Create database
7. Run php artisan migrate
8. Run php artisan db:seed
9. You should setup a new subdomain for this adserver, and point it to the public folder
10. Login with your email and password and setup your Google Client secrets, Google Account Info and LifeStreetMedia account info.
11. Email me if you have any questions: andy@greenrobot.com
