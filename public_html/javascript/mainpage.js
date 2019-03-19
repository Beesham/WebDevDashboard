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

// Weather AJAX Implementation
window.onload = function (){
    var weather = new XMLHttpRequest();

    weather.onreadystatechange=function() {
        if (weather.readyState==4 && weather.status==200) {
            var data = JSON.parse(weather.response);
            console.log(data);
            var country = data.sys.country;
            document.getElementById("weather").innerHTML=data.name + ", " +country;
            document.getElementById("myImg").src = "http://openweathermap.org/img/w/" + data.weather[0].icon + ".png";
            document.getElementById("temp").innerHTML="Current Temp: " + data.main.temp;
            document.getElementById("weatherDisc").innerHTML="Current : " +data.weather[0].description;
            document.getElementById("minTemp").innerHTML="Current Temp: " + data.main.temp_min;
            document.getElementById("maxTemp").innerHTML="Current Temp: " + data.main.temp_max;

        }
    }
    weather.open("GET", "https://api.openweathermap.org/data/2.5/weather?q=Windsor,CA&appid=b84611f50d84a37deb41db143654d722&units=metric", true);
    weather.send();
}