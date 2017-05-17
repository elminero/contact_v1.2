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
                    <?php



                    $password = "Robert";


                    $options = [
                        'cost' => 12,
                    ];
                    $passHash = password_hash($password, PASSWORD_BCRYPT, $options);



                    echo $passHash;





                    ?>
                </p>
                <p>



                    Two Monsanto executives returned their lavish bonuses, amounting to nearly $4 million, after the
                    agribusiness giant agreed to pay federal regulators $80 million as part of a settlement over
                    accounting violations. Monsanto agreed with the Securities Exchange Commission on Tuesday to pay the
                    sum, settling claims that the company had insufficient accounting controls to track millions of
                    dollars in rebates it offered to retailers and distributors of Roundup, one of Monsanto’s most
                    profitable products. The rebate campaign was a response to fierce competition from generic version
                    of the herbicide.
                </p>
            </div>
            <div class="col-sm-4">
                <h2>Shubham Banerjee Builds a Better Braille Printer</h2>
                <p>
                    Around the same time, Banerjee found a pamphlet requesting donations for the blind. Intrigued, he
                    asked his parents how blind people learned to read. His busy parents directed him to Google.

                    “So I Googled it, ‘how blind people read,’ and I found out about braille, braille printers, how
                    much they cost,” Banerjee said, shocked that a traditional printer was $2,000. “I’ve been to India
                    a couple times, and I’ve seen blind people and a lot of poverty everywhere, and it’s very hard for
                    them.”
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
