<!-- 
    signup.php, a page with a form that the user 
    can use to sign up for a new account 
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
    <?php include "common.php"; call_header() ?>

    <!-- <h1>SIGNUP CONTENT</h1> -->
    <fieldset>
        <legend>New User Signup</legend>

    <form action="signup-submit.php" method="post">
        <div>
            <label for="name"><strong>Name:</strong></label>
            <input type="text" id="name" name="name" size="16" required>
        </div>
        <div>
            <label for="gender"><strong>Gender:</strong></label>
            <input type="radio" name="gender" id="M" value="M" required>Male
            <input type="radio" name="gender" id="F" value="F">Female
        </div>
        <div>
            <label for="age"><strong>Age:</strong></label>
            <input type="number" id="age" name="age" maxlength="2" max="99" min="0" size="6" required>
        </div>
        <div>
            <label for="type"><strong>Personality Type:</strong></label>
            <input type="text" id="type" name="type" pattern="[EI][SN][TF][PJ]" maxlength="4" size="6" required>
            (<a href="https://www.humanmetrics.com/personality" target="_blank">Don't know your type?</a>)
        </div>
        <div>
            <label for="os"><strong>Favorite OS:</strong></label>
            <select name="os" id="os">
                <option value="Windows">Windows</option>
                <option value="Mac OS X">Mac OS X</option>
                <option value="Linux">Linux</option>
            </select>
        </div>
        <div>
            <label for="seeking-age"><strong>Seeking Age:</strong></label>
            <input type="number" id="seeking-min" name="seeking-min" maxlength="2" placeholder="min" size="6" required> to
            <input type="number" id="seeking-max" name="seeking-max" maxlength="2" placeholder="max" size="6" required>
        </div>
        <div>
            <input type="submit" value="Sign Up">
        </div>
    </form>
    </fieldset>

    <?php include_once "common.php"; call_footer() ?>
</body>

</html>