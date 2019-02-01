# adminer-forced-server
Plugin for Adminer, restricted login to config-defined server

Based on official (but not working at this time)  [login-servers](https://raw.github.com/vrana/adminer/master/plugins/login-servers.php) for [Adminer](https://www.adminer.org/) with enhancements.<br />
And inspired by CrazyMax's [login-servers-enhanced]( https://github.com/crazy-max/login-servers-enhanced/)

## Features

* This plugin restricts user to connect only to ONE predefined server.
* User cannot choose anything. Only fill username and password. (other fields are not displayed nor send over network)
* User cannot (ab)use your server with your Adminer to connect somewhere else.

## Installation

Copy `plugins/forced-server.php` in the plugins folder.

## Getting started

Follow the instructions on the [official plugins page](https://www.adminer.org/en/plugins/).<br />
Then just add `new AdminerForcedServer` to the `$plugins` array :

```php
<?php
if (! isset($_SERVER['HTTPS'])) {
	header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
}

function adminer_object() {
	// required to run any plugin
	include_once "./plugins/plugin.php";

	// autoloader
	foreach (glob("plugins/*.php") as $filename) {
		include_once "./$filename";
	}

	$plugins = array(
		// specify enabled plugins here
		new AdminerForcedServer(array('driver' => 'server', 'server' => 'localhost')),
	);

	return new AdminerPlugin($plugins);
}

// include original Adminer or Adminer Editor
include "./adminer.php";
?>
```

You must set array with keys 'driver' and 'server'.<br />
Value for the driver is usually 'server'.<br />
Value for server can be localhost, IP address or hostname of target server.<br />


## License

Apache-2.0. See `LICENSE` for more details.
