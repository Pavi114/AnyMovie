var title = document.getElementById('title');
var id = document.getElementById('imdbid');
var favourites = document.querySelector('#favourites');
var activity = document.querySelector('#activity');
var popular = document.querySelector('#popularShows');
var httpRequest = new XMLHttpRequest();

httpRequest.onreadystatechange = displayFav;
httpRequest.open('GET','Fav/getFav.php');
httpRequest.send();

var list = ['Game of Thrones', 'Avengers:Endgame', 'Friends', 'Suits', 'Inception', 'Baahubali 2:The Conclusion'];

for(var i = 0;i<list.length;i++){
	popularShows(list[i]);
}

title.addEventListener("input",function(){
	var httpRequest = new XMLHttpRequest();
	var value = title.value;
	httpRequest.onreadystatechange = function(){
		if(httpRequest.readyState == 4){
			if(httpRequest.status == 200){
				var response = JSON.parse(httpRequest.responseText);
				displayTitle(response);	
			}
		}		
	}
	httpRequest.open('GET','http://www.omdbapi.com/?apikey=a8b8f93d&s='+value);
	httpRequest.send();
})

id.addEventListener("input",function(){
	var httpRequest = new XMLHttpRequest();
	var value = id.value;
	httpRequest.onreadystatechange = function(){
		if(httpRequest.readyState == 4){
			if(httpRequest.status == 200){
				var response = JSON.parse(httpRequest.responseText);
				displayId(response);	
			}
		}
		
	}
	httpRequest.open('GET','http://www.omdbapi.com/?apikey=a8b8f93d&i='+value);
	httpRequest.send();
})

activity.addEventListener("click",function(){
	httpRequest.onreadystatechange = updatenotif;
	httpRequest.open('GET','notifications.php');
	httpRequest.send();
});

function updatenotif(){
	if(httpRequest.readyState ==  4){
		if(httpRequest.status == 200){
			response = httpRequest.responseText;
			document.querySelector('#list').innerHTML = response;
		}
	}
}


function displayTitle(response){
	var result = document.querySelector("#result");
	var output = '';
	if(response.hasOwnProperty('Search')){
		for(var i = 0;i<response.Search.length;i++){
			output += displayImage(response.Search[i]);
		}	
		result.innerHTML = output;
	}	
}
function displayId(response){
	var result = document.querySelector("#result");
	var output = '';
	if(response.hasOwnProperty('Title')){
		output += displayImage(response);
	}

	result.innerHTML = output;
}
function popularShows(name){
	var request = new XMLHttpRequest();
	request.onreadystatechange = function(){
		if(request.readyState == 4){
			if(request.status == 200){
				var response = JSON.parse(request.responseText);
				if(response.hasOwnProperty('Title')){
					popular.innerHTML += displayImage(response);	
				}
			}
		}
	}
	request.open('GET','http://www.omdbapi.com/?apikey=a8b8f93d&t='+name);
	request.send();
}

function displayFav(){
	var output = '';
	if(httpRequest.readyState == 4){
		if(httpRequest.status == 200){
			var response = JSON.parse(httpRequest.responseText);
			console.log(response);
			if(response.length > 0){
				for(var i = 0;i < response.length; i++){
					fav(response[i]);
				}
			}
			else {
				favourites.innerHTML = 'No favourites ';	
			}
		}
	}
}

function fav(num){
	var request = new XMLHttpRequest();
	request.onreadystatechange = function(){
		if(request.readyState == 4){
			if(request.status == 200){
				var response = JSON.parse(request.responseText);
				console.log(response);
				favourites.innerHTML += displayImage(response);
			}
		}
	}
	request.open('GET',`http://www.omdbapi.com/?apikey=a8b8f93d&i=${num}`);
	request.send();
}

function displayImage(object){
	return  `<div class="col-md-4">
	<div class="image text-center">
	<img src=${object.Poster} alt="image not found">
	<h4>${object.Title}</h4>
	<div class="row more">     
	<div class="col-md-6">Year: ${object.Year}</div>
	<div class="col-md-6">
	<form action="view_trailer.php" method="POST">
	<button type="submit" name="viewMore" class="btn" id="viewMore" value="View More">More</button>
	<input type="hidden" name="more" value=${object.imdbID} >
	</form>
	</div> 
	</div> 
	</div>
	</div>
	`;
}




