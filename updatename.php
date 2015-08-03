<?php
	ob_start();
	//session_start();
	require_once("includes/functions.php"); 

//$_POST['insert_id'] = 94;
$nameDOB = new NameDOB();


$person = new Person;
	$nameId = $_POST['insert_id'];

$nameDOB->getNameById($nameId);


// $person->getName($_POST["insert_id"]);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Update Name</title>
    </head>
    <body>
        <div class="container" >
            <div class="header">
                <ul class="nav">
                    <div class="header">
                        <ul  class="nav"><!-- Start Header -->
                            <li><a href="listcontacts.php">List of All Contacts</a></li>
                        </ul>
                    </div><!-- end .header -->
            <div class="content">
                <form method="post" action="portfolio.php">
                    <div class="form-content" >

                        <div class="form-block">
                            <span class="form-label">Last Name</span>
                            <input class="input_text" type="text" size="50" name="last_name" value="<?php echo $nameDOB->last; ?>" /><br />
                        </div>

                        <div class="form-block">
                            <span class="form-label">First Name</span>
                            <input class="input_text" type="text" size="50" name="first_name" value="<?php echo $nameDOB->first ?>" /><br />
                        </div>

                        <div class="form-block">
                            <span class="form-label">Middle Name</span>
                            <input class="input_text" type="text"size="50" name="middle_name" value="<?php echo $nameDOB->middle ?>" /><br />
                        </div>

                        <div class="form-block">
                            <span class="form-label">Alias</span>
                            <input class="input_text" type="text" size="50" name="alias_name" value="<?php echo $nameDOB->alias ?>" /><br />
                        </div>

                        <div class="form-block">
                            <span class="form-label">DOB</span>
                            <div align="center">
                            <select name="birth_month" id="birth_month" size="1">
                                <?php
                                foreach($months as $value => $month)
                                {
                                    if( $nameDOB->birthMonth != $value)
                                    {
                                        echo "<option value=\"{$value}\">{$month}</option>";
                                    }
                                    elseif($nameDOB->birthMonth == $value){
                                        echo "<option selected=\"selected\" value=\"{$value}\">{$month}</option>";
                                    }
                                }
                                ?>
                            </select>
                            <select name="birth_day" id="birth_day" size="1">
                                <option value="0">  </option>
                                <?php
                                for($i=1; $i<=31; $i++){
                                    if($i == $nameDOB->birthDay)
                                    {
                                        echo "<option value=\"{$i}\" selected=\"selected\">{$i}</option>";
                                    }
                                    elseif($i != $nameDOB->birthDay){
                                        echo "<option value=\"{$i}\">{$i}</option>";
                                    }
                                }
                                ?>
                            </select>
                            <select name="birth_year" id="birth_year" size="1">
                                <option value="" > </option>
                                <?php
                                $start_year = date('Y');
                                $end_year = ($start_year - 130);
                                for($by = $start_year; $by>=$end_year; $by-- )
                                {
                                    if($by == $nameDOB->birthYear)
                                    {
                                        echo "<option value=\"{$by}\" selected=\"selected\">{$by}</option>";
                                    }
                                    elseif($by != $nameDOB->birthYear)
                                    {
                                        echo "<option value=\"{$by}\">{$by}</option>";
                                    }
                                }
                                ?>
                            </select>
                            </div><br />
                        </div>


                        <div class="form-block">
                            <span  class="form-label">Notes</span>
                            <textarea style="float: right" rows="10" cols="40" name="note" ><?php echo $nameDOB->note ?></textarea><br />
                        </div>
                        <div style="clear: both"></div>
                        <div class="form-block" style="margin-top: 10px;">
                            <input type="hidden" name="name_id" value="<?php echo $nameDOB->nameId ?>" />
                            <input type="hidden" name="insert_id" value="<?php echo $nameDOB->nameId ?>" />
                            <input type="submit" name="updatename" value="Update" /><br />
                        </div>
                    </div>
                </form><!-- end .form-content -->
            </div><!-- end .content -->
        </div><!-- end .container -->
    </body>
</html>