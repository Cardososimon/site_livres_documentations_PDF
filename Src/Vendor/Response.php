<?php
    namespace Src\Vendor;
    class Response {

        private $headers=array();

	public function addheader($headerValue){
            $this->headers[]=$headerValue;
	}

	public function sendheader(){
            foreach ($this->headers as $header) {
		header($header);
            }
	}
        public function send($content){
            $this->sendheader();
            echo $content;
	}
    }