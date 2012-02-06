<?php

class PVRestful implements PVResponseInterface, PVRequestInterace {
	
	protected $_requestObject;
	
	protected $_responseObject;
	
	public function __construct($requestObject = null, $responseObject = null) {
		
		$this -> _responseObject = $responseObject;
		$this -> _requestObject = $requestObject;
	}
	
	public function setRequestObject($object) {
		$this -> _requestObject = $object;
	}
	
	public function setResponseObject($object) {
		$this -> _responseObject = $object;
	}
	
	//Response object required methods
	
	public function createResponse($status = 200, $body = '', $content_type = 'text/html') {
		return $this -> _responseObject -> createResponse($status , $body, $content_type);
	}
	
	public function setStatusMessages(array $messages, array $options = array()) {
		return $this -> _responseObject -> setStatusMessages($messages, $options);
	}
	
	public function getStatusMessage($status) {
		return $this -> _responseObject -> getStatusMessage($status);
	}
	
	//Request object required methods
	
	public function processRequest() {
		return $this -> _requestObject -> processRequest();
	}
	
	public function setRequestData(array $data) {
		return $this -> _requestObject -> setRequestData();
	}
	
	public function getRequestData($format = '') {
		return $this -> _requestObject -> getRequestData();
	}
	
	public function getRequestMethod() {
		return $this -> _requestObject -> getRequestMethod();
	}
	
	public function setRequestMethod($method) {
		return $this -> _requestObject -> setRequestMethod($method);
	}
}
