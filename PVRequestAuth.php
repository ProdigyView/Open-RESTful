<?php

class PVRequestAuth {
	
	protected $_username;
	
	protected $_password;
	
	protected $_http_auth_digest;
	
	protected $_realm;
	
	protected $_digest;
	
	public function __construct(array $options = array()) {
		
		$defaults = array(
			'username' => '',
			'password' => '',
			'http_auth_digest' => 'PHP_AUTH_USER'
		);
		
		$options += $defaults;
		
		$this -> _http_auth_digest = $options['http_auth_digest'];
		
	}
	
	public function processAuth() {
		
		$this -> _digest = $this -> _parseDigest($_SERVER[$this -> _http_auth_digest]);
		
		$this -> _username = $_SERVER['PHP_AUTH_USER'];
		
		$this -> _password = $_SERVER['PHP_AUTH_PW'];
		
	}
	
	public function authenticate($credentials = array()) {
		
	}
	
	public function getCredentials() {
		return array('username' => $this -> _username, 'password' => $this -> _password);
	}
	
	public function setCredentials($credentials = array()) {
		
		$this -> _username = $credentials['username'];
		
		$this -> _password = $credentials['password'];
	}
	
	protected function _parseDigest($digest) {
			
		preg_match_all('@(username|nonce|uri|nc|cnonce|qop|response)'. '=[\'"]?([^\'",]+)@', $digest, $t);
	    $data = array_combine($t[1], $t[2]);
	                     # all parts found?
	    return (count($data)==7) ? $data : false; 
	}
}
