function myFunction(tenanh) {
    var txt = "\"./img/animals/" + tenanh + "\"";
    document.getElementById("image").src = txt;
    // return txt;
}


// console.log(myFunction("Hello"));

function showdv(phanloai, loai) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("kq-sx").innerHTML =(this.responseText); //=>kết quả trả về thêm vào element này, có html vẫn hiện được
        }
    };
    xmlhttp.open("GET", "getdata-phanloai.php?phanloai=" + phanloai + "&loai=" + loai, true);
    xmlhttp.send();
}