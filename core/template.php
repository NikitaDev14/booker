<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link href="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.js">
</head>
<body>
	<?php
		echo $this->dataContainer->getPageParams()['page'];
		//require_once 'Resources/html/' . $this->dataContainer->getPageParams()['page'] . '_view.php';
	?>
</body>
</html>