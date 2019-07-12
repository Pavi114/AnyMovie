var watched = document.querySelector('#watched');
var wantToWatch = document.querySelector('#wantToWatch');
var httpRequest = new XMLHttpRequest();
var httpRequest1 = new XMLHttpRequest();

httpRequest1.onreadystatechange = displayWatchList;
httpRequest1.open('GET','Watch/getwatchstatus.php');
httpRequest1.send();

httpRequest.onreadystatechange = displayWatch;
httpRequest.open('GET','Watch/getWatch.php');
httpRequest.send();


function displayWatch(){
	if(httpRequest.readyState == 4){
		if(httpRequest.status == 200){
			var response = JSON.parse(httpRequest.responseText);
			if(response.length > 0){
				var request = new XMLHttpRequest();
				for(var i = 0;i < response.length; i++){
					requestwatch(response[i]);
				}
			}
		}
	}
}

function displayWatchList(){
	if(httpRequest1.readyState == 4){
		if(httpRequest1.status == 200){
			var response = JSON.parse(httpRequest1.responseText);
			console.log(response);
			if(response.length > 0){	
				for(var i = 0;i < response.length; i++){
					requestlist(response[i]);
				}
			}
		}
	}
}

function requestlist(num){
	var request1 = new XMLHttpRequest();
	request1.onreadystatechange = function(){
		if(request1.readyState == 4){
			if(request1.status == 200){
				var responseObj = JSON.parse(request1.responseText);
				console.log(responseObj);
				wantToWatch.innerHTML += displayImage(responseObj);
			}
		}
	}
	request1.open('GET',`http://www.omdbapi.com/?apikey=a8b8f93d&i=${num}`);
	request1.send();
}

function requestwatch(num){
	var request = new XMLHttpRequest();
	request.onreadystatechange = function(){
		if(request.readyState == 4){
			if(request.status == 200){
				var responseObj = JSON.parse(request.responseText);
				console.log(responseObj);
				watched.innerHTML += displayImage(responseObj);
			}
		}
	}
	request.open('GET',`http://www.omdbapi.com/?apikey=a8b8f93d&i=${num}`);
	request.send();
}

function displayImage(object){
	return  `<div class="col-md-3">
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

