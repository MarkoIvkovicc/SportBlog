# Sport Blog

[![Build Status](https://img.shields.io/static/v1?label=Sport&message=Blog&color=success&style=for-the-badge)](https://github.com/MarkoIvkovicc/SportBlog)

<This will be description> 

##### Installation steps

  conifg.example.php rename to config.php and setup your variable for connection

  ```sh
    composer install
  ```
  To see if doctrine work properly try command
  ```sh
    vendor/bin/doctrine
  ```
or
  ```sh
    php vendor/doctrine/orm/bin/doctrine.php
  ```
   
>If doctrine command listed now you must generate entities and fill database with tables made from this entities by folowing steps
  - First create database schema without any table
  - Run next `DOCTRINE` commands
    ```sh
    orm:generate-entities src
    orm:schema-tool:create
    ```