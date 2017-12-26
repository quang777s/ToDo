# Todo App

Docker running Nginx, PHP-FPM, MySQL, CodeIgniter and PHPMyAdmin.  
There are 2 microservices (User Service, Todo Service) and a markup  

## Web

Homepage: http://localhost:8000  
Sign Up: http://localhost:8000/register  
Sign In: http://localhost:8000/login  
Todo: http://localhost:8000/todo  

## User Service

Register: http://localhost:8001/api/user/register (POST)  
Login: http://localhost:8001/api/user/login (POST)  

## Todo Service

List Todo: http://localhost:8002/api/todo/list (POST)  
Add: http://localhost:8002/api/todo/add (POST)  
Mark Resolve: http://localhost:8002/api/todo/complete (POST)  
UnMark: http://localhost:8002/api/todo/unmark (POST)  
Delete: http://localhost:8002/api/todo/delete (POST)  

Please ask me if you can not install successfully. Thanks!
quang777s@gmail.com 