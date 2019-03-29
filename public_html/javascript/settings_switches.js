function toggleCheckBoxVal(id) {
    var elem = document.getElementById(id);
    var value = elem.value;
    value = 1 - value;
    elem.value = value;
}

