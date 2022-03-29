<?php
/**
 * Plugin run file.
 *
 * PHP version 5
 *
 * @category Run
 * @package  FOGProject
 * @author   Tom Elliott <tommygunsster@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0 GPLv3
 * @link     https://fogproject.org
 */
/**
 * Plugin run file.
 *
 * @category Run
 * @package  FOGProject
 * @author   Tom Elliott <tommygunsster@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0 GPLv3
 * @link     https://fogproject.org
 */
require '../commons/base.inc.php';
$FOGCore = $GLOBALS['FOGCore'];


if (isset($_GET['plugin'])) {
    $pluginname = $_GET['plugin'];
	$hash = md5($_GET['plugin']);
	$Plugin = $FOGCore::getClass('Plugin')
		->set('name', $pluginname)
		->load('name');

	if ($Plugin->isInstalled()) {
		echo "[" .$pluginname ."] already Installed" ."\n";
	}else{
		$FOGCore::getClass('Plugin')->activatePlugin($hash);

		if (!$Plugin->getManager()->install($pluginname)) {
			$msg = sprintf(
				'%s %s',
				_('Failed to install plugin'),
				"[" .$pluginname ."]"
			);
			echo $msg ."\n";
			throw new Exception($msg);
		}
		$Plugin
			->set('state', 1)
			->set('installed', 1)
			->set('version', 1);
		if (!$Plugin->save()) {
			$msg = sprintf(
				'%s %s',
				_('Failed to save plugin'),
				"[" .$pluginname ."]"
			);
			echo $msg ."\n";
			throw new Exception($msg);
		}else{
			echo "[" .$pluginname ."]Done";
		}
	}
} else {
	$msg = sprintf(
		'%s %s',
		_('Plugin not found'),
		"[" .$pluginname ."]"
	);
	echo $msg + "\n";
	throw new Exception($msg);
}



