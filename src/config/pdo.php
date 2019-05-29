<?php

//Config variables
function getPDO() {
  $env = parse_ini_file('.env');

  $host = 'mysql';
  $user = $env["user"];
  $password = $env["password"];
  $dbname = $env["database"];

  // setup mysql config for PDO
  $conf = 'mysql:host=' . $host . ';dbname=' . $dbname;
  $pdo = new PDO($conf, $user, $password);
  return $pdo;
  }
