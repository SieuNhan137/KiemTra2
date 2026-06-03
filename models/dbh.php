<?php
  require_once(__DIR__ . '/../configs/env.php');
  try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
  }
  catch (PDOException $e) {
    die('Lỗi, không thể kết nối database!');
  }