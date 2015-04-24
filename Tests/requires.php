<?php
	require_once '../../config.php';

	require_once '../config.php';

	require_once '../SingletonTest.php';
	require_once '../RegularTest.php';

	require_once BASE_PATH_FOR_TESTS . 'BaseSingleton.php';
	require_once BASE_PATH_FOR_TESTS . 'BaseRegular.php';

	require_once BASE_PATH_FOR_TESTS . 'Models/Interfaces/Cookie.php';
	require_once BASE_PATH_FOR_TESTS . 'Models/Interfaces/Database.php';
	require_once BASE_PATH_FOR_TESTS . 'Models/Interfaces/Http.php';
	require_once BASE_PATH_FOR_TESTS . 'Models/Interfaces/Session.php';

	require_once BASE_PATH_FOR_TESTS . 'Models/Performers/Appointment.php';
	require_once BASE_PATH_FOR_TESTS . 'Models/Performers/Room.php';
	require_once BASE_PATH_FOR_TESTS . 'Models/Performers/User.php';

	require_once BASE_PATH_FOR_TESTS . 'Models/Utilities/ObjFactory.php';
	require_once BASE_PATH_FOR_TESTS . 'Models/Utilities/DataContainer.php';

	require_once BASE_PATH_FOR_TESTS . 'Models/Validators/ValidatorAppointment.php';
	require_once BASE_PATH_FOR_TESTS . 'Models/Validators/ValidatorLogin.php';
	require_once BASE_PATH_FOR_TESTS . 'Models/Validators/ValidatorSignup.php';
	require_once BASE_PATH_FOR_TESTS . 'Models/Validators/ValidatorUser.php';