// Kiểm tra chiều dài của obj truyền vào có khớp với min max hay không
function checkLength(obj, min, max = null){
    len = obj.length;    
    if(len >= min && (max == null || len <= max))
        return true;
    return false;
}