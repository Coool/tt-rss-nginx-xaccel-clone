<?php
class Nginx_Xaccel extends Plugin {
	private $host;

	function about() {
		return array(1.0,
			"Sends static files via nginx X-Accel-Redirect header",
			"fox",
			true);
	}

	function init($host) {
		$this->host = $host;

		$host->add_hook($host::HOOK_SEND_LOCAL_FILE, $this);
	}

	function hook_send_local_file($filename) {

		if (defined('NGINX_XACCEL_PREFIX') && NGINX_XACCEL_PREFIX &&
				mb_strpos($filename, "cache/") === 0) {

			$mimetype = mime_content_type($filename);

			// this is hardly ideal but 1) only media is cached in images/ and 2) seemingly only mp4
			// video files are detected as octet-stream by mime_content_type()

			if ($mimetype == "application/octet-stream")
				$mimetype = "video/mp4";

			header("Content-type: $mimetype");

			$stamp = gmdate("D, d M Y H:i:s", filemtime($filename)) . " GMT";
			header("Last-Modified: $stamp", true);

			header("X-Accel-Redirect: " . NGINX_XACCEL_PREFIX . "/" . $filename);

			return true;
		}
	}

	function api_version() {
		return 2;
	}

}
?>
