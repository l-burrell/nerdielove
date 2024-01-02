<!-- 
    matches-submit.php, the page that receives data submitted 
    by matches.php and show's the user's matches.
 -->

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="nerdluv.css">
   <title>NerdLuv - Matches Found</title>
</head>

<body>
   <?php include "common.php"; call_header() ?>
   <main>
      <!-- print welcome to user (use capitalize format) -->
      <h3>Matches for <?php echo ucwords($_GET['name']) ?></h3>
      <!-- // display the list of matches -->
      <?php

         // default the error_message.
         $_SESSION['error_message'] = '';


         // check if user is found
         $found_user = false;

         // check if a match is found
         $found_match = false;


         // first search for the user in the list of singles, to get their information.
         $open_singles_list = __DIR__ .'/singles.txt';
         $singles_list = file($open_singles_list);
         foreach ($singles_list as $single) {
            $person = explode(',', $single);
            // compare strings with case insensitivity. 
            if(strcasecmp($person[0], $_GET['name']) == 0){
               // debugging purposes:
               // echo '<b>' . $single . '</b><br><br>';
               $found_user = true;
               break;
            }
         }

         
         // Extra Feature #1. Robust page with form validation:
         if(!$found_user){
            $_SESSION['error_message'] = 'Issue: "<b>' . $_GET['name'] . '</b>" was not found in our system. Please check that the spelling is correct.';
            header("Location: error.php");
         }

         // variables to store the original search results:
         $gender = $person[1]; // Gender 
         $age = $person[2]; // Age
         $type = $person[3]; // Personality Type 
         $os = $person[4]; // Favorite OS 
         $min_age = $person[5]; // Min-Age-Range 
         $max_age = $person[6]; // Max-Age-Range 
         $found_match = false;

         // get all the singles in the list, line by line. 
         foreach ($singles_list as $single_person) {

            // then use a delimiter to get each value
            $other_person = explode(",", $single_person);

            // if both have the same gender, not a match.
            if($gender == $other_person[1]){
               continue;
            }
            // if they have different "Favorite OS", not a match.
            if($other_person[4] != $os){
               continue;
            }
            // if they are not in the age range, not a match.
            if(($other_person[2] < $min_age || $other_person[2] > $max_age) || ($age < $other_person[5] || $age > $other_person[6])){
               continue;
            }
            // if they dont share a personality type, not a match.
            // note: i will use a boolean flag to identify when a personality match occurs. 
            $matched = false;
            for($i = 0; $i < 4; $i++){
               if(strcmp($other_person[3][$i], $type[$i]) == 0){
                  $matched = true;
                  $found_match = true;
               }
            }
            if(!$matched){
               continue;
            }
            // debugging purposes: 
            // echo '<b> MATCH: ' . $single_person . '</b><br>';

            // we found the match, lets print it to the page.
            echo '<div class="match"><img src="./placeholder.png" alt="user_image">';
            echo '<table>';
            echo '<tr><th colspan="2">'      . $other_person[0]   .'</th></tr>'; // other gender
            echo '<tr><td>Gender:</td> <td>' . $other_person[1]   .'</td></tr>'; // other gender
            echo '<tr><td>Age:</td> <td>'    . $other_person[2]   .'</td></tr>'; // other_age
            echo '<tr><td>Type:</td> <td>'   . $other_person[3]   .'</td></tr>'; // other_type
            echo '<tr><td>OS:</td> <td>'     . $other_person[4]   .'</td></tr>'; // other_os
            echo '</table>';
            echo '</div>';
         }

         if(!$found_match){
            echo '<p class="no-match"> Unfortunately, we dont have any matches. Check back later. ';
         }
      ?>
   </main>
   
   <?php include_once "common.php"; call_footer() ?>
</body>
</html>