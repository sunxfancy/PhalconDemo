<?php

class ControllerBase extends \Phalcon\Mvc\Controller
{
	public function initialize() {
		Phalcon\Tag::prependTitle('PhalconDemo | ');
		$this->response->setHeader("Content-Type", "text/html; charset=utf-8");
	}
}