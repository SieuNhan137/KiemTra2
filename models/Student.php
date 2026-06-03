<?php
  class Student {
    public static function IndexStudent($pdo) {
      $query = 'SELECT * FROM students';
      $stmt =  $pdo->prepare($query);
      $stmt->execute();
      return $stmt->fetchAll();
    }
    public static function StoreStudent($pdo, $data) {
      $errors = [];
      $query = 'SELECT * FROM students WHERE mssv = ?';
      $stmt = $pdo->prepare($query);
      $stmt->execute([$data['mssv']]);
      if (!empty($stmt->fetchAll())) {
        $errors['mssv'] = [
          'message' => 'Mã số sinh viên đã tồn tại!',
        ];
      }
      if (!preg_match('/^[\S\d]{1,10}$/', $data['mssv']) || empty(trim($data['mssv']))) {
        $errors['mssv'] = [
          'message' => 'Mã số sinh viên không được chứa các ký tự đặc biệt, khoảng trắng và có độ dài từ 1 đến 10 ký tự',
        ];
      }
      if (!preg_match('/^[\p{L} ]{1,50}$/u', $data['hoten']) || empty(trim($data['hoten']))) {
        $errors['hoten'] = [
          'message' => 'Họ tên sinh viên không được chứa các ký tự đặc biệt, số và có độ dài từ 1 đến 50 ký tự',
        ];
      }
      if (!filter_var($data['diemphp'], FILTER_SANITIZE_NUMBER_FLOAT) || $data['diemphp']<0 || $data['diemphp']>10 || empty(trim($data['diemphp']))) {
        $errors['diemphp'] = [
          'message' => 'Điểm phải nằm trong khoảng từ 0-10!',
        ];
      }
      if (!filter_var($data['diemmysql'], FILTER_SANITIZE_NUMBER_FLOAT) || $data['diemmysql']<0 || $data['diemmysql']>10 || empty(trim($data['diemmysql']))) {
        $errors['diemmysql'] = [
          'message' => 'Điểm phải nằm trong khoảng từ 0-10!',
        ];
      }
      if (!filter_var($data['diemphp'], FILTER_SANITIZE_NUMBER_FLOAT) || $data['diemhtml']<0 || $data['diemhtml']>10 || empty(trim($data['diemhtml']))) {
        $errors['diemhtml'] = [
          'message' => 'Điểm phải nằm trong khoảng từ 0-10!',
        ];
      }

      if ((empty($errors))) {
        $query = 'INSERT INTO students VALUES (?, ?, ?, ?, ?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$data['mssv'], $data['hoten'], $data['diemphp'], $data['diemmysql'], $data['diemhtml']]);
        header('Location: index.php');
        exit();
      }
      else {
        $errors['mssv']['oldvalue'] = $data['mssv'];
        $errors['hoten']['oldvalue'] = $data['hoten'];
        $errors['diemphp']['oldvalue'] = $data['diemphp'];
        $errors['diemmysql']['oldvalue'] = $data['diemmysql'];
        $errors['diemhtml']['oldvalue'] = $data['diemhtml'];
        return $errors;
      }
    }
    public static function DeleteStudent($pdo, $mssv) {
      $errors = [];
      $query = 'DELETE FROM students WHERE mssv = ?';
      $stmt = $pdo->prepare($query);
      $stmt->execute([$mssv]);
      if ($stmt->rowCount()>0) {
        header('Location: index.php');
        exit();
      }
      else {
        $errors['mssv'] = [
          'message' => 'Mã số sinh viên không tồn tại hoặc không hợp lệ!'
        ];
        return $errors;
      }
    }
  }