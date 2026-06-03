<?php
  require_once(__DIR__ . '/models/dbh.php');
  require_once(__DIR__ . '/models/Student.php');
  $students = Student::IndexStudent($pdo);
  $errors = [];
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_GET['action'];
    if ($action === 'themSinhVien') {
      $data = [
        'mssv' => $_POST['mssv'],
        'hoten' => $_POST['hoten'],
        'diemphp' => $_POST['diemphp'],
        'diemmysql' => $_POST['diemmysql'],
        'diemhtml' => $_POST['diemhtml']
      ];
      $errors['themSinhVien'] = Student::StoreStudent($pdo, $data);
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý điểm học tập</title>
  <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
  <div id="overlay" class="hidden">
    <div id="themOverlay" class="">
      <button id="closeOverlay">x</button>
      <table>
        <tr>
          <th>Mã sinh viên</th>
          <th>Họ tên</th>
          <th>Điểm PHP</th>
          <th>Điểm MySQL</th>
          <th>Điểm HTML</th>
        </tr>
        <tr>
          <td>
            <?php if (!empty($errors['themSinhVien'])) { ?>
              <p class="errorMessage"><?= (!empty($errors['themSinhVien']['mssv']['message'])) ? $errors['themSinhVien']['mssv']['message'] : '' ?></p>
            <?php } ?>
            <input type="text" name="mssv" placeholder="Mã số sinh viên..." 
            value="<?php (!empty($errors['themSinhVien'])) ? $errors['themSinhVien']['mssv']['oldvalue'] : '' ?>">
          </td>
          <td>
            <?php if (!empty($errors['themSinhVien'])) { ?>
              <p class="errorMessage"><?= (!empty($errors['themSinhVien']['hoten']['message'])) ? $errors['themSinhVien']['hoten']['message'] : '' ?></p>
            <?php } ?>
            <input type="text" name="hoten" placeholder="Họ tên..." 
            value="<?php (!empty($errors['themSinhVien'])) ? $errors['themSinhVien']['hoten']['oldvalue'] : '' ?>">
          </td>
          <td>
            <?php if (!empty($errors['themSinhVien'])) { ?>
              <p class="errorMessage"><?= (!empty($errors['themSinhVien']['diemphp']['message'])) ? $errors['themSinhVien']['diemphp']['message'] : '' ?></p>
            <?php } ?>
            <input type="number" name="diemphp" placeholder="Điểm PHP..." 
            value="<?php (!empty($errors['themSinhVien'])) ? $errors['themSinhVien']['diemphp']['oldvalue'] : '' ?>">
          </td>
          <td>
            <?php if (!empty($errors['themSinhVien'])) { ?>
              <p class="errorMessage"><?= (!empty($errors['themSinhVien']['diemmysql']['message'])) ? $errors['themSinhVien']['diemmysql']['message'] : '' ?></p>
            <?php } ?>
            <input type="number" name="diemmysql" placeholder="Điểm MySQL..." 
            value="<?php (!empty($errors['themSinhVien'])) ? $errors['themSinhVien']['diemmysql']['oldvalue'] : '' ?>">
          </td>
          <td>
            <?php if (!empty($errors['themSinhVien'])) { ?>
              <p class="errorMessage"><?= (!empty($errors['themSinhVien']['diemhtml']['message'])) ? $errors['themSinhVien']['diemhtml']['message'] : '' ?></p>
            <?php } ?>
            <input type="number" name="diemhtml" placeholder="Điểm HTML..." 
            value="<?php (!empty($errors['themSinhVien'])) ? $errors['themSinhVien']['diemhtml']['oldvalue'] : '' ?>">
          </td>
        </tr>
      </table>
      <button id="themSinhVienBtn">Thêm</button>
      <form action="index.php?action=themSinhVien" method="post" id="themSinhVienForm">
        <input type="hidden" name="mssv">
        <input type="hidden" name="hoten">
        <input type="hidden" name="diemphp">
        <input type="hidden" name="diemmysql">
        <input type="hidden" name="diemhtml">
      </form>
    </div>
  </div>
  <div class="mainContentWrapper">
    <button id="openThemSinhVienForm">
      Thêm sinh viên +
    </button>
    <table>
      <tr>
        <th>Mã sinh viên</th>
        <th>Họ tên</th>
        <th>ĐTB</th>
        <th>Xếp loại</th>
      </tr>
      <?php if (!empty($students)) { ?>
        <?php foreach($students as $student) {
          $student['DTB'] = ($student['diemphp']*2+$student['diemmysql']*2+$student['diemhtml'])/5;
          if ($student['DTB']>=8) $student['xeploai'] = 'Giỏi';
          else if ($student['DTB']>=6.5) $student['xeploai'] = 'Khá';
          else if ($student['DTB']>=5) $student['xeploai'] = 'Trung bình';
          else $student['xeploai'] = 'Yếu'; ?>
          <tr>
            <td><?= $student['mssv'] ?></td>
            <td><?= $student['hoten'] ?></td>
            <td><?= $student['DTB'] ?></td>
            <td><?= $student['xeploai'] ?></td>
          </tr>
        <?php } ?>
      <?php } else { ?>
        <tr>
          <td colspan="4" style="font-style: italic;">Chưa có sinh viên nào</td>
        </tr>
      <?php } ?>
    </table>
  </div>
  <script src="assets/js/main.js"></script>
</body>
</html>