Examples from "Phar, the PHP .exe format" talk I (Helgi) wrote.


To run any of the create scripts you will have to pass in -d phar.readonly=0 or change it in php.ini (not recommended) as Phar disables write access by default.

`php -d phar.readonly=0 example2/create.php`

### phpMyAdmin

Due to Phar not liking relative paths so the phpmyadmin example isn't working right now

### Apache
Example of how you can run Phar in apache

`AddType application/x-httpd-php .php .phar`

```
<VirtualHost *:80>
    ServerName   phar.dev
    DocumentRoot /path/to/phar-talk-examples/web/
    DirectoryIndex project.phar
</VirtualHost>
```