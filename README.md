APC Monitor is a single page to get information of APC(u) and OPCache, and can
clear the cache on this page.

![apc monitor screenshot](http://chrisyue-blog.qiniudn.com/apc-monitor.jpg)

Installation
============

It is a very simple one file php script, you can put it in any web root.

Assuming you put `apc.php` in `/path/to/webroot` and have NGINX and PHP-FPM
with APC(u) installed. Add a new site configuration as follow:

```
server {
    server_name {your_site};

    ...

    location = /apc.php {
        root /path/to/webroot;
        include fastcgi.conf;
        fastcgi_pass 127.0.0.1:9000;

        access_log off; # optional
        allow {your_ip}; # optional but highly recommended
        deny all; # optional but highly recommended 
    }
}
```
