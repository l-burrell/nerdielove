<!-- 
    matches.php, a page with a form for existing users 
    to log in and check their dating matches.
 -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="nerdluv.css">
    <title>NerdLuv - Matches</title>
</head>

<body>
    <?php include "common.php"; call_header() ?>

    <fieldset>

        <legend>
            Returning Users <?php echo ""; ?>
        </legend>
        
        <form action="matches-submit.php" method="get">
            <div>
                <label for="name"><strong>Name:</strong></label>
                <input type="text" id="name" name="name" size="16" required>
            </div>
            <div>
                <input type="submit" value="View My Matches">
            </div>
        </form>
    </fieldset>
    <?php include_once "common.php"; call_footer() ?>

</body>

</html>