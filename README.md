# README

## Installation

Git clone to tt-rss/plugins.local/nginx_xaccel

## Configuration

Setup redirect prefix for nginx (should lead to tt-rss base directory) 
via NGINX_XACCEL_PREFIX in ```config.php```:

```
 	define('NGINX_XACCEL_PREFIX', '/tt-rss');
```

```
	location /tt-rss/cache {
		aio threads;
		internal;
	}
```
