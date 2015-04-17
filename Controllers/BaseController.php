<?php

	namespace Controllers;

	class BaseController extends \BaseRegular
	{
		protected $form; // http form from user

		public function __construct($form)
		{
			parent::__construct();

			$this->form = $form;
		}
	}