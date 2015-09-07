<?php
// require("models/Contact.php");
/*
$id = NULL;

if( isset($_GET['id']) )
$id = $_GET['id'];

if( isset($_POST['id']) )
$id = $_POST['id'];

$contact = new Contact($id);
$contact->getContactById();
*/
?>

<!--  Date: 9/7/2015 -->

<!-- div 1 Start Avatar -->
<div  style="float: left">
    <a href="picture.php?id=<?php echo $contact->avatar->id; ?>"><img alt="" src="images/<?php echo $contact->avatar->path_file; ?>_t.jpg" /></a>
    <br />
    <div style="float: left">
        <a href="addphotos.php?id=<?php echo $id ?>">View All</a>
    </div>
    <div style="float: right">
        <a href="editphotos.php?id=<?php echo $id ?>">Edit</a>
    </div>
</div>
<!-- End Avatar -->


