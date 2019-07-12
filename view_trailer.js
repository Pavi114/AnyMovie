 	var httpRequest = new XMLHttpRequest();
 	var requestForFav = new XMLHttpRequest();
 	var requestForwatchlist = new XMLHttpRequest();
 	var requestForwatch = new XMLHttpRequest();
 	var request = new XMLHttpRequest();
 	var id = document.getElementById('movieid');
 	var username = document.querySelector('#username');
 	var watchlist = document.querySelector('#watch');
 	var watched = document.querySelector('#watched');
 	var fav = '';
 	if(id){
 		httpRequest.onreadystatechange = showInfo;
 		httpRequest.open('GET','http://www.omdbapi.com/?apikey=a8b8f93d&i='+id.value);
 		httpRequest.send();


 		requestForFav.onreadystatechange = showFav;
 		requestForFav.open('POST','Fav/showfav.php');
 		requestForFav.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
 		requestForFav.send(`id=${id.value}`);

 		requestForwatchlist.onreadystatechange = showWatchlist;
 		requestForwatchlist.open('POST','Watch/showwatch.php');
 		requestForwatchlist.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
 		requestForwatchlist.send(`id=${id.value}`);

 		requestForwatch.onreadystatechange = showWatch;
 		requestForwatch.open('POST','Watch/showwatchstatus.php');
 		requestForwatch.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
 		requestForwatch.send(`id=${id.value}`);
 	}

 	function favourite(){
 		httpRequest.onreadystatechange = toggleFav;
 		httpRequest.open('POST','Fav/addfav.php');
 		httpRequest.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
 		httpRequest.send(`id=${id.value}`);
 	}

 	function showFav(){
 		if(requestForFav.readyState == 4){
 			if(requestForFav.status == 200){
 				var response = requestForFav.responseText;
 				if(response == 'yes'){
 					updateFav(0);
 				}
 				else {
 					updateFav(1);
 				}
 			}
 		}
 	}

 	function updateFav(num){
 		if(num == 0){
 			fav = '<i class="fas fa-heart"></i>';
 		}
 		else {
 			fav = '<i class="far fa-heart"></i>';
 		}
 	}

 	function toggleFav(){
 		if(httpRequest.readyState == 4){
 			if(httpRequest.status == 200){
 				var response = httpRequest.responseText;
 				if(response == 'fav'){
 					updateFav(0);
 				}
 				else {
 					updateFav(1);
 				}
 				document.querySelector("#fav").innerHTML = fav;
 			}
 		}
 	}

 	function showWatchlist(){
 		if(requestForwatchlist.readyState == 4){
 			if(requestForwatchlist.status == 200){
 				var response = requestForwatchlist.responseText;
 				if(response == 'yes'){
 					updateWatchlist(1);
 				}
 				else{
 					updateWatchlist(0);
 				}
 			}
 		}
 	}


 	function updateWatchlist(num){
 		var watchList = document.querySelector('.watchlist');
 		if(num == 0){
 			watchlist.innerHTML = '<i class="far fa-clock"></i> Add To Watchlist';
 			watchlist.classList.remove('watchList');
 		}
 		else {
 			watchlist.innerHTML = '<i class="fas fa-check-double"></i> Added To Watchlist';
 			watchlist.classList.add('watchList');
 		}
 	}


 	function toggleWatchlist(){
 		if(requestForwatchlist.readyState == 4){
 			if(requestForwatchlist.status == 200){
 				var response = requestForwatchlist.responseText;
 				if(response == 'yes'){
 					updateWatchlist(1);
 				}
 				else {
 					updateWatchlist(0);
 				}
 			}
 		}
 	}

 	function showWatch(){
 		if(requestForwatch.readyState == 4){
 			if(requestForwatch.status == 200){
 				var response = requestForwatch.responseText;
 				if(response == 'yes'){
 					updateWatch(1);
 				}
 				else{
 					updateWatch(0);
 				}
 			}
 		}
 	}

 	function updateWatch(num){
 		var watchList = document.querySelector('.watchlist');
 		if(num == 0){
 			watched.innerHTML = 'Add To Watched';
 			watched.classList.remove('watchList');
 		}
 		else {
 			watched.innerHTML = 'Watched';
 			watched.classList.add('watchList');
 		}
 	}

 	function toggleWatch(){
 		if(requestForwatch.readyState == 4){
 			if(requestForwatch.status == 200){
 				var response = requestForwatch.responseText;
 				if(response == 'yes'){
 					updateWatch(1);
 				}
 				else {
 					updateWatch(0);
 				}
 			}
 		}
 	}



 	function showInfo(){
 		var output = '';
 		if(httpRequest.readyState == 4){
 			if(httpRequest.status == 200){
 				var response = JSON.parse(httpRequest.responseText);

 				if(response.Poster != 'N/A'){
 					document.body.style.background = `linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(${response.Poster}) no-repeat fixed`;
 					document.body.style.backgroundSize = '100%';
 				}

 				output += `<div class="container">
 				<div class="row heading">
 				<div class="col-md-8">
 				<h2 class="head">${response.Title}</h2><small>${response.Type} | ${response.Genre}</small>
 				</div>
 				<div class="col-md-4 text-right">
 				<h2><span><i class="fas fa-star"></i>${response.imdbRating}/10 | <span id="fav" onclick="favourite()">${fav}</span></span></h2>
 				<small>${response.Runtime} | ${response.Year}</small>
 				</div>
 				<hr>
 				</div>
 				<div class="row content">
 				<div class="col-md-8">
 				<ul>
 				<li>${response.Plot}</li>
 				<li><span class="subhead">Released: </span>${response.Released}</li>
 				<li><span class="subhead">Language: </span>${response.Language}</li>
 				<li><span class="subhead">Cast: </span>${response.Actors}</li>
 				<li><span class="subhead">Director: </span>${response.Director}</li>
 				<li><span class="subhead">Writer: </span>${response.Writer}</li>
 				</ul>
 				</div>
 				<div class="col-md-4">
                   <img src=${response.Poster} width=100% height=380px alt="image not found">
 				</div>
 				</div>
 				</div>`;

 				document.querySelector("#details").innerHTML = output;
 				getYoutubeId(response.Title);

 			}
 		}

 	}

 

 	function getYoutubeId(search){
 		request.onreadystatechange = showVideo;
 		request.open('GET',`https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults=1&q=${search} trailer&type=video&key=AIzaSyBlXE65vAH-ibo7TvLB9tzc_UM_FT0iwkw`);
 		request.send();
 	}

 	function showVideo(){
 		var output = '';
 		if(request.readyState == 4){
 			if(request.status == 200){
 				var response = JSON.parse(request.responseText);
 				if(response.hasOwnProperty('items')){
 					var videoId = response.items[0].id.videoId;
 					var thumbnail = response.items[0].snippet.thumbnails.high.url;
 					output += ` <iframe src="http://www.youtube.com/embed/${videoId}" width="640" height="360"></iframe>`;	
 				}
 				document.querySelector("#trailer").innerHTML += output;

 			}
 		}
 	}


 	watchlist.addEventListener("click",function(){
 		requestForwatchlist.onreadystatechange = toggleWatchlist;
 		requestForwatchlist.open('POST','Watch/addwatch.php');
 		requestForwatchlist.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
 		requestForwatchlist.send(`id=${id.value}`);
 	})

 	watched.addEventListener("click",function(){
 		requestForwatch.onreadystatechange = toggleWatch;
 		requestForwatch.open('POST','Watch/addwatchstatus.php');
 		requestForwatch.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
 		requestForwatch.send(`id=${id.value}`);
 	})




