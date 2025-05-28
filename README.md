# adminer-forced-server
Plugin for Adminer (updated for version 5.0), restricted login to config-defined server

Based on official (but not working at this time)  [login-servers](https://raw.github.com/vrana/adminer/master/plugins/login-servers.php) for [Adminer](https://www.adminer.org/) with enhancements.<br />
And inspired by CrazyMax's [login-servers-enhanced]( https://github.com/crazy-max/login-servers-enhanced/)

## Features

* This plugin restricts user to connect only to ONE predefined server.
* User cannot choose anything. Only fill username and password. (other fields are not displayed nor send over network)
* User cannot (ab)use your server with your Adminer to connect somewhere else.

## Installation

Copy `adminer-plugins/forced-server.php` in the plugins folder.

## Getting started

Follow the instructions on the [official plugins page](https://www.adminer.org/en/plugins/).<br />
Then just add `new AdminerForcedServer` to the array in `adminer-plugins.php`:

```php
<?php
// adminer-plugins.php
return array(
	new AdminerForcedServer(array('driver' => 'server', 'server' => 'localhost')),
	// You can specify all plugins here or just the ones needing configuration.
);
?>
```

You must set array with keys 'driver' and 'server'.<br />
Value for the driver is usually 'server'.<br />
Value for server can be localhost, IP address or hostname of target server.<br />


## License

Apache-2.0. See `LICENSE` for more details.
