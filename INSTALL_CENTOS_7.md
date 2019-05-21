This is for Centos 7. PHP 7.3. MySQL 8.

Install docker
https://docs.docker.com/install/linux/docker-ce/centos/

```
yum install -y yum-utils \
  device-mapper-persistent-data \
  lvm2

sudo yum-config-manager \
    --add-repo \
    https://download.docker.com/linux/centos/docker-ce.repo

yum install docker-ce docker-ce-cli containerd.io

systemctl start docker
docker run hello-world

```

Install php 7
https://www.tecmint.com/install-php-7-in-centos-7/

```
yum install https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
yum install http://rpms.remirepo.net/enterprise/remi-release-7.rpm

yum-config-manager --enable remi-php73

yum install php php-mcrypt php-cli php-gd php-curl php-mysql php-ldap php-zip php-fileinfo php-mbstring php-dom unzip

yum install docker-compose
yum install git
```




Install adserver
1. Git clone the adserver code from Github: https://github.com/greenrobotllc/adserver:  
`cd home; mkdir adserver; cd adserver; git clone https://github.com/greenrobotllc/adserver .`

2. Change your username and password from the default:  
Edit `database/seeds/UsersTableSeeder.php` with your email and password. I would like if someone were to make this part easier.

3. In the project folder, move .env.example to .env and fill in your database credentials:  
`cp .env.example .env`  

4. Laradock setup. If you want to deploy the adserver with laradock, run the following to install the git submodule:  
`git submodule update --init --recursive`  

5. Enter the laradock folder and rename env-example to .env.  
`cd laradock; cp env-example .env`  

6. Change your database credentials in the laradock .env to match that of the adserver .env file.
--More instructions available at https://laradock.io/

7. Run your containers:  
`docker-compose down`  
`docker-compose up -d nginx mariadb`  

8. Create the adserver database and user.


Example of creating a user with access to a new database
```
CREATE DATABASE adserver
CREATE USER adserver_dbuser IDENTIFIED BY 'password';
GRANT ALL ON adserver.* TO adserver_dbuser@'%';
FLUSH PRIVILEGES
```

9. Run php composer to install the components:  
`php composer.phar install --no-scripts`  
`mkdir bootstrap/cache`  
`php composer.phar install`  

10. Migrate the database. Run:  
```
cd laradock
docker-compose exec workspace bash`
php artisan migrate
php artisan db:seed
```

11. Reset the cached config files:  
`php artisan key:generate`  
`php artisan config:cache`  
`php artisan config:clear`  



12. Setup something like the following in cron (your path to artisan may vary):  
`* * * * * php /var/www/html/adserver/artisan schedule:run >> /dev/null 2>&1`

13. Open up your host name in your web browser

14. If you see the error:
"The stream or file "/var/www/storage/logs/laravel.log" could not be opened: failed to open stream: Permission denied"
Do this:
```chmod -R 777 storage; cd storage; chmod -R 777 logs```

15. If you see an error with the bootstrap/cache folder not being writeable:
```chmod 777 bootstrap;  cd bootstrap; chmod 777 cache```
15. Login with your email and password and setup your Google Client secrets, Google Account Info and LifeStreetMedia account info.
