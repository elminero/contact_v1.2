<?php
	ob_start();	
	require_once("includes/functions.php");
	
    $picture = new Picture;

    if(  isset($_GET['insert_id'])  )
    {
        $insert_id = $_GET['insert_id'];
        $_POST['insert_id'] = $insert_id;
    }else
    {
        $insert_id = $_POST['insert_id'];
    }

    $pictures = $picture->getAll($insert_id);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>View All</title>
</head>

<body>
<div class="container">
<div class="header">
<ul class="nav" >
	<li><a href="listcontacts.php">List of All Contacts</a></li>
	<li><a href="portfolio.php?insert_id=<?php echo $insert_id ?>">Show Contact</a></li>
	<li><a href="addphotos.php?insert_id=<?php echo $insert_id ?>">Add Photos</a></li>
</ul>
</div><!-- end .header -->

<div class="content">
 <table>
<?php
        if($pictures)
        {
            $i = 4; $b = 1;
            foreach($pictures as $pic)
            {
?>
                <?php if( ($i % 4) == 0){echo "<tr>";}?>


                <td>
                    <a href="picture.php?pic=<?php echo $pic['imageId']; ?>">
                        <img src="images/<?php echo $pic['imageName']; ?>_t.jpg" />
                    </a>
                </td>

                 <?php if( ($b % 4) == 0 ){echo "</tr>";} $i++; $b++; ?>

<?php
             }
         }


?>
</table>
</div><!-- end .content -->
</div><!-- end .container -->
</body>
</html>
<!--
'imageId' => int 28
'nameId' => int 11
'imageName' => string '14/03/01/12/3262c130' (length=20)
'caption' => string 'Girlie ass' (length=10)
'avatar' => int 0
-->