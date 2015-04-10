<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>


        <link rel="stylesheet" type="text/css" href="css/main.css"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Untitled Document</title>
    </head>

    <body>

    <div class="container">
        <div class="header">
        </div><!-- end .header -->
        <div class="sidebar1">
            <ul class="nav">
                <li><a href="#">Link one</a></li>
                <li><a href="#">Link two</a></li>
                <li><a href="#">Link three</a></li>
                <li><a href="#">Link four</a></li>
            </ul>
            <p> The above links demonstrate a basic navigational structure.</p>
            <p>If you would like the navigation along the top, simply move </p>
        </div><!-- end .sidebar1 -->
        <div class="content">
            <h1>Instructions</h1>

            <form action="controllers/ImageController.php" method="post" enctype="multipart/form-data" >
                <div>File<input type="file" name="file"  /></div><br />
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                File<input type="submit" name="imageUpLoad" value="Upload Image" />
            </form>

            <p>Be aware that the CSS for these layouts is heavily commented.</p>
            <h2>Clearing Method</h2>
            <p>Because all the columns are floated, this layout uses a clear:both</p>
            <h3>Logo Replacement</h3>
            <p>An image placeholder was used in this layout in the .header where </p>
            <p> Be aware that if you use the Property inspector to navigate to your</p>
            <p>To remove the inline styles, make sure your CSS Styles panel is set </p>
        </div><!-- end .content -->
        <div class="sidebar2">
        <h4>Backgrounds</h4>
        <p>By nature, the background color on any div will only show for the len</p>
        </div><!-- end .sidebar2 -->
        <div class="footer">
        <p>This .footer contains the declaration position:relative; to give Internet</p>
        </div><!-- end .footer -->
    </div><!-- end .container -->
    </body>
</html>


