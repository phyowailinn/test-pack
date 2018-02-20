<?php 
namespace Phyo\Unifi;
/**
* 
*/
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Unifi
{

	function __construct(argument)
	{
		$this->client = new Client;
		$this->url = 'localhost';
		$this->route = 'logout';
		$this->site = 'default';
	}

	public function login() 
	{   
		try {
        	$response = $this->client->request(
        					'POST',$this->endPoint(),[
        					'json'=>[
        						'username'=>$this->user,
        						'password'=>$this->password
        					]
        				]);
        	return json_decode( $response->getBody()->getContents(),true );
        } catch (ClientException $e) {
        	return json_decode( $e->getResponse()->getBody()->getContents(),true );
        }    
  	}

  	public function authorizeGuest($mac,$minutes)
  	{	
  		try {
  			$authorize_array  = ['cmd' => 'authorize-guest', 'mac' => $mac, 'minutes' => $minutes];
		    if ( isset($up) ) $authorize_array['up'] = $up;
		    if ( isset($down) ) $authorize_array['down'] = $down;
		    if ( isset($MBytes) ) $authorize_array['bytes'] = $MBytes;
        	$response = $this->client->request(
        					'POST',$this->endPoint(),[
        					'json'=>json_encode($authorize_array)
        				]);
        	$result = json_decode( $response->getBody()->getContents(),true );
        	if ( isset($result->meta->rc) ) {
	            if ( $result->meta->rc == "ok" ) {
	                $return = true;
	            }
        	}
        	return $return;
        } catch (ClientException $e) {
        	return json_decode( $e->getResponse()->getBody()->getContents(),true );
        }  
  	}

  	public function logout()
  	{	
  		try {
        	$response = $this->client->post($this->endPoint());

        	return json_decode( $response->getBody()->getContents(),true );
        } catch (ClientException $e) {

        	return json_decode( $e->getResponse()->getBody()->getContents(),true );
        }   
  	}

  	protected function endPoint()
  	{	
  		$end_point = $this->url.$this->route.$this->site;
  		return rtrim($end_point,'/');
  	}
}