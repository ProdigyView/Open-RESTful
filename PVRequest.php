<?php

class PVRequest implements PVRequestInterface {
	
	protected $_request_data;
	
	protected $_request_method;

	protected $_http_request;
	
	public function __construct($data = null, array $options = array()) {
		
		$defaults = array(
			'process_request' => true,
			'request_method' => '',
			'http_accept' =>  (strpos($_SERVER['HTTP_ACCEPT'], 'json')) ? 'json' : 'xml'
			);
		
		$options += $defaults;
		
		$this -> _request_data = array();
		
		$this -> _request_method = $options['request_method'];
		
		$this -> _http_request = $options['http_accept'];
		
		if($options['process_request']) {
			$this -> processRequest();
		}
		
		return $this;
	}
	
	public function processRequest() {

		$this -> _request_method = strtolower($_SERVER['REQUEST_METHOD']);
		
		switch ($this -> _request_method) {

			case 'get' :
				$this -> _request_data = $_GET;
				break;
			case 'post' :
				$this -> _request_data = $_POST;
				break;
			case 'put' :
				parse_str(file_get_contents('php://input'), $vars);
				$this -> _request_data = $vars;
				break;
		}

	}
	
	public function setRequestData($data) {
		$this ->_request_data = $data;
	}
	
	public function getRequestData($format = '') {
		
		switch ($format) {
			case 'json':
				$data = json_encode($this ->_request_data);
				break;
			default:
				$data = $this ->_request_data;
				break;
		}
		
		return $data;
	}
	
	public function getRequestMethod() {
		return $this ->_request_method;
	}
	
	public function setRequestMethod($method) {
		$this -> _request_method = $method;
	}
}