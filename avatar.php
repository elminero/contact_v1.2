
<!--  Date: 9/7/2015 -->

<!-- div 1 Start Avatar -->
    <div style="width: 175px; padding-bottom: 20px">
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


