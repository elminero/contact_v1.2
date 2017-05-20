<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <title>Online Contacts</title>
</head>
<body>
    <div class="container"><!-- start .container -->
        <nav class="navbar navbar-default navbar-header" style="background-color: #1b6d85;" >
            <div class="navbar-header">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.php">Home</a></li>
                        <li><a href="login.php">Login</a></li>
                    </ul>
        </nav>
    </div>
    <div class="container"><!-- start .container -->
        <img class="img-responsive center-block img-rounded" src="css/dark_road_forest850c.jpg">
        <div class="row">
            <div class="col-sm-4">
                <h2>ISIS leaders remain in close contact with Ankara – Lavrov</h2>
                <p>
                    <?php echo basename(__FILE__, '.php'); ?>
                </p>
                <p>
                    <?php echo get_include_path(); ?>
                </p>
            </div>
            <div class="col-sm-4">
                <h2>Or your money back: Monsanto execs return $4mn in bonuses after SEC settlement</h2>

                <p>
                    Two Monsanto executives returned their lavish bonuses, amounting to nearly $4 million.
                </p>
            </div>
            <div class="col-sm-4">
                <h2>Shubham Banerjee Builds a Better Braille Printer</h2>
                <p>
                    Around the same time, Banerjee found a pamphlet requesting donations for the blind.
                </p>
            </div>
        </div>
        <!--<img src="css/dark_road_forest850c.jpg" />-->
        <?php include("includes/footer.php"); ?>
    </div><!-- end .container -->
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
