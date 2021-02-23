# README

## Installation

Git clone to `plugins.local/nginx_xaccel`

## Configuration

Setup redirect prefix for nginx (should lead to tt-rss base directory) via `.env`:

```
TTRSS_NGINX_XACCEL_PREFIX=/tt-rss
```

```
	location /tt-rss/cache {
		aio threads;
		internal;
	}
```

More info here: https://www.nginx.com/resources/wiki/start/topics/examples/xsendfile/
