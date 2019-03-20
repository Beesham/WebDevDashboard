function init() {
    document.getElementById("inputBttn").addEventListener("click", newToDoListItem);
    updateGreeting();
    updateWeather();
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



function updateGreeting(){

    var greeting = "Hello, ";
    var userName = "Test User";
    var currentdate = new Date();
    var datetime = "Last Sync: " + currentdate.getDate() + "/"
        + (currentdate.getMonth()+1)  + "/"
        + currentdate.getFullYear() + " @ "
        + currentdate.getHours() + ":"
        + currentdate.getMinutes() + ":"
        + currentdate.getSeconds();

    var time = currentdate.getHours() + ":"
        + currentdate.getMinutes();

    var hour = currentdate.getHours();
    var min = currentdate.getMinutes();

    if (hour < 12){
        greeting = "Good Morning";
    }else if (hour == 12 && min < 60 || hour > 12 &&  hour < 17){
        greeting = "Good Afternoon";
    }else{
        greeting = "Good Evening";
    }

    document.getElementById("time").innerHTML = time;

    document.getElementById("greeting").innerHTML = greeting + ", " +
        userName;

};

// Weather AJAX Implementation
function updateWeather(){
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
            document.getElementById("minTemp").innerHTML="Min Temp: " + data.main.temp_min;
            document.getElementById("maxTemp").innerHTML="Max Temp: " + data.main.temp_max;

        }
    };
    weather.open("GET", "https://api.openweathermap.org/data/2.5/weather?q=Windsor,CA&appid=b84611f50d84a37deb41db143654d722&units=metric", true);
    weather.send();
};