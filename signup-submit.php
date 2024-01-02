<!-- 
    signup-submit.php, the page that receives data 
    submitted by signup.php and signs up the new user.
 -->
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="nerdluv.css">
   <title>NerdLuv - Signup</title>
</head>

<body>
   <?php include "common.php";
   call_header() ?>
   <h2>Thank You!</h2>
   <p>Welcome to NerdieLuv, <?php echo $_POST['name'] . '!'; ?></p>
   <p>Now <a href="matches.php">log in to see your matches!</a></p>
   <?php include_once "common.php";
   call_footer() ?>


   <?php

   // Extra Feature #1. Robust page with form validation:
   

   // open the file
   // $open_singles_list = __DIR__ .'/singles.txt';
   // $singles_list = file($open_singles_list);
   
   // validations
   $_SESSION['error_message'] = '';

   $nameErr = $genderErr = $ageErr = $typeErr = $osErr = $seeking_minErr = $seeking_maxErr = "";
   $name = $gender = $age = $type = $os = $seeking_min = $seeking_max = "";
   $validate = true;

   if ($_SERVER['REQUEST_METHOD'] == "POST") {

      // validate the name
      $name = test_input($_POST["name"]);
      if (empty($_POST["name"])) {
         $nameErr = "*Enter a name";
         $_SESSION['error_message'] = 'Issue: You need to enter a name.';
         header("Location: ./error.php");
         exit();
      }

      // validate the gender
      $gender = test_input($_POST["gender"]);
      if (empty($gender)) {
         $genderErr = "*Enter a gender";
         $_SESSION['error_message'] = 'Issue: You need to enter a gender.';
         header("Location: ./error.php");
         exit();
      } else {
         if ($gender != "M" && $gender != "F") {
            header("Location: ./error.php");
            exit();
         }
      }


      // validate the age 
      $age = test_input($_POST["age"]);
      if (!empty($age)) {
         if ($age < 0 || $age > 99) {
            header("Location: ./error.php");
            exit();
         }
      } else {
         $ageErr = "*Enter a age";
         $_SESSION['error_message'] = 'Issue: You need to enter a age.';
         header("Location: ./error.php");
         exit();
      }

      // validate the personality type
      $type = test_input($_POST["type"]);
      if (!empty($type)) {
         // $pattern = "/^[EI][SN][TF][PJ]$/";
         // if (!preg_match("/^[EI][SN][TF][PJ]$/", $_POST["type"])) {
         if (!preg_match("/^[EI][SN][TF][PJ]$/", $type)) {
            $_SESSION['error_message'] = 'Issue: You need to enter a valid personality type.';
            header("Location: ./error.php");
            exit();
         }
      } else {
         $typeErr = "*Enter a personality type";
         $_SESSION['error_message'] = 'Issue: You need to enter a valid personality type.';
         header("Location: ./error.php");
         exit();
      }


      // validate the operating system 
      $os = test_input($_POST["os"]);
      if (!empty($os)) {
         if ($os != "Windows" && $os != "Mac OS X" && $os != "Linux") {
            $_SESSION['error_message'] = 'Issue: You need to enter a valid operating system.';
            header("Location: ./error.php");
            exit();
         }
      } else {
         $osErr = "*Enter a OS";
         $_SESSION['error_message'] = 'Issue: You need to enter a valid operating system.';
         header("Location: ./error.php");
         exit();
      }

      // validate the min age
      $seeking_min = test_input($_POST["seeking-min"]);
      if (!empty($seeking_min)) {
         if ($seeking_min < 0 || $seeking_min > 99) {
            // $validate = false;
            $_SESSION['error_message'] = 'Issue: You need to enter a minimum age greater than 0 and less than 99.';
            header("Location: ./error.php");
            exit();
         }
      } else {
         $seeking_minErr = "*Enter a age";
         //  $validate = false;
         $_SESSION['error_message'] = 'Issue: You need to enter a minimum age for your ideal match.';
         header("Location: ./error.php");
         exit();
      }


      // validate the max age
      $seeking_max = test_input($_POST["seeking-max"]);
      if (!empty($seeking_max)) {
         if ($seeking_max < 0 || $seeking_max > 99) {
            // $validate = false;
            $_SESSION['error_message'] = 'Issue: You need to enter a maximum age greater than 0 and less than 99.';
            header("Location: ./error.php");
            exit();
         }
      } else {
         $seeking_minErr = "*Enter a age";
         //  $validate = false;
         $_SESSION['error_message'] = 'Issue: You need to enter a maximum age for your ideal match.';
         header("Location: ./error.php");
         exit();
      }


      // max must be greater than min, so check if its valid. 
      if ($seeking_max < $seeking_min) {
         //  $validate = false;
         $_SESSION['error_message'] = 'Issue: You need to enter a minimum age less than the maximum age for your ideal match.';
         header("Location: ./error.php");
         exit();
      }

      
      // check if th e user already exists, if so then we cannot add them. 
      if(find_user() == true){
         $_SESSION['error_message'] = 'Issue: Sorry, this person was already found in our database..';
         header("Location: ./error.php");
         exit();
      }


      // if valid proceed to login screen, otherwise stay here. 
      if ($validate) {

         // add user into to the singles.txt file.
         $new_user_data = $name . ',' . $gender . ',' . $age . ',' . $type . ',' . $os  . ',' . $seeking_min . ',' . $seeking_max . PHP_EOL;

         // define directory for singles file & write to file
         // echo file_put_contents($singles_file, $new_user_data, FILE_APPEND);
         
         $singles_file = __DIR__ . '/' . 'singles.txt';
         $singles = fopen($singles_file,'a') or die('Unable to open the singles file.');
         fwrite($singles, $new_user_data);
         fclose($singles);

         // add_user();
         header("Location: ./index.php");
         exit();
      }
   }

   function test_input($data)
   {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
   }

   function find_user()
   {
      // check if user is found
      $found_user = false;

      // first search for the user in the list of singles, to get their information.
      $open_singles_list = __DIR__ .'/singles.txt';
      $singles_list = file($open_singles_list);
      foreach ($singles_list as $single) {
         $person = explode(',', $single);
         // compare strings with case insensitivity. 
         if(strcasecmp($person[0], $_POST['name']) == 0){
            $found_user = true;
            // break;
            return true;
         }
      }
   }

   function add_user() {
         // add user into to the singles.txt file.
      $new_user_data = $_POST['name'] . ',' . $_POST['gender'] . ',' . $_POST['age'] . ',' . $_POST['type'] . ',' . $_POST['os']  . ',' . $_POST['seeking-min'] . ',' . $_POST['seeking-max'] . '\n';

      // define directory for singles file & write to file
      $singles_file = __DIR__ . '/singles.txt';
      echo file_put_contents($singles_file, $new_user_data, FILE_APPEND);
   }

   ?>
   <?php
   // add user into to the singles.txt file.
   // $new_user_data = $_POST['name'] . ',' . $_POST['gender'] . ',' . $_POST['age'] . ',' . $_POST['type'] . ',' . $_POST['os']  . ',' . $_POST['seeking-min'] . ',' . $_POST['seeking-max'] . '\n';

   // define directory for singles file & write to file
   // $singles_file = __DIR__ . '/singles.txt';
   // echo file_put_contents($singles_file, $new_user_data, FILE_APPEND);

   // $singles = fopen($singles_file,'a') or die('Unable to open the singles file.');
   // fwrite($singles, $new_user_data);
   // fclose($singles);
   ?>
</body>

</html>