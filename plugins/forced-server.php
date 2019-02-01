<?php

/** Hide server and database fields in login form, connect to predefined server only
 *
 * Inspired by CrazyMax's https://github.com/crazy-max/login-servers-enhanced
 *
 * @link https://www.adminer.org/plugins/#use
 * @author Miroslav Lachman
 * @author CrazyMax, https://github.com/crazy-max
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */

/**
 * This plugin restricts users to connect only to ONE predefined server.
 * User cannot choose anything. Only fill username and password. 
 * User cannot (ab)use your server with your Adminer to connect somewhere else.
 * 
 * Use it as any other Adminer plugin.
 * You must set array with keys 'driver' and 'server'.
 * Value for the driver is usually 'server'
 * Value for server can be localhost, IP address or hostname of target server
 * 
 * 	$plugins = array(
 * 		// specify enabled plugins here
 * 		new AdminerForcedServer(array('driver' => 'server', 'server' => 'localhost')),
 * 	);
*/

class AdminerForcedServer {
	/** @access protected */
	var $forced;
	
	/** Set supported server
	* @param array('driver' => 'server', 'server' => 'localhost')
	*/
	function __construct($forced) {
		$this->forced = $forced;
		if ($_POST['auth']) {
			$_POST['auth']["driver"] = $this->forced['driver'];
		}
	}
	
	function credentials() {
		return array($this->forced['server'], $_GET['username'], get_password());
	}

	/** Print login form
	* @return null
	*/
    public function loginForm()
    {
        $html = '<table cellspacing="0">';
        $html .= $this->getTrUsername();
        $html .= $this->getTrPassword();
        $html .= '</table>';

        $html .= '<p><input type="submit" value="'.lang('Login').'">';
        //$html .= checkbox('auth[permanent]', 1, $_COOKIE['adminer_permanent'], lang('Permanent login'))."\n";

        echo $html;

        return true;
    }

    private function getTrUsername()
    {
        $html = '<tr><th>'.lang('Username').'<td>';
        $html .= '<input id="username" name="auth[username]" value="'.h($_GET['username']).'">';

        return $html;
    }

    private function getTrPassword()
    {
        $html = '<tr><th>'.lang('Password').'<td>';
        $html .= '<input type="password" name="auth[password]">';

        return $html;
    }
	
}

