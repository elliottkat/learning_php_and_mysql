# learning_php_and_mysql
Learning PHP and MySQL

This is a very simple PHP project that allows a user to add, update, delete, and list movies in a MySQL database.

It runs on a LAMP stack, so Linux, Apache, MySQL, and PHP are expected to be installed already. The project also expects `movieuser` to exist in MySQL.  You will also need to modify the `movieuser` password in each PHP script.

One resource is [Installing an Ubuntu 20.02 LAMP stack](https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-20-04).

To create the database and table, run

`mysql -u movieuser -p mydatabase < create_movie_table.sql`

### Helpful MySQL Commands

`DESCRIBE <tablename>`;

`DROP TABLE <tablename>`;

`DROP DATABASE <database>`;
