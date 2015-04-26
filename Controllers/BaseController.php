<?php

	namespace Controllers;

	class BaseController extends \BaseRegular
	{
		protected $form; // http form from user
		protected $user;
		protected $admin;
		protected $nextPage;

		public function __construct($form)
		{
			parent::__construct();

			$this->form = $form;

			$this->user = $this->objFactory
				->getObjValidatorUser()->isValidUser();
			$this->admin = $this->objFactory
				->getObjValidatorUser()->isValidAdmin();

			$this->nextPage = 'Echo';
		}
	}