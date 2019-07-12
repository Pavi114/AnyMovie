  <?php
  session_start();
  if(!isset($_SESSION['userLoggedIn'])){
    header('location: register.php');
  }
  if(isset($_POST['viewMore'])){
    if(isset($_POST['more'])){
      $_SESSION['id'] = $_POST['more'];
      echo '<input type="hidden" value="'.$_POST['more'].'" id="movieid">';
    }
  }

  ?>


  <!DOCTYPE html>
  <html>
  <head>
  	<title>View More</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <style type="text/css">
    html {
      height: 100%;
    }
    body {
      background: #000000;
      color: white;
      font-size: 1.3vw;
    }
    .more {
      background-color: rgb(0, 0, 0,0.6);
      width: 60%;
      padding: 0;
      margin-top: 100px;
    }
    .head {
      letter-spacing: 4px;
      text-transform: uppercase;
      font-weight: bolder;
    }
    .heading {
      width: 100%;
      font-size: 2vw;
      margin: 0;
      background: rgba(0,0,0,0.8);
    }
    .content {
      height: 400px;
      width: 100%;
      margin-top: 15px;

    }
    .subhead {
      text-transform: uppercase;
      letter-spacing: 1px;
    }
    .hidden {
      display: none;
    }
    iframe {
      border: 0;
    }
    ul {
      list-style-type: none;
    }
    #fav i:hover {
      color: #FF0000;
      cursor: pointer;
    }
    .fas.fa-heart {
      color: #FF0000;
    }
    .fas.fa-star {
      color: #FFFF00;
    }
    .fas.fa-check-double{
      color: #00FF00;
    }
    .btn:hover {
      background: inherit;
    }
    .watchlist {
      background: inherit;
      border: 1px solid white;
    }
    button {
      padding: 1px;
      margin: 10px;
    }
    .navbar {
      background: #000000;
    }
  </style>
</head>
<body>
  <?php include('navbar.php'); ?>
  <div class="container more rounded">
    <div id="details">

    </div>
    <div>
      <div class="col-md-12 text-center">
       <button type="button" class="btn btn-primary" id="watched">Watched</button>    
     </div>
   </div>
   <div id="trailer" class="text-center">

   </div> 
   <div id="watchlist">
    <div class="col-md-12 text-center">
     <button type="button" class="btn btn-primary" id="watch"></button>    
   </div>     
 </div>  
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="view_trailer.js"></script>
</body>
</html>