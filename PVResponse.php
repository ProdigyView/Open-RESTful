<?php

class PVResponse implements PVResponseInterface {
	
	protected $_statusMessages;
	
	public function __construct() {
		
		$this -> _statusMessages = self::getDefaultStatusMessages();
		
		return $this;
		
	}
	
	public function createResponse($status, $body = '', $options = array()) {
		
		$defaults = array(
			'content_type' => 'text/html',
			'message' => ''
		);
		
		$options += $defaults;
		extract($options);
		
		$status_header = 'HTTP/1.1 ' . $status . ' ' . $this ->getStatusMessage($status);
		
		header($status_header);
		header('Content-type: ' . $content_type);

		if ($body != '') {
			return $body;
		} else {

			$signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];

			$body = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
						<html>
							<head>
								<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
								<title>' . $status . ' ' . self::getStatusMessage($status) . '</title>
							</head>
							<body>
								<h1>' . self::getStatusMessage($status) . '</h1>
								<p>' . $message . '</p>
								<hr />
								<address>' . $signature . '</address>
							</body>
						</html>';

			return $body;
		}
	}
	
	public function setStatusMessages($messages, $options = array()) {
			
		$defaults = array('use_message_defaults' => true);
		$options += $defaults;
		
		if($options['use_message_defaults'])
			$messages += self::getDefaultStatusMessages();
		
		$this -> _statusMessages = $messages;
	}
	
	public function getStatusMessage($status) {
		
		return (isset($this -> _statusMessages[$status])) ? $this -> _statusMessages[$status] : '';
	}
	
	protected static function getDefaultStatusMessages() {
		
		$status = Array(
			100 => 'Continue', 
			101 => 'Switching Protocols', 
			200 => 'OK', 
			201 => 'Created', 
			202 => 'Accepted', 
			203 => 'Non-Authoritative Information', 
			204 => 'No Content', 
			205 => 'Reset Content', 
			206 => 'Partial Content', 
			300 => 'Multiple Choices', 
			301 => 'Moved Permanently', 
			302 => 'Found', 
			303 => 'See Other', 
			304 => 'Not Modified', 
			305 => 'Use Proxy', 
			306 => '(Unused)', 
			307 => 'Temporary Redirect', 
			400 => 'Bad Request', 
			401 => 'Unauthorized', 
			402 => 'Payment Required', 
			403 => 'Forbidden', 
			404 => 'Not Found', 
			405 => 'Method Not Allowed', 
			406 => 'Not Acceptable', 
			407 => 'Proxy Authentication Required', 
			408 => 'Request Timeout', 
			409 => 'Conflict', 
			410 => 'Gone', 
			411 => 'Length Required', 
			412 => 'Precondition Failed', 
			413 => 'Request Entity Too Large', 
			414 => 'Request-URI Too Long', 
			415 => 'Unsupported Media Type', 
			416 => 'Requested Range Not Satisfiable', 
			417 => 'Expectation Failed', 
			500 => 'Internal Server Error', 
			501 => 'Not Implemented', 
			502 => 'Bad Gateway', 
			503 => 'Service Unavailable', 
			504 => 'Gateway Timeout', 
			505 => 'HTTP Version Not Supported');

		return $status;
	}
	
}
