@echo off
set timestamp=%date:~-4,4%_%date:~-7,2%_%date:~-10,2%_%time:~0,2%_%time:~3,2%_%time:~6,2%
set dbUser="root"
set dbPass=" "
set dbName="resturant"
set dbHost="localhost"
set dbPort=3306
set backUpFile="%timestamp%_%dbName%.sql"
"C:\xampp\mysql\bin\mysqldump.exe"  -h %dbHost% -u %dbUser%  %dbName% > "C:\xampp\htdocs\Resturant\%dbName%.sql"