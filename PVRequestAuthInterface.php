<?php

interface PVRequestAuthInterface {
	
	public function processAuth();
	
	public function authenticate();
	
	public function getCredentials();
	
	public function setCredentials($credentials);
	
	public function setRealm($realm);
	
	public function getRealm();
}
