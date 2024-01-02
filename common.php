<!-- 
    common.php, a file containing any common code 
    used by the above pages.
 -->

<?php

session_start();
function call_header()
{
   echo "<header id='bannerarea'>";
   echo "<h1>nerd<span id='logocolor'>Luv<sup>tm</sup></span></h1>";
   echo "<p>where meek geeks meet</p>";
   echo "</header>";
}
function call_footer()
{

   echo "<footer>";
   echo "   <div>";
   echo "      <p>This page is for single nerds to meet and date each other! Type in your personal information and wait for the nerdly luv to begin! Thank you for using our site.</p>";
   echo "      <p>Results and page (C) Copyright NerdLux Inc.</p>";
   echo "      <ul>";
   echo "         <li><img src='./imgs/back.png'><a href='index.php'>Back to front page</a></li>";
   echo "      </ul>";
   echo "   </div>";
   echo "</footer>";
}
?>