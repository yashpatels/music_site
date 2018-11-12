<?php
$con = mysqli_connect("localhost","root","") or die("Cannot connect to server.");
mysqli_select_db($con,"music") or die("Cannot Connect to db");

if(mysqli_query($con,"SELECT COUNT(*) FROM `songs`")){
   $count=mysqli_fetch_row(mysqli_query($con,"SELECT COUNT(*) FROM `songs`"));
   $count=$count[0];
}


$fetch_qry="SELECT * FROM `songs`";
$fetch_data=mysqli_query($con,$fetch_qry);
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>User Home</title>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!-- jPlayer -->
<link type="text/css" href="skin/uno/jplayer.uno.min.css" rel="stylesheet" />
<script type="text/javascript" src="jplayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="jplayer/jplayer.playlist.min.js"></script>
<script type="text/javascript" src="add-on/jplayer.jukebox.min.js"></script>

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
   function add_to_queue(title,link,artist,album_art){
        var jpjb=window.jpjb;
        jpjb.add({
           title: title,
           artist: artist,
           mp3: link,
        });
        document.body.style="background:url("+album_art+") no-repeat ;background-size:100%;";
     }
   function play(title,link,artist){
      var jpjb=window.jpjb;
   }
</script>
</head>
<style type="text/css">
#nav_bar{
    overflow: hidden;
    background-color: #554f4f85;
    width: 100%;
}
   #leftbar{
      height: 1000px;
      margin-top: 0.5%;
      width:30%;
      color: white;
      background-color: #554f4f85;
   }
   #main_content{
      height: 1000px;
      margin-top: 0.5%;
      width: 70%;
      background-color: #554f4f85;
   }

</style>
<link rel="stylesheet" type="text/css" href="../../music.css">

<body style="color: black;background-color: black;">
<div id="nav_bar">
      <div id="logo" style="padding-right: 55%;"><font face="Bunch Blossoms Personal Use" size="6px"><a href="Home.html">Muzikk&hearts;</a></font></div>
</div>
<div style="display: flex;">
<div id="leftbar">
   <center>
   <h2>Hey User.</h2>
   <form style="color: black;" autocomplete="off" action="/action_page.php">
         <div class="autocomplete" style="width:300px;">
         <input id="myInput" type="text" name="myCountry" placeholder="Country">
         </div>
         <br>
         <input type="submit">
      </form><br>
   <x>Your Playlist</x>
   <br>
   <x>Explore</x>
   </center>
</div>
<div id="main_content">
<a id="btn-api-select-1" href="javascript:;">select(1)</a>
<a id="btn-api-play" href="javascript:;">play()</a>
<a id="btn-api-play-1" href="javascript:;">play(1)</a>
<a id="btn-api-pause" href="javascript:;">pause()</a>
<a id="btn-api-next" href="javascript:;">next()</a>
<a id="btn-api-previous" href="javascript:;">previous()</a> 
<a id="btn-api-shuffle" href="javascript:;">shuffle()</a> 
<a id="btn-api-add" href="javascript:;">add()</a> 
<a id="btn-api-remove" href="javascript:;">remove()</a> 
<a id="btn-api-remove-2" href="javascript:;">remove(2)</a> 
<a id="btn-api-clear" href="javascript:;">clear()</a> 
<a id="btn-api-parse" href="javascript:;">parse()</a><br>

<a id="btn-api-setViewState-minimized" href="javascript:;">setViewState('minimized', 400)</a> 
<a id="btn-api-setViewState-maximized" href="javascript:;">setViewState('maximized', 400)</a> 
<a id="btn-api-setViewState-hidden" href="javascript:;">setViewState('hidden', 400)</a><br>

<a id="btn-api-showPlaylist" href="javascript:;">showPlaylist()</a> 
<a id="btn-api-showPlaylist-false" href="javascript:;">showPlaylist(false)</a><br>
<?php
while($count>0){
   $row=mysqli_fetch_row($fetch_data);
   echo "$row[1] <button onclick='add_to_queue(\"$row[1]\",\"$row[2]\",\"$row[3]\",\"$row[4]\")'>Add to Queue</button> <a href='$row[2]' title='$row[1]' data-artist='$row[3]' onclick='add_to_queue(\"$row[1]\",\"$row[2]\",\"$row[3]\",\"$row[4]\")'>Play</a> <br><br>";
   $count-=1;
}
?>
</div>
</div>
<div id="music_player"></div>
</body>





<!-- SEARCH BAR -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
.autocomplete {
  /*the container must be positioned relative:*/
  position: relative;
  display: inline-block;
}

input {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}

input[type=text] {
  background-color: #f1f1f1;
  width: 100%;
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
  padding: 10px;
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
var countries = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua & Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia & Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre & Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts & Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Turks & Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("myInput"), countries);
</script>

</html>




