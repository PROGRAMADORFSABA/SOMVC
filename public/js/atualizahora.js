
function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
   
    // add a zero in front of numbers<10
    m = checkTime(m);
    s = checkTime(s);

    if ( h >= 12 && h <= 18 ) {
        document.getElementById('andreteste').innerHTML = " Boa Tarde! ";
    }else if ( h >= 00 && h < 12 ){
        document.getElementById('andreteste').innerHTML = " Bom Dia! ";
    }else{
        document.getElementById('andreteste').innerHTML = " Boa Noite! ";
    }

    document.getElementById('timefooter').innerHTML = h + ":" + m + ":" + s;
    t = setTimeout(function () {
        startTime()
    }, 500);
}
startTime();
