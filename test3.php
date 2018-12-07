<?php



$con = mysqli_connect("localhost","root","") or die("Cannot connect to server.");
mysqli_select_db($con,"music") or die("Cannot Connect to db");

session_start();
$username=$_SESSION["username"];
if($username==''){
   echo "<script>location='home.php';</script>";
}

if(mysqli_query($con,"SELECT COUNT(*) FROM `songs`")){
   $count=mysqli_fetch_row(mysqli_query($con,"SELECT COUNT(*) FROM `songs`"));
   $count=$count[0];
}

$fetch_qry="SELECT * FROM `songs`";
$fetch_data=mysqli_query($con,$fetch_qry);

$tags='';
while($count>0){
   $row=mysqli_fetch_row($fetch_data);
   $tags.="$row[5],";
   $count-=1;
}

$fetch_qry="SELECT * FROM `songs`";
$fetch_data=mysqli_query($con,$fetch_qry);

if(mysqli_query($con,"SELECT COUNT(*) FROM `songs`")){
   $count=mysqli_fetch_row(mysqli_query($con,"SELECT COUNT(*) FROM `songs`"));
   $count=$count[0];
}

?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="music.css">

<title>User Home</title>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!-- jPlayer -->
<link type="text/css" href="skin/uno/jplayer.uno.min.css" rel="stylesheet" />
<script type="text/javascript" src="jplayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="jplayer/jplayer.playlist.min.js"></script>
<script type="text/javascript" src="add-on/jplayer.jukebox.min.js"></script>
<script>var quelen=-1;</script>

<script type="text/javascript">
   $(document).ready(function(){
      // Initialize jPlayerJukebox
      var jpjb = new jPlayerJukebox({
         'swfPath': 'jplayer',
         'jukeboxOptions': {
            'autoAdvance': false,
            'position': 'float-bl'
         }
      });
     window.jpjb=jpjb;
      $('#btn-api-select-1').on('click', function(){ jpjb.select(5); });
      $('#btn-api-play').on('click', function(){ jpjb.play(); });
      $('#btn-api-play-1').on('click', function(){ jpjb.play(1); });
      $('#btn-api-pause').on('click', function(){ jpjb.pause(); });
      $('#btn-api-next').on('click', function(){ jpjb.next(); });
      $('#btn-api-previous').on('click', function(){ jpjb.previous(); });
      $('#btn-api-shuffle').on('click', function(){ jpjb.shuffle(); });
      $('#btn-api-add').on('click', function(){
         jpjb.add({
            'title': 'mp3 (New song)',
            'artist': 'Lucas Gonze',
            'mp3': 'media/mp3.mp3',
            'poster': 'media/cover2.jpg',
            'download': true,
            'buy': 'https://www.freesound.org/people/lucasgonze/sounds/58970/'
         });
      });
      $('#btn-api-remove').on('click', function(){ jpjb.remove(); });
      $('#btn-api-remove-2').on('click', function(){ jpjb.remove(2); });
      $('#btn-api-clear').on('click', function(){ jpjb.clear(); });
      $('#btn-api-parse').on('click', function(){ jpjb.parse(); });

      $('#btn-api-setViewState-minimized').on('click', function(){ jpjb.setViewState('minimized', 400); });
      $('#btn-api-setViewState-maximized').on('click', function(){ jpjb.setViewState('maximized', 400); });
      $('#btn-api-setViewState-hidden').on('click', function(){ jpjb.setViewState('hidden', 400); });

      $('#btn-api-showPlaylist').on('click', function(){ jpjb.showPlaylist(); });
      $('#btn-api-showPlaylist-false').on('click', function(){ jpjb.showPlaylist(false); });
     
     
   });

   function add_to_queue(title,link,artist){
        var jpjb=window.jpjb;
      if(quelen==-1){
           jpjb.clear();
       }
        jpjb.add({
           title: title,
           artist: artist,
           mp3: link,
        });
      quelen+=1;
     }
     function add_album_art(title,link,artist,album_art){
        var jpjb=window.jpjb;
      if(quelen==-1){
           jpjb.clear();
      }
        jpjb.add({
           title: title,
           artist: artist,
           mp3: link,
        });
      quelen+=1;
      jpjb.select(quelen);
        document.body.style="background:url("+album_art+") no-repeat ;background-size:100%;";
     }

     function songs_print(a,b){
      var i=1;
      document.getElementById('initial_songs').style.display="none";
     document.getElementById('explore').style="display:none;";
      while(i<=b)
      {
         if(i==a)
         {
               document.getElementById(a).style.display="block";
         }
         else{
            document.getElementById(i).style.display="none";
         }
         i++;
      }
   }

   function view_dropdown(id){
      document.getElementById('playlist_add'+id).style.display="none";
      document.getElementById('playlist_drop'+id).style.display="block";
   }

   function playlist_form_visible(){
      document.getElementById('create_playlist_div').style="display:block;";
   }
   function playlist_form_invisible(){
      document.getElementById('create_playlist_div').style="display:none;";
   }
   
   function display_explore(a){
      document.getElementById('explore').style="display:block;";
      document.getElementById('initial_songs').style="display:none;";
      var i=1;
      while(i<=a)
      {
        document.getElementById(i).style.display="none";
         i++;
      }
   }

</script>
</head>
<style type="text/css">
#nav_bar{
    overflow: hidden;
    background-color: #554f4f85;
    width: 100%;
    z-index:0;
}
   #leftbar{
      height: 1000px;
      margin-top: 0.5%;
      width:25%;
      color: white;
      background-color: #554f4f85;
      z-index:0;
      display:inline-block;
   }
   #main_content{
      height: 1000px;
      margin-top: 0.5%;
      width: 75%;
      background-color: #554f4f85;
      z-index:0;
      display:inline-block;
   }
   xy:hover{
      color: #da00aa;
   }
.logout:hover{
   color:#da00aa;
}
td{
padding: 10px; 
color: white;
font-size: 20px;
}
.queue_button{
   background-color: transparent; /* Green */
    border: none;
    color: white;
    padding: 16px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    cursor: pointer;
    border-radius: 5px;
}
.button1 {
    background-color: transparent; 
    color: white; 
    border: 2px solid white;
}

.button1:hover {
    background-color: #da00aa;
    color: black;
    border-color: transparent;
}

#create_playlist_btn{
      color:white;
      background:transparent;
      border:0;
      border-radius:5%;
   }
   #create_playlist_btn:hover{
      background-color:#da00aa;
      border-radius:5%;
   }
   #create_playlist_div{
      display:none;
      color:blue;
      border-radius:5%;
      width: 50%;
      height:50%;
      background-color:#ffffff63;
   }
   
   .remove_playlist{
      float:right;
      font-size:150%;
      font-weight:bold;
   }
   .remove_playlist:hover{
      color:#da0022;
   }
   .play_hover:hover{
      color:#da00aa;
   }
   a:hover{
         color:#da00aa;
   }

</style>
<body style="color: black;background-color: black">
<div style="position:absolute;top:20px;left:60%">
<form style="color: black;" autocomplete="off" action="action_page.php">
         <div class="autocomplete" style="width:250px;">
         <input id="myInput" type="text" name="myCountry">
         </div>
         <input type="submit">
      </form>
   </div>

<div id="nav_bar">
      <div id="logo" style="padding-right: 55%;"><font face="Bunch Blossoms Personal Use" size="6px"><a href="test3.php">Muzikk&hearts;</a></font></div>
      <a class="logout"style="float:right;margin-top: 10px;font-size:125%" href="logout.php">Log Out</a>
</div>
<div style="display:flex;">
<div id="leftbar">
   <center>
   <h2>Hey <?php echo $username; ?>.</h2>
   <br>
   <x style="font-size: 150%;">Your Playlist</x> <button style='cursor:pointer;' onclick="playlist_form_visible()" id="create_playlist_btn"><b>+</b></button>
   <br><br>
   <div id="create_playlist_div"><button onclick="playlist_form_invisible()" style="color:white;cursor:pointer;float:right;border:0;background:transparent;"><b>&times;</b></button>
   <center><br><br>
   <form method="POST" id="create_playlist_form">
    <input style="width:50%;background:transparent;" type='text' name="new_playlist_name" placeholder='Enter Name'/>
    <br>
    <input style="border-radius:15%;" type='submit' value='Create'/>
   </form>
   </center>
   <br><br>
   </div>
   <br>

   <?php 
      $playlist_fetch="select distinct name from `playlists` where username='$username'";
      $count_play="select count(distinct name) from playlists where username='$username'";
      $count_result=mysqli_query($con,$count_play);
      $no_of_playlists=mysqli_fetch_row($count_result);
      $no_of_playlists=$no_of_playlists[0];
      $playlist_result=mysqli_query($con,$playlist_fetch);
      $j=1;
      while($playlist_row=mysqli_fetch_array($playlist_result))
      {
         $name = $playlist_row["name"];
         echo "<xy onclick='songs_print($j,$no_of_playlists)' style='font-size:125%;cursor:pointer;'>$name</xy><br><br>";
         $j++;
      }
   ?>

   <xy onclick='display_explore(<?php echo $no_of_playlists;?>)' style='font-size:125%;cursor:pointer;'><b>Explore</b></xy>
   </center>
</div>
<div id="main_content">

<div style="display:none;" id="explore">
<?php

$random_fetch_qry="SELECT * FROM `songs` ORDER BY RAND() LIMIT 4";
$random_result=mysqli_query($con,$random_fetch_qry);
echo "<table>";
while($random_row=mysqli_fetch_array($random_result)){
   $album_art=$random_row[4];
   $title=$random_row[1];
   $artist=$random_row[3];
   $link=$random_row[2];
   $id=$random_row[0];
   echo "<tr><td style='width:10%'><img src='$album_art' alt='$title' height='100px' width='100px'></td><td style='width:17%'>$title</td><td style='width:15%'>$artist</td><td style='width:10%'><button class='queue_button button1' onclick='add_to_queue(\"$title\",\"$link\",\"$artist\",\"$album_art\")'>Add to Queue</button></td><td class='play_hover' style='width:10%'><a href='$link' title='$title' data-artist='$artist' onclick='add_album_art(\"$title\",\"$link\",\"$artist\",\"$album_art\")'>Play</a></td></tr>";
}
echo "</table>";
?>
</div>


   <?php
   $playlist_fetchs="select distinct name from `playlists` where username='$username'";
   $i=1;
      $playlist_results=mysqli_query($con,$playlist_fetchs);
      while($playlist_rows=mysqli_fetch_array($playlist_results))
      {
         $name = $playlist_rows["name"];

         echo "<div style='display:none;' id=$i><h1 style='color:white;float:left;'>$name</h1><a class='remove_playlist' href='delete_playlist.php?name=$name'>Delete Playlist</a><br><br><br><br><br>";
         $i+=1;
            $playlist_songs="select * from playlists where username='$username' and name='$name'";
            $song_result=mysqli_query($con,$playlist_songs);
            while($song_row=mysqli_fetch_array($song_result))
            {
               $songid= $song_row["song_id"];
               $songfetch= "select * from songs where id='$songid'";
               $songid_result= mysqli_query($con,$songfetch);
               echo "<table>";
               while($songid_row=mysqli_fetch_array($songid_result))
               {
                  $id=$songid_row["id"];
                  $title=$songid_row["title"];
                  $link=$songid_row["link"];
                  $artist=$songid_row["artist"];
                  $album_art=$songid_row["album_art"];
                  echo "<tr><td style='width:10%'><img src='$album_art' alt='$title' height='100px' width='100px'></td><td style='width:17%'>$title</td><td style='width:15%'>$artist</td><td style='width:10%'><button class='queue_button button1' onclick='add_to_queue(\"$title\",\"$link\",\"$artist\",\"$album_art\")'>Add to Queue</button></td><td style='width:10%'><form action='' method='POST'><input type='hidden' name='remove_from_playlist_hidden' value='$id'><input type='hidden' name='remove_from_playlist_name' value='$name'><button class='queue_button button1' type='submit' value='Remove' name='remove_from_playlist'>Remove</button></form></td><td class='play_hover' style='width:10%'><a href='$link' title='$title' data-artist='$artist' onclick='add_album_art(\"$title\",\"$link\",\"$artist\",\"$album_art\")'>Play</a></td></tr>";
               }
            }
            echo "</table></div>";
      }

    ?>

    <?php 
      if(isset($_POST['remove_from_playlist']))
      {
         $song_remove_id=$_POST['remove_from_playlist_hidden'];
         $song_playlist_name=$_POST['remove_from_playlist_name'];
         $song_remove_qry="delete from playlists where song_id='$song_remove_id' and name='$song_playlist_name' and username='$username'";
         if(mysqli_query($con,$song_remove_qry))
         {
            echo "<script>alert('Song Removed From Playlist');location.href='test3.php';</script>";
         }
      }
    ?>
<div id="initial_songs">
<table>
<?php
while($count>0){
   $row=mysqli_fetch_row($fetch_data);
   echo "<tr>
               <td style='width:10%'><img src=\"$row[4]\" alt=\"$row[4]\" height=\"100px\" width=\"100px\"></td>
               <td style='width:17%'>$row[1]</td><td style='width:15%'>By $row[3]</td>
               <td style='width:10%'><button class='queue_button button1' onclick='add_to_queue(\"$row[1]\",\"$row[2]\",\"$row[3]\",\"$row[4]\")'>Add to Queue</button></td>
               <td style='width:10%'><div id='playlist_add$row[0]'><button onclick='view_dropdown($row[0])' class='queue_button button1'>Add To Playlist</button></div><div id='playlist_drop$row[0]' style='display:none'> <form action='' method='POST'>
                        <input type=\"hidden\" name='song_id_' value=\"$row[0]\"><select name='playlist_name'>";
               $fetch_playlist_name="select distinct name from playlists where username='$username'";
               $fetch_playlist_run=mysqli_query($con,$fetch_playlist_name);
               while($fetch_playlist_row=mysqli_fetch_array($fetch_playlist_run))
               {
                  $playlist_name=$fetch_playlist_row['name'];
                  ?>
                     <option value="<?php echo $playlist_name;?>"><?php echo $playlist_name;?></option>

                     
                  <?php
               }
   echo " </select><input type='submit' name='add' value='add'></form></div></td>
               <td class='play_hover' style='width:10%'><a href='$row[2]' title='$row[1]' data-artist='$row[3]' onclick='add_album_art(\"$row[1]\",\"$row[2]\",\"$row[3]\",\"$row[4]\")'>Play</a></td>
         </tr>";
   $count-=1;
}


      if(isset($_POST["add"]))
      {

         $song_add_playlist_id=$_POST["song_id_"];
         $playlist_name_=$_POST["playlist_name"];
         $do_not_repeat="select * from playlists where song_id='$song_add_playlist_id' and username='$username' and name='$playlist_name_'";
         $do_not_run=mysqli_query($con,$do_not_repeat);
         if(mysqli_num_rows($do_not_run)==0){
         $add_song_playlist="INSERT INTO playlists(song_id,username,name) VALUES('$song_add_playlist_id','$username','$playlist_name_')";
         if(mysqli_query($con,$add_song_playlist))
         {
            echo "<script>alert('Added to playlist');location.href='test3.php'</script>";
         }}
         else
            echo "<script>alert('Song already exists in playlist')</script>";
      }

?>
</table>
</div>
</div>
</div>
</body>

<?php

@$name=addslashes($_POST['new_playlist_name']);
if($name!=''){
   $create_playlist_qry="INSERT INTO `playlists`(`song_id`,`username`,`name`) VALUES('0','$username','$name')";
   if(mysqli_query($con,$create_playlist_qry)){
      echo "<script>alert('Playlist created successfully.');location='test3.php';</script>";
   }
   else{
      echo "<script>alert('Playlist cannot be created.');location='test3.php';</script>";
   }
}
?>





<!-- SEARCH BAR -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
.autocomplete {
  /*the container must be positioned relative:*/
  position: relative;
  display: inline-block;
  z-index: 1;
}

input {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 5px;
  font-size: 16px;
}

input[type=text] {
  background-color: #f1f1f1;
  width: 100%;
  padding: 5px;
}

input[type=submit] {
  background-color: black;
  color: #fff;
  cursor: pointer;
}

.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 5px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

.autocomplete-items div:hover {
  /*when hovering an item:*/
  background-color: black; 
}

.autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important; 
  color: black; 
}
</style>



<script>
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the country names in the world:*/
var tags="<?php echo $tags;?>".split(',');
/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("myInput"), tags);
</script>

</html>




