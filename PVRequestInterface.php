<?php

interface PVRequestInterace {
	
	public function processRequest();
	
	public function setRequestData($data);
	
	public function getRequestData($format = '');
	
	public function getRequestMethod();
	
	public function setRequestMethod($method);
}
