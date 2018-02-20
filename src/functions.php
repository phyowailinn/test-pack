<?php 

if (! function_exists('unifi_login')) {
	function unifi_login()
	{
		$app = app()->make(\Phyo\TestPack\Unifi::class);
		return $app->login();
	}
}