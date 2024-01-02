<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NerdLuv - Oh No!</title>
    <link rel="stylesheet" href="nerdluv.css">
</head>

<body>
    <?php include_once "common.php"; call_header() ?>
    <main>
        <div>
            <h3>Error! Invalid data.</h3>
            <p>We're sorry. You submitted invalid user information. Please go back and try again.</p>
            <p class="error"><?php echo $_SESSION['error_message']; ?></p>
        </div>
    </main>
    <?php include_once "common.php"; call_footer() ?>
</body>

</html>