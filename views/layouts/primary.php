<?php /* @var $this Controller */ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/css/primary.css">
    <link rel="stylesheet" type="text/css" href="/css/form.css">

    <script src="/js/primary.js"></script>
    <title><?php // echo CHtml::encode($this->pageTitle); ?></title>
    <!--[if lt IE 9]>
    <script src="js/html5.js"></script>
    <![endif]-->
</head>
<body>
    <div class="container" >

    <div class="header">
        <i><div id="logo"><?php // echo CHtml::encode(Yii::app()->name); ?></div></i>
        <ul  class="nav"><!-- Start Header -->
            <li><?php // echo CHtml::link('List All Contacts', array('person/list')); ?></li>
            <li><?php // echo CHtml::link('Create a New Contact', array('person/create')); ?></li>
            <li><?php // echo CHtml::link('Log Out', array('site/logout')); ?></li>
            <li>



            </li>





        </ul>
    </div><!-- end .header -->



        <div class="content">

        <?php // echo $content; ?>

        </div>

        <div style="clear: both"></div>
        <div id="footer">

            <div id="timer"></div>
            <?php  echo date("F j\, Y"); ?><br />
            IP Address: <?php echo $_SERVER['SERVER_ADDR'];  ?>
        </div><!-- footer -->

    </div>

</body>
</html>



