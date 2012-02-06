<?php

interface PVResponseInterface {
	
	public function createResponse($status = 200, $body = '', $content_type = 'text/html');
	
	public function setStatusMessages(array $messages, array $options = array());
	
	public function getStatusMessage($status);
}
