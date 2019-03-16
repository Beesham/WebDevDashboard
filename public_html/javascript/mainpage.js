function init() {
    document.getElementById("inputBttn").addEventListener("click", newToDoListItem);
}
window.addEventListener("load", init);


// To Do list implementation

function newToDoListItem() {
    var item = document.getElementById("input").value;

    if (item) {
        var ul = document.getElementById("list");
        var li = document.createElement("li");
        li.appendChild(document.createTextNode("  + " + item));
        ul.appendChild(li);
        document.getElementById("input").value = "";
        li.onclick = removeItem;
    }
}

function removeItem(e) {
    e.target.parentElement.removeChild(e.target);
}