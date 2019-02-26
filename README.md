# Raspberry Pi: Setting up an Nginx Web server

These commands and code blocks will be used during MakerspaceCT's Raspberry Pi: Initial Web Server Setup class.

```
# apt-get install nginx mysql-server php-fpm php-mysql
# service php7.0-fpm start
# service php7.0-fpm status
# systemctl enable  php7.0-fpm
# apt-get install libfcgi0ldbl
# cgi-fcgi -bind -connect /run/php/php7.0-fpm.sock
```
Sample nginx configuration.
```
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
```

More commands.

```
# echo "<?php phpinfo(); ?>" > /var/www/html/index.php

# service nginx start

# systemctl enable nginx

# service mysql start
# systemctl enable mysql
```

Sample PHP code for testing MySQL.
```
<?php
$dbh = mysqli_connect('localhost', 'admin', 'pass');
if (!$dbh) {
    die('Could not connect: ' . mysqli_error());
}
echo 'Connected successfully to MySQL';
mysqli_close($dbh);
?>
```

More commands.
```
# mysql -u root -e "CREATE USER 'admin'@'localhost' IDENTIFIED BY 'pass';"
# mysql -u root -e "GRANT ALL PRIVILEGES ON *.* TO 'admin'@'localhost' WITH GRANT OPTION;"

# curl -i http://localhost/db.php
Connected successfully to MySQL database
```

## Blink an LED from a webpage.
This PHP code will use the `shell_exec` function to run `bash` commands to trigger the GPIO pins.

Looking for a native PHP library for GPIO interaction? [Check this out](https://github.com/WiringPi/WiringPi-PHP).

```
<?php
$output = shell_exec('gpio readall');
echo "<pre>$output</pre>";

shell_exec('gpio -g mode 17 out');
shell_exec('gpio -g write 17 1');
sleep(3);
shell_exec('gpio -g write 17 0');
?>

<button value="Refresh Page" onClick="window.location.reload()">Do it again!</button>
```

## Installing WordPress

"WordPress (WordPress.org) is a free and open-source content management system (CMS) based on PHP & MySQL. Features include a plugin architecture and a template system. It is most associated with blogging but supports other types of web content including more traditional mailing lists and forums, media galleries, and online stores. Used by more than 60 million websites, including 30.6% of the top 10 million websites as of April 2018, WordPress is the most popular website management system in use." (From [Wikipedia](https://en.wikipedia.org/wiki/WordPress))

 * WordPress's [Famous 5-Minute Installation](https://codex.wordpress.org/Installing_WordPress#Famous_5-Minute_Installation)

## Where to Go Next
Want to Learn More? Here are some more in-depth walkthroughs.

**Note:** DigitalOcean has a great selection of tutorials for many Linux setup and configuration tasks. However, *these tutorials are written specifically for the Ubuntu 18.04 LTS operating system.* **If you're working a Raspberry Pi, you'll probably be using a Raspbian Stretch operating system, as we do in class. Both Raspbian Stretch and Ubuntu 18.04 Debian-based distributions and commands should work similarly on each, but there may be slight differences.** If you have any issues, Google is your friend.

* [Initial Server Setup with Ubuntu 18.04](https://www.digitalocean.com/community/tutorials/initial-server-setup-with-ubuntu-18-04)
* [How to Install Nginx on Ubuntu 18.04](https://www.digitalocean.com/community/tutorials/how-to-install-nginx-on-ubuntu-18-04)
* [How To Install WordPress with LEMP on Ubuntu 18.04](https://www.digitalocean.com/community/tutorials/how-to-install-wordpress-with-lemp-on-ubuntu-18-04)

### Aren't we getting ahead of ourselves? Shouldn't you be telling us about domain names?
* If you'd like a great (accessible) read on all things domain names, check out Edward Loveall's book [Domain Name Sanity](https://gumroad.com/l/domain-name-sanity).

### I need to register a domain name!
* There are hundreds of domain registrars out there. [Namesilo](https://www.namesilo.com/) (no endorsement) is a popular, low-cost choice, though each registrar offers slightly different services in terms of features and support.
* If you're looking for a free, temporary use domain, [Freenom](https://freenom.com) offers .tk, .ga, .gq domains free of charge, with some restrictions. **These are probably not a good idea for a project you care about, but are definitely a cheap (free) option for working on a test project.
* **DNS**: Your domain registrar probably provides DNS-hosting services, but if they don't meet your needs, [Hurricane Electric](https://dns.he.net) and [Nova53](https://dns.nova53.net) both offer free DNS services that may meet your needs.

### Looking for other uses for your web server?
Check out [awesome-selfhosted](https://github.com/Kickball/awesome-selfhosted) on Github or [/r/SelfHosted](https://reddit.com/r/selfhosted) on Reddit. Not all of these applications use a web server, but there are quite a few that do. A few different examples:
* [MediaWiki](https://www.mediawiki.org/wiki/MediaWiki) - the CMS that powers wikipedia
* [NextCloud](https://nextcloud.com) - a self-hosted alternative to Dropbox.
* [PrivateBin](https://privatebin.info/) - a selfhosted "pastebin" for sharing plain text.
* [osTicket](http://osticket.com/) - Web application for managing support requests.
* [YOURLS](http://yourls.org/) - Your Own URL Shortener
