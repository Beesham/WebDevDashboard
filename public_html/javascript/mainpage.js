function init() {
    document.getElementById("inputBttn").addEventListener("click", newToDoListItem);
    document.getElementById("game-reset-button").addEventListener("click", resetGame);
    window.setInterval(updateGreeting, 3600000);
    window.setInterval(refreshNews, 3600000);
    window.setInterval(updateWeather, 3600000);
    updateGreeting();
    updateWeather();
    resetGame();
    enableDragDrop();
    getNews();
}

window.addEventListener("load", init);


// Greeting
/**
 * Updates the time, user greeting, and the quote of the day on the main page
 */
function updateGreeting(){

    var greeting = "Hello, ";
    var am_pm = null;
    var currentdate = new Date();
    var hour = currentdate.getHours();
    var min = currentdate.getMinutes();

    var time = currentdate.getHours() + ":"
        + currentdate.getMinutes() + ":" + currentdate.getSeconds();

    if (hour < 12){
        greeting = "Good Morning";
        am_pm = "AM";
    }else if (hour == 12 && min < 60 || hour > 12 &&  hour < 17){
        greeting = "Good Afternoon";
        am_pm = "PM";
    }else{
        greeting = "Good Evening";
        am_pm = "PM";
    }

    document.getElementById("time").innerHTML = time + " " + am_pm;

    document.getElementById("greeting").innerHTML = greeting;

    // AJAX call to get quote of the day - checks every 12 hour
    var quotes = new XMLHttpRequest();
    quotes.onreadystatechange=function() {
        if (quotes.readyState==4 && quotes.status==200) {
            var data = JSON.parse(quotes.response);
            console.log(data);
            var q = data.contents.quotes[0].quote;
            document.getElementById("quote").innerHTML="Quote of the day: " + q;
        }
    };
    quotes.open('GET', "http://quotes.rest/qod.json", true);
    quotes.send();
};


// To-do list
/**
 * To-do list implementation
 */
function newToDoListItem() {
    var item = document.getElementById("input").value;
    item = checkForHtmlInjection(item);

    if (item) {

        var ul = document.getElementById("list");
        var li = document.createElement("li");
        li.appendChild(document.createTextNode("  + " + item));
        ul.appendChild(li);
        document.getElementById("input").value = "";
        li.onclick = removeItem;

        //postItem(item);
    }
}

/**
 * Removes the to-do list item on click
 * @param e
 */
function removeItem(e) {
    e.target.parentElement.removeChild(e.target);
}

/**
 * Gets the to-do item the user types and removes any html injection if any
 * @param arbitraryHtmlString
 * @returns {string}
 */
function checkForHtmlInjection(arbitraryHtmlString ) {
    const temp = document.createElement('div');
    temp.innerHTML = arbitraryHtmlString;
    return temp.innerText;
}


// Drag & Drop game
function enableDragDrop(){
    document.getElementById('q1').setAttribute('draggable', true);
    document.getElementById('q2').setAttribute('draggable', true);
    document.getElementById('q3').setAttribute('draggable', true);
    document.getElementById('q4').setAttribute('draggable', true);
    document.getElementById('q1').addEventListener('dragstart', dragAnswer);
    document.getElementById('q2').addEventListener('dragstart', dragAnswer);
    document.getElementById('q3').addEventListener('dragstart', dragAnswer);
    document.getElementById('q4').addEventListener('dragstart', dragAnswer);
    document.getElementById('a2').addEventListener('dragover', dragOverAnswer);
    document.getElementById('a1').addEventListener('dragover', dragOverAnswer);
    document.getElementById('a3').addEventListener('dragover', dragOverAnswer);
    document.getElementById('a4').addEventListener('dragover', dragOverAnswer);
    document.getElementById('a1').addEventListener('drop', dropAnswer);
    document.getElementById('a2').addEventListener('drop', dropAnswer);
    document.getElementById('a3').addEventListener('drop', dropAnswer);
    document.getElementById('a4').addEventListener('drop', dropAnswer);
}

function dragAnswer(ev){
    ev.dataTransfer.setData("city", ev.target.innerHTML);
    ev.dataTransfer.setData("id", ev.target.id);
}

function dragOverAnswer(ev){
    ev.preventDefault();
}

function dropAnswer(ev){

    if (ev.dataTransfer.getData("city") === "Chennai" && ev.target.innerHTML === "India" ){
        ev.target.appendChild(document.getElementById(ev.dataTransfer.getData("id")));
        ev.target.innerHTML = "India/Chennai";
        event.target.style.backgroundColor = "green";

    }

    else if (ev.dataTransfer.getData("city") === "Toronto" && ev.target.innerHTML === "Canada" ){
        ev.target.appendChild(document.getElementById(ev.dataTransfer.getData("id")));
        ev.target.innerHTML = "Canada/Toronto";
        event.target.style.backgroundColor = "green";
    }

    else if (ev.dataTransfer.getData("city") === "Paris" && ev.target.innerHTML === "France" ){
        ev.target.appendChild(document.getElementById(ev.dataTransfer.getData("id")));
        ev.target.innerHTML = "France/Paris";
        event.target.style.backgroundColor = "green";
    }

    else if (ev.dataTransfer.getData("city") === "Venice" && ev.target.innerHTML === "Italy" ){
        ev.target.appendChild(document.getElementById(ev.dataTransfer.getData("id")));
        ev.target.innerHTML = "Italy/Venice";
        event.target.style.backgroundColor = "green";
    }


}

/**
 * Allows the user to reset the game
 */
function resetGame(){

    var myNode = document.getElementById("cities");
    var fc = myNode.firstChild;

    while( fc ) {
        myNode.removeChild( fc );
        fc = myNode.firstChild;
    }

    var myNode = document.getElementById("country");
    var fc = myNode.firstChild;

    while( fc ) {
        myNode.removeChild( fc );
        fc = myNode.firstChild;
    }


    var cityDiv = document.getElementById("cities");
    var newDiv = document.createElement("div");
    var newContent = document.createTextNode("Chennai");
    newDiv.appendChild(newContent);
    newDiv.setAttribute("id","q1")
    newDiv.setAttribute("class","city")
    cityDiv.appendChild(newDiv);

    newDiv = document.createElement("div");
    newContent = document.createTextNode("Toronto");
    newDiv.appendChild(newContent);
    newDiv.setAttribute("id","q2")
    newDiv.setAttribute("class","city")
    cityDiv.appendChild(newDiv);

    var newDiv = document.createElement("div");
    var newContent = document.createTextNode("Paris");
    newDiv.appendChild(newContent);
    newDiv.setAttribute("id","q3")
    newDiv.setAttribute("class","city")
    cityDiv.appendChild(newDiv);

    var newDiv = document.createElement("div");
    var newContent = document.createTextNode("Venice");
    newDiv.appendChild(newContent);
    newDiv.setAttribute("id","q4")
    newDiv.setAttribute("class","city")
    cityDiv.appendChild(newDiv);

    var cityDiv = document.getElementById("country");
    var newDiv = document.createElement("div");
    var newContent = document.createTextNode("France");
    newDiv.appendChild(newContent);
    newDiv.setAttribute("id","a1")
    newDiv.setAttribute("class","country")
    cityDiv.appendChild(newDiv);

    newDiv = document.createElement("div");
    newContent = document.createTextNode("India");
    newDiv.appendChild(newContent);
    newDiv.setAttribute("id","a2")
    newDiv.setAttribute("class","country")
    cityDiv.appendChild(newDiv);

    var newDiv = document.createElement("div");
    var newContent = document.createTextNode("Italy");
    newDiv.appendChild(newContent);
    newDiv.setAttribute("id","a3")
    newDiv.setAttribute("class","country")
    cityDiv.appendChild(newDiv);

    var newDiv = document.createElement("div");
    var newContent = document.createTextNode("Canada");
    newDiv.appendChild(newContent);
    newDiv.setAttribute("id","a4")
    newDiv.setAttribute("class","country")
    cityDiv.appendChild(newDiv);

    enableDragDrop();
}

function postItem(item){
    console.log('in post item method......');

    $.ajax({
        url:"../php/post_list_item.php",
        method: "post",
        data: item,
        success: function (res){
            console.log(res);
        }
    })

    console.log('finishes');
}

// Weather
/**
 * Updates weather using AJAX asynchronous call
 */
function updateWeather(){
    var weather = new XMLHttpRequest();

    weather.onreadystatechange=function() {
        if (weather.readyState==4 && weather.status==200) {
            var data = JSON.parse(weather.response);
            var country = data.sys.country;
            document.getElementById("weather").innerHTML= "Current weather in " + data.name + ", " +country;
            document.getElementById("myImg").src = "http://openweathermap.org/img/w/" + data.weather[0].icon + ".png";
            document.getElementById("temp").innerHTML="Current Temp: " + data.main.temp + " C";
            document.getElementById("weatherDisc").innerHTML="Current: " +data.weather[0].description;
            document.getElementById("minTemp").innerHTML="Min Temp: " + data.main.temp_min + " C";
            document.getElementById("maxTemp").innerHTML="Max Temp: " + data.main.temp_max + " C";

        }
    };
    weather.open("GET", "https://api.openweathermap.org/data/2.5/weather?q=Windsor,CA&appid=b84611f50d84a37deb41db143654d722&units=metric", true);
    weather.send();
};

// News
/**
 * Retrieves and updates top 5 news headlines using AJAX asynchronous call
 */
function getNews(){
    var news = new XMLHttpRequest();

    news.onreadystatechange=function() {
        if (news.readyState==4 && news.status==200) {
            var data = JSON.parse(news.response);
            console.log(data);

            for(i = 0; i < 5; i++){
                var cityDiv = document.getElementById("news-articles");
                var newDiv = document.createElement("a");
                var newContent = document.createTextNode('> '  + data.articles[i].title);
                newDiv.appendChild(newContent);
                newDiv.href=data.articles[0].url;
                newDiv.setAttribute("class","news-article")
                cityDiv.appendChild(newDiv);
            }
        }
    };
    news.open("GET", "https://newsapi.org/v2/top-headlines?country=us&apiKey=dec7e1177aa54d70a1e9549ff237658d", true);
    news.send();
};

/**
 * Removes existing news and repopulates the news widget with latest headlines
 */
function refreshNews(){
    var myNode = document.getElementById("news-articles");
    var fc = myNode.firstChild;

    while( fc ) {
        myNode.removeChild( fc );
        fc = myNode.firstChild;
    }
    getNews();
}