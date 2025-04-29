@echo off

:: Start the PHP server for the public directory
cd /d "%~dp0public"
start /min "" cmd /c "php -S localhost:8081"

:: Immediately open the default browser at localhost:8081
start "" http://localhost:8081

:: Start the PHP server for the ~dev directory
cd /d "%~dp0~dev"
start /min "" cmd /c "php -S localhost:8082"

:: Immediately open the default browser at localhost:8082
start "" http://localhost:8082
