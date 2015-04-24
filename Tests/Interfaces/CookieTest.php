<?php

	namespace Tests\Interfaces;

	require_once '../requires.php';

	class CookieTest extends \PHPUnit_Framework_TestCase
	{
		private $className;
		private $objCookie;

		public function __construct()
		{
			parent::__construct();

			$this->className = '\Models\Interfaces\Cookie';
			$this->objCookie =
				new \Models\Interfaces\Cookie(TEST_COOKIE_EXPIRE);
		}

		public function testHasExpire()
		{
			$this->assertClassHasAttribute('expire', $this->className);
		}

		public function testConstruct()
		{
			$this->assertInstanceOf($this->className, $this->objCookie);
		}

		public function testGetCookie()
		{
			$this->assertFalse($this->objCookie->getCookie('id'));
		}
	}