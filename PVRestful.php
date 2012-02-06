<?php

class PVRestful implements PVResponseInterface, PVRequestInterace {
	
	protected $_requestObject;
	
	protected $_responseObject;
	
	protected $_authObject;
	
	public function __construct($requestObject = null, $responseObject = null, $authObject = null) {
		
		$this -> _responseObject = $responseObject;
		$this -> _requestObject = $requestObject;
		$this -> _authObject = $authObject;
	}
	
	public function setRequestObject($object) {
		$this -> _requestObject = $object;
	}
	
	public function setResponseObject($object) {
		$this -> _responseObject = $object;
	}
	
	public function setAuthObject($object) {
		$this -> _authObject = $object;
	}
	
	//Response object required methods
	
	public function createResponse($status, $body, $options) {
		return $this -> _responseObject -> createResponse($status , $body, $options);
	}
	
	public function setStatusMessages($messages,$options = array()) {
		return $this -> _responseObject -> setStatusMessages($messages, $options);
	}
	
	public function getStatusMessage($status) {
		return $this -> _responseObject -> getStatusMessage($status);
	}
	
	//Request object required methods
	
	public function processRequest() {
		return $this -> _requestObject -> processRequest();
	}
	
	public function setRequestData( $data ) {
		return $this -> _requestObject -> setRequestData($data);
	}
	
	public function getRequestData($format = '') {
		return $this -> _requestObject -> getRequestData($format);
	}
	
	public function getRequestMethod() {
		return $this -> _requestObject -> getRequestMethod();
	}
	
	public function setRequestMethod($method) {
		return $this -> _requestObject -> setRequestMethod($method);
	}
}
