<?php

$con = mysqli_connect("localhost","root","") or die("Cannot connect to server.");
mysqli_select_db($con,"music") or die("Cannot Connect to db");
session_start();
$username=$_SESSION["username"];
if($username==''){
   echo "<script>location='home.php';</script>";
}

   $playlist_fetchs="select distinct name from `playlists` where username='$username'";
      $playlist_results=mysqli_query($con,$playlist_fetchs);
      while($playlist_rows=mysqli_fetch_array($playlist_results))
      {
         $name = $playlist_rows["name"];

         echo "<div style='display:none;' id=$name>";
            $playlist_songs="select * from playlists where username='$username' and name='$name'";
            $song_result=mysqli_query($con,$playlist_songs);
            while($song_row=mysqli_fetch_array($song_result))
            {
               $songid= $song_row["song_id"];
               $songfetch= "select * from songs where id='$songid'";
               $songid_result= mysqli_query($con,$songfetch);
               while($songid_row=mysqli_fetch_array($songid_result))
               {
                  $id=$songid_row["id"];
                  $title=$songid_row["title"];
                  $link=$songid_row["link"];
                  $artist=$songid_row["artist"];
                  $album_art=$songid_row["album_art"];
                  echo "$title <button onclick='add_to_queue(\"$title\",\"$link\",\"$artist\",\"$album_art\")'>Add to Queue</button> <a href='$link' title='$title' data-artist='$artist' onclick='add_album_art(\"$title\",\"$link\",\"$artist\",\"$album_art\")'>Play</a> <br><br>";
               }
            }
            echo "</div>";
      }
    ?>
