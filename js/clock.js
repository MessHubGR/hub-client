function startTime() {
    var today = new Date();
    var h = check(today.getHours());
    var m = check(today.getMinutes());

    var dd = check(today.getDate());
    var mm = check(today.getMonth()+1); //January is 0!
    var yyyy = today.getFullYear();

    document.getElementById('clock').innerHTML = h + ":" + m;
    document.getElementById('date').innerHTML = dd + "/" + mm + "/" + yyyy;
    var t = setTimeout(startTime, 500);
}
function check(i) {
    if (i < 10) {i = "0" + i};
    return i;
}
