// Thêm sinh viên
const overlay = document.getElementById('overlay');
const openThemSinhVienForm = document.getElementById('openThemSinhVienForm');
const themOverlay = document.getElementById('themOverlay');
const themSinhVienBtn = document.getElementById('themSinhVienBtn');
const themSinhVienForm = document.getElementById('themSinhVienForm');
const mssvFormInp = themSinhVienForm.querySelector('input[name=mssv]');
const hotenFormInp = themSinhVienForm.querySelector('input[name=hoten]');
const diemphpFormInp = themSinhVienForm.querySelector('input[name=diemphp]');
const diemmysqlFormInp = themSinhVienForm.querySelector('input[name=diemmysql]');
const diemhtmlFormInp = themSinhVienForm.querySelector('input[name=diemhtml]');


document.getElementById('closeOverlay').onclick = () => {
  if (!overlay.classList.contains('hidden')) {
    overlay.classList.add('hidden');
  }
}
openThemSinhVienForm.onclick = () => {
  if (overlay.classList.contains('hidden')) {
    overlay.classList.remove('hidden');
  }
}

themSinhVienBtn.onclick = () => {
  mssvFormInp.value = themOverlay.querySelector('table input[name=mssv]').value;
  hotenFormInp.value = themOverlay.querySelector('table input[name=hoten]').value;
  diemphpFormInp.value = themOverlay.querySelector('table input[name=diemphp]').value;
  diemmysqlFormInp.value = themOverlay.querySelector('table input[name=diemmysql]').value;
  diemhtmlFormInp.value = themOverlay.querySelector('table input[name=diemhtml]').value;
  themSinhVienForm.submit();
}
