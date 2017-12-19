<?php
return array(
  "driver" => "smtp",
  "host" => "smtp.mailtrap.io",
  "port" => 2525,
  "from" => array(
      "address" => "from@example.com",
      "name" => "Example"
  ),
  "username" => "25726b19166714507",
  "password" => "6f1aca10c5c34b",
  "sendmail" => "/usr/sbin/sendmail -bs",
  "pretend" => false
);
/*
return array(
	'driver' => 'smtp',
	'host' => 'smtp.mailgun.org',
	'port' => 587,
	'from' => array('address' => null, 'name' => null),
	'encryption' => 'tls',
	'username' => null,
	'password' => null,
	'sendmail' => '/usr/sbin/sendmail -bs',
	'pretend' => false,
);
*/