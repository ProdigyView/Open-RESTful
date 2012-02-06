<?php

interface PVResponseInterface {
	
	public function createResponse($status , $body, $options );
	
	public function setStatusMessages($messages, $options = array());
	
	public function getStatusMessage($status);
}
