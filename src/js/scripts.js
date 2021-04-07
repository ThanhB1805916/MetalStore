// Kiểm tra chiều dài của obj truyền vào có khớp với min max hay không
function checkLength(obj, min, max = null){
    len = obj.length;    
    if(len >= min && (max == null || len <= max))
        return true;
    return false;
}

  // Tải ảnh lên khi chọn file
  function onFileSelected(event) {
    var selectedFile = event.target.files[0];
    var reader = new FileReader();

    var imgtag = document.getElementById("myimage");
    imgtag.title = selectedFile.name;

    reader.onload = function(event) {
        imgtag.src = event.target.result;
    };

    reader.readAsDataURL(selectedFile);
}