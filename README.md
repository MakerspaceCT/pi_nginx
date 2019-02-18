# Raspberry Pi: Setting up an Nginx Web server

These commands and code blocks will be used during MakerspaceCT's Raspberry Pi: Initial Web Server Setup class.

```
# apt-get install nginx mysql-server php-fpm php-mysql
# service php7.0-fpm start
# service php7.0-fpm status
# systemctl enable  php7.0-fpm
# apt-get install libfcgi0ldbl
# cgi-fcgi -bind -connect /run/php/php7.0-fpm.sock

server {
        listen 80 default_server;
        listen [::]:80 default_server;
        root /var/www/html;
        index index.php index.html index.htm index.nginx-debian.html;

        server_name _;
        location / {
                try_files $uri $uri/ =404;
        }

        location ~ \.php$ {
                include snippets/fastcgi-php.conf;
                fastcgi_pass unix:/var/run/php/php7.0-fpm.sock;
        }
}

# echo "<?php phpinfo(); ?>" > /var/www/html/index.php

# service nginx start

# systemctl enable nginx

# service mysql start
# systemctl enable mysql

<?php
$dbh = mysqli_connect('localhost', 'admin', 'pass');
if (!$dbh) {
    die('Could not connect: ' . mysqli_error());
}
echo 'Connected successfully to MySQL';
mysqli_close($dbh);
?>

# mysql -u root -e "CREATE USER 'admin'@'localhost' IDENTIFIED BY 'pass';"
# mysql -u root -e "GRANT ALL PRIVILEGES ON *.* TO 'admin'@'localhost' WITH GRANT OPTION;"

# curl -i http://localhost/db.php
Connected successfully to MySQL database
```

## Installing WordPress

"WordPress (WordPress.org) is a free and open-source content management system (CMS) based on PHP & MySQL. Features include a plugin architecture and a template system. It is most associated with blogging but supports other types of web content including more traditional mailing lists and forums, media galleries, and online stores. Used by more than 60 million websites, including 30.6% of the top 10 million websites as of April 2018, WordPress is the most popular website management system in use." (From [Wikipedia](https://en.wikipedia.org/wiki/WordPress))

 * WordPress's [Famous 5-Minute Installation](https://codex.wordpress.org/Installing_WordPress#Famous_5-Minute_Installation)

## Where to Go Next
Want to Learn More? Here are some more in-depth walkthroughs.

**Note:** These tutorials are written specifically for the Ubuntu 18.04 LTS operating system. If you're working a Raspberry Pi, you'll probably be using a Raspbian Stretch operating system, as we do in class. Both Raspbian Stretch and Ubuntu 18.04 Debian-based distributions and commands should work similarly on each. If you have any issues, Google is your friend.

* [Initial Server Setup with Ubuntu 18.04](https://www.digitalocean.com/community/tutorials/initial-server-setup-with-ubuntu-18-04)
* [How to Install Nginx on Ubuntu 18.04](https://www.digitalocean.com/community/tutorials/how-to-install-nginx-on-ubuntu-18-04)
* [How To Install WordPress with LEMP on Ubuntu 18.04](https://www.digitalocean.com/community/tutorials/how-to-install-wordpress-with-lemp-on-ubuntu-18-04)
