<?php
require("Name.php");

abstract class Queries extends NameDOB
{
    public function displayQuery($imageId) // Support for class Picture
    {
        $stmt = $this->mysqli->prepare("
                    SELECT image_name, name_id, caption
                    FROM images
                    WHERE image_id = ?
                    AND visible = 1");

        $stmt->bind_param("i", $imageId);
        $stmt->execute();
        $stmt->bind_result($imageName, $nameId, $caption );
        $stmt->fetch();
        $stmt->close();
        $row = array("imageName"=>$imageName, "nameId"=>$nameId, "caption"=>$caption );
        return $row;
    }


	public function previousQuery($imageId)
	{
        $previous = "";
        $stmt = $this->mysqli->prepare("
					SELECT image_id
					FROM images
					WHERE name_id = ?
					AND visible = 1
					AND image_id > ?
					LIMIT 1");

        $stmt->bind_param("ii", $this->insertId, $imageId );
        $stmt->execute();
        $stmt->bind_result($imageId);
        $stmt->fetch();
        $stmt->close();
        if($imageId != NULL)
        {
            $previous = $imageId;
		}
        elseif ($imageId == NULL)
        {
            $stmt = $this->mysqli->prepare("
					SELECT MIN(image_id)
					FROM images
					WHERE name_id = ?
					AND visible = 1");

            $stmt->bind_param("i", $this->insertId);
            $stmt->execute();
            $stmt->bind_result($imageId);
            $stmt->fetch();
            $stmt->close();
            $previous = $imageId;
        }
        return $previous;
	}


	public function subsequentQuery($imageId) // Support for class Picture
	{
        $subsequent = "";

        $stmt = $this->mysqli->prepare("
					SELECT image_id
					FROM images
					WHERE name_id = ?
					AND visible = 1
					AND image_id < ?
					ORDER BY image_id
					DESC LIMIT 1");

        $stmt->bind_param("ii", $this->insertId, $imageId);
        $stmt->execute();
        $stmt->bind_result($imageId);
        $stmt->fetch();
        $stmt->close();
        if($imageId != NULL)
        {
            $subsequent =  $imageId;
		}elseif($imageId == NULL)
        {
        $stmt = $this->mysqli->prepare("
					SELECT MAX(image_id)
					FROM images
					WHERE name_id = ?
					AND visible = 1");

        $stmt->bind_param("i", $this->insertId);
        $stmt->execute();
        $stmt->bind_result($imageId);
        $stmt->fetch();
        $stmt->close();
        $subsequent =  $imageId;
		}
        return $subsequent;
	}


	public function updateCaptionQuery($imageId, $caption) // Support for class Picture
	{
        $stmt =  $this->mysqli->prepare("
					UPDATE images
					SET caption = ?
					WHERE image_id = ?");
        $stmt->bind_param("si", $caption, $imageId);
        $stmt->execute();
        $stmt->close();
	}


	public function hideImageQuery($imageId) // Support for class Picture
	{
		$stmt = $this->mysqli->prepare("
                    UPDATE images
                    SET visible = 0
                    WHERE image_id = ?");

        $stmt->bind_param("i", $imageId);
        $stmt->execute();
        $stmt->close();
	}


	public function setAvatarQuery($insertId, $avatarImageId) // Support for class Picture
	{
	// Get all images from insert id

        $stmt = $this->mysqli->prepare("
                    SELECT image_id
                    FROM images
                    WHERE name_id = ?");

        $stmt->bind_param("i", $insertId);
        $stmt->execute();
        $stmt->bind_result($imageId );
        while($stmt->fetch())
        {
            $imageIds[] = $imageId;
        }
        $stmt->close();

        $stmt = $this->mysqli->prepare("
                    UPDATE images
                    SET avatar = 0
                    WHERE image_id = ?");

        foreach($imageIds as $imageId)
        {
            $stmt->bind_param("i", $imageId);
            $stmt->execute();
        }
        $stmt->close();

	// SET avatar column to one for $avatar_image_id

        $stmt = $this->mysqli->prepare("
                    UPDATE images
                    SET avatar = 1
                    WHERE image_id = ?");

        $stmt->bind_param("i", $avatarImageId);
        $stmt->execute();
	}


    public $allVisiblePictures;
	public function getAllQuery($insertId) // Support for class Picture
	{
        $stmt = $this->mysqli->prepare("
                    SELECT image_id, name_id, image_name, caption, avatar
                    FROM images
                    WHERE name_id = ?
                    AND visible = 1
                    ORDER BY image_id DESC");

        $stmt->bind_param("i", $insertId);
        $stmt->execute();
        $stmt->bind_result($imageId, $nameId, $imageName, $caption, $avatar);

        while($stmt->fetch())
        {
            $this->allVisiblePictures[] = array("imageId"=>$imageId,
                                                "nameId"=>$nameId,
                                                "imageName"=>$imageName,
                                                "caption"=>$caption,
                                                "avatar"=>$avatar);
        }
        $stmt->close();
        return $this->allVisiblePictures;
    }


	public function uploadImageQuery($insertId, $imageLocationName) // Support for class Picture
	{
		$stmt = $this->mysqli->prepare("
                    INSERT INTO images
                    (name_id, image_name, avatar, visible)
                    VALUES
                    (?, ?,  0, 1 )");
		
		$stmt->bind_param("is", $insertId, $imageLocationName);
		$stmt->execute();
		$stmt->close();
	}


    public function updatePhoneNumbersQuery($phoneNumber, $phoneType, $noteText, $phoneId )
    {
        $stmt = $this->mysqli->prepare("
                    UPDATE phone_numbers
                    SET phone_number = ?,
                    phone_type = ?,
                    note = ?
                    WHERE phone_id = ?");

        $stmt->bind_param("sisi", $phoneNumber, $phoneType, $noteText, $phoneId);
        $stmt->execute();
        $stmt->close();
    }


    public function addPhoneNumberQuery($nameId, $phoneNumber, $phoneType, $note )
    {
        $stmt = $this->mysqli->prepare("
                    INSERT INTO phone_numbers
                    (name_id, phone_number, phone_type, note)
                    VALUES
                    (?, ?, ?, ?)");

        $stmt->bind_param("isis", $nameId, $phoneNumber, $phoneType, $note );
        $stmt->execute();
        $insertId = $this->mysqli->insert_id;
        $stmt->close();
        return $insertId;
    }


    public function updateAddressQuery($addressType, $countryIso, $state, $street, $city, $city, $postalCode, $note, $address_id)
    {
        $stmt = $this->mysqli->prepare("
                    UPDATE addresses
                    SET address_type = ?,
                    country_iso = ?,
                    state = ?,
                    street = ?,
                    city = ?,
                    postal_code = ?,
                    note = ?
                    WHERE address_id = ?");

        $stmt->bind_param("issssssi", $addressType, $countryIso, $state, $street, $city, $postalCode, $note, $address_id);
        $stmt->execute();
        $stmt->close();
    }


    public function updateEmailAddressQuery($emailAddress, $emailType, $note, $emailId)
    {
        $stmt = $this->mysqli->prepare("
                    UPDATE email_addresses
                    SET
                    email_address = ?,
                    email_type = ?,
                    note = ?
                    WHERE email_id = ?");

        $stmt->bind_param("sisi", $emailAddress, $emailType, $note, $emailId );
        $stmt->execute();
        //$insertId = $this->mysqli->insert_id;
        $stmt->close();
        //return $insertId;
    }


    public function addEmailAddressQuery($nameId, $emailAddress, $emailType, $note)
    {
        $stmt = $this->mysqli->prepare("
                    INSERT INTO email_addresses
                    (name_id, email_address, email_type, note)
                    VALUES
                    (?, ?, ?, ?)");

        $stmt->bind_param("isis", $nameId, $emailAddress, $emailType, $note );
        $stmt->execute();
        $insertId = $this->mysqli->insert_id;
        $stmt->close();
        return $insertId;
    }

}






