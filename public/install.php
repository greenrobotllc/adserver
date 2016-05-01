<h1>Welcome to AdServer Installer</h1>
 <h3>Please Wait While we install your adserver here! This May take a while</h3>
 
<?php
ini_set('max_execution_time', 3000); //3000 seconds = 50 minutes
// echo "Starting Downloading Code<br>";

// // $output = shell_exec('"C:\Program Files\Git\bin\"git clone git@bitbucket.org:andytriboletti/adserver.git code 2>&1'); //FOR WINDOWS
// $output = shell_exec('git clone git@bitbucket.org:andytriboletti/adserver.git code 2>&1'); //FOR LINUX
// echo "Code is Downloaded <br>";


// echo "Make Code Ready <br>";
// // $output = shell_exec('xcopy /E /H code   2>&1'); //for windows
// $output = shell_exec('cp -R /code / 2>&1'); //for linux
// echo "Code is copied to main <br>";

echo "<hr>";
echo "Installing Code Modules<br>";
$path =  getcwd()."/../";
chdir($path); //change working directory
$output = shell_exec('php composer.phar update 2>&1');
echo "<br>=====================<br>";
echo $output;
echo "<br>=====================<br>";
echo "<br>Code Modules Installed<br>";
echo "<hr>";

echo "<br>Installing DB Migrations<br>";
$output = shell_exec('php artisan migrate 2>&1');
echo "<br>=====================<br>";
echo $output;
echo "<br>=====================<br>";
echo "<br>DB Migrated<br>";
echo "<hr>";


echo "<br>UPLOADING DB DATA<br>";
$output = shell_exec('php artisan db:seed 2>&1');
echo "<br>=====================<br>";
echo $output;
echo "<br>=====================<br>";
echo "<br>Data Uploaded<br>";
echo "<hr>";
echo "<br>============================ END =============================== <br>";
echo "All Done<br>";
echo "Credentials<br>";
echo "user: admin@example.com<br>";
echo "pass: admin<br>";