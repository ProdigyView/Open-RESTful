<?php

class PVRequestAuth {
	
	protected $_username;
	
	protected $_password;
	
	protected $_realm;
	
	protected $_digest;
	
	protected $_server_auth_digest;
	
	protected $_server_auth_user;
	
	protected $_server_auth_password;
	
	public function __construct(array $options = array()) {
		
		$defaults = array(
			'username' => '',
			'password' => '',
			'http_auth_digest' => 'PHP_AUTH_DIGEST',
			'server_auth_user' => 'PHP_AUTH_USER',
			'server_auth_password' => 'PHP_AUTH_PW',
			'realm' => uniqid(),
			'process_auth' => true
		);
		
		$options += $defaults;
		
		$this -> _username = $options['username'];
		$this -> _password = $options['password'];
		
		$this -> _server_auth_digest = $options['http_auth_digest'];
		$this -> _server_auth_user = $options['http_auth_user'];
		$this -> _server_auth_password = $options['http_auth_password'];
		$this -> _realm = $options['realm'];
		
		if($options['process_auth'])
			$this -> processAuth();
		
	}
	
	public function processAuth() {
		
		$this -> _digest = $this -> _parseDigest($_SERVER[$this -> _server_auth_digest]);
		
		$this -> _username = $_SERVER[$this -> _server_auth_user];
		
		$this -> _password = $_SERVER[$this -> _server_auth_password];
		
	}
	
	public function authenticate($credentials = array()) {
			
		if($this -> _username == $credentials['username'] && $this -> _password == $credentials['password'] && $this -> _digest)
			return true;
		
		return false;
	}
	
	public function getCredentials() {
		return array('username' => $this -> _username, 'password' => $this -> _password);
	}
	
	public function setCredentials($credentials = array()) {
		
		$this -> _username = $credentials['username'];
		
		$this -> _password = $credentials['password'];
	}
	
	public function setRealm($realm) {
		$this -> _realm = $realm;
	}
	
	public function getRealm() {
		return $this -> _realm;
	}
	
	protected function _parseDigest($digest) {
			
		preg_match_all('@(username|nonce|uri|nc|cnonce|qop|response)'. '=[\'"]?([^\'",]+)@', $digest, $t);
	    $data = array_combine($t[1], $t[2]);
	                     # all parts found?
	    return (count($data)==7) ? $data : false; 
	}
}
