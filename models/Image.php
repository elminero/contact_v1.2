<?php
//tDebug --  Db2 -- User -- Person -- Address -- PhoneNumber -- EmailAddress -- (Image)
// require("EmailAddress.php");
require_once(dirname(dirname(__FILE__)).'/models/Db.php');

/*
        TABLE:   image
        COLUMNS: id, person_id, path_file, caption, avatar, visible
        VARIABLES: $id, $personId, $pathFile, $caption, $avatar, $visible

        id              integer
        person_id       integer
        path_file       string
        caption         string
        avatar          boolean
        visible         boolean
*/

class Image extends Db2 {

    private $_id, $_personId,  $_pathFile, $_caption, $_avatar, $_visible;

    private function setImageParam(ImageController $image)
    {
        $this->_id = $image->getId();
        $this->_personId = $image->getPersonId();
        $this->_pathFile = $image->getPathFile();
        $this->_caption = $image->getCaption();
        $this->_avatar = $image->getAvatar();
        $this->_visible = $image->getVisible();
    }


    public function getId(){return $this->_id;}
    public function getPersonId(){return $this->_personId;}
//    public function getPathFile(){return $this->_imageLocation . $this->_randHex;}
    public function getCaption(){return $this->_caption;}
    public function getAvatar(){return $this->_avatar;}
    public function getVisible(){return $this->_visible;}


    public function addImage($image)  // class Image
    {
        self::setImageParam($image);

        if($this->_avatar === 1) {
            self::resetAvatarToZero($this->_personId);
        }

        $stmt = $this->mysqli->prepare("
                    INSERT INTO image
                    (person_id, path_file, caption, avatar, visible)
                    VALUES
                    (?, ?, ?, ?, ? )");

        $stmt->bind_param("issii", $this->_personId, $this->_pathFile, $this->_caption, $this->_avatar, $this->_visible);
        $stmt->execute();
        $stmt->close();

    }


    public function resetAvatarToZero($personId)  // class Image
    {
        $stmt = $this->mysqli->prepare("
                                UPDATE image
                                SET
                                avatar = 0
                                WHERE person_id = ? ");

        $stmt->bind_param("i", $personId);
        $stmt->execute();
        $stmt->close();
    }


    public function updateImage($image)  // class Image
    {

        self::setImageParam($image);

        if($this->_avatar === 1) {
            self::resetAvatarToZero($this->_personId);
        }

        $stmt = $this->mysqli->prepare("
                                UPDATE image
                                SET
                                caption = ?,
                                avatar = ?
                                WHERE id = ? ");

        $stmt->bind_param("sii", $this->_caption, $this->_avatar,  $this->_id);
        $stmt->execute();
        $stmt->close();

    }


    public function getAllImage()  // class Image
    {
        $images = null;

        $stmt = $this->mysqli->prepare("
                    SELECT id, person_id, path_file, caption, avatar, visible
                    FROM image");

        $stmt->execute();
        $stmt->bind_result($id, $personId, $pathFile, $caption, $avatar, $visible);

        while($stmt->fetch()) {
            $images[] = ['id'=>$id, 'personId'=>$personId, 'pathFile'=>$pathFile, 'caption'=>$caption,
                         'avatar'=>$avatar, 'visible'=>$visible];
        }

        $stmt->close();

        return $images;
    }




    ////

    public function getImageById($id)  // class Image
    {
        $stmt = $this->mysqli->prepare("
					SELECT id, person_id, path_file, caption, avatar, visible
					FROM image
					WHERE id = ?");

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($id, $personId, $pathFile, $caption, $avatar, $visible);
        $stmt->fetch();
        $stmt->close();

//        $imageObj = new Image();

//        $imageObj->_personId = $personId;


        $image = ['id'=>$id, 'personId'=>$personId, 'pathFile'=>$pathFile, 'caption'=>$caption, 'avatar'=>$avatar,
                  'visible'=>$visible];

        return $image;
    }


    public function getAvatarImageByPersonId($personId)  // class Image
    {
        $stmt = $this->mysqli->prepare("
					SELECT id, path_file, caption, avatar, visible
					FROM image
					WHERE avatar = 1 AND person_id = ? LIMIT 1");

        $stmt->bind_param("i", $personId);
        $stmt->execute();
        $stmt->bind_result($id, $pathFile, $caption, $avatar, $visible);
        $stmt->fetch();
        $image = ['id'=>$id, 'pathFile'=>$pathFile, 'caption'=>$caption, 'avatar'=>$avatar, 'visible'=>$visible];
        $stmt->close();


        return $image;
    }


    public function getAllImageByPersonId($personId)
    {
        $images = null;

        $stmt = $this->mysqli->prepare("
                    SELECT id, person_id, path_file, caption, avatar, visible
                    FROM image
                    WHERE person_id = ?");

        $stmt->bind_param("i", $personId);
        $stmt->execute();
        $stmt->bind_result($id, $personId, $pathFile, $caption, $avatar, $visible);

        while($stmt->fetch()) {
            $images[] = ['id'=>$id, 'personId'=>$personId, 'pathFile'=>$pathFile, 'caption'=>$caption,
                'avatar'=>$avatar, 'visible'=>$visible];
        }

        $stmt->close();

        return $images;
    }


    public function getMaxImageByPersonId($personId)
    {
        $stmt = $this->mysqli->prepare("
					SELECT MAX(id)
					FROM image
					WHERE person_id = ?");

        $stmt->bind_param("i", $personId);
        $stmt->execute();
        $stmt->bind_result($id);
        $stmt->fetch();
        $stmt->close();

        return $id;
    }


    public function getMinImageByPersonId($personId)
    {
        $stmt = $this->mysqli->prepare("
					SELECT MIN(id)
					FROM image
					WHERE person_id = ?");

        $stmt->bind_param("i", $personId);
        $stmt->execute();
        $stmt->bind_result($id);
        $stmt->fetch();
        $stmt->close();

        return $id;
    }


    public function nextHigherImageId($personId, $id)
    {
        $stmt = $this->mysqli->prepare("
					SELECT id
					FROM image
					WHERE person_id = ?
					AND id > ?
					LIMIT 1");

        $stmt->bind_param("ii", $personId, $id);
        $stmt->execute();
        $stmt->store_result();
        $findRow = $stmt->num_rows;
        $stmt->bind_result($id);
        $stmt->fetch();
        $stmt->close();

        // echo "Next Higher Image: "  . $id . "<br />";

        if($findRow === 0) {
            $id = self::getMinImageByPersonId($personId);
        }
            return $id;
        }


    public function nextLowerImageId($personId, $id)
    {
        $stmt = $this->mysqli->prepare("
					SELECT id
					FROM image
					WHERE person_id = ?
					AND id < ?
					ORDER BY id
					DESC LIMIT 1");

        $stmt->bind_param("ii", $personId, $id);
        $stmt->execute();
        $stmt->store_result();
        $findRow = $stmt->num_rows;
        $stmt->bind_result($id);
        $stmt->fetch();
        $stmt->close();

        // echo "Next Lower Image: " . $id . "<br />";

        if($findRow === 0) {
            $id = self::getMaxImageByPersonId($personId);
        }
        return $id;
    }


    public function deleteImage($id)  // class Image
    {
        $stmt = $this->mysqli->prepare("
                    DELETE FROM image
                    WHERE id = ? ");

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

}


class ImagePDO extends db3
{
    private $_id, $_personId,  $_pathFile, $_caption, $_avatar, $_visible;
    public $previousImageId, $nextImageId;

    private function setImageParam(ImageController $image)
    {
        $this->_id = $image->getId();
        $this->_personId = $image->getPersonId();
        $this->_pathFile = $image->getPathFile();
        $this->_caption = $image->getCaption();
        $this->_avatar = $image->getAvatar();
        $this->_visible = $image->getVisible();
    }


    public function getId(){return $this->_id;}
    public function getPersonId(){return $this->_personId;}
    public function getCaption(){return $this->_caption;}
    public function getAvatar(){return $this->_avatar;}
    public function getVisible(){return $this->_visible;}


    public function resetAvatarToZero($personId)  // class Image
    {
        $stmt = $this->pdo->prepare("UPDATE image
                                    SET
                                    avatar = 0
                                    WHERE person_id = ?");

        $stmt->execute(array($personId));
    }


    public function addImage($image)  // class Image
    {
        self::setImageParam($image);

        if($this->_avatar === 1) {
            self::resetAvatarToZero($this->_personId);
        }

        $stmt = $this->pdo->prepare("
                                    INSERT INTO image
                                    (person_id, path_file, caption, avatar, visible)
                                    VALUES
                                    (?, ?, ?, ?, ? )");

        $stmt->execute([$this->_personId, $this->_pathFile, $this->_caption, $this->_avatar, $this->_visible]);
    }


    public function updateImage($image)  // class Image
    {

        self::setImageParam($image);

        if($this->_avatar === 1) {
            self::resetAvatarToZero($this->_personId);
        }

        $stmt = $this->pdo->prepare("
                                UPDATE image
                                SET
                                caption = ?,
                                avatar = ?
                                WHERE id = ? ");

        $stmt->execute([$this->_caption, $this->_avatar,  $this->_id]);
    }


    public function getImageById($id)  // class Image
    {
        $stmt = $this->pdo->prepare("
					SELECT id, person_id, path_file, caption, avatar, visible
					FROM image
					WHERE id = ?");

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_OBJ);
    }


    public function getPersonIdByImageId($imageId)
    {
        $stmt = $this->pdo->prepare("
					SELECT person_id
					FROM image
					WHERE id = ?");

        $stmt->execute([$imageId]);

        return $stmt->fetch(PDO::FETCH_OBJ)->person_id;
    }


    public function getMaxImageByPersonId($personId)
    {
        $stmt = $this->pdo->prepare("
					SELECT MAX(id) as id
					FROM image
					WHERE person_id = ?");

        $stmt->execute([$personId]);

        return $stmt->fetch(PDO::FETCH_OBJ)->id;
    }


    public function getMinImageByPersonId($personId)
    {
        $stmt = $this->pdo->prepare("
					SELECT MIN(id) as id
					FROM image
					WHERE person_id = ?");

        $stmt->execute([$personId]);

        return $stmt->fetch(PDO::FETCH_OBJ)->id;
    }


    public function getNextLowerImageId($id)
    {
        $personId = self::getPersonIdByImageId($id);

        $stmt = $this->pdo->prepare("
					SELECT id
					FROM image
					WHERE person_id = ?
					AND id < ?
					ORDER BY id
					DESC LIMIT 1");

        $stmt->execute([$personId, $id]);

        return $stmt->fetch(PDO::FETCH_OBJ)->id;
    }


    public function getNextHigherImageId($id)
    {
        $personId = self::getPersonIdByImageId($id);

        $stmt = $this->pdo->prepare("
					SELECT id
					FROM image
					WHERE person_id = ?
					AND id > ?
					ORDER BY id
					LIMIT 1");

        $stmt->execute([$personId, $id]);

        return $stmt->fetch(PDO::FETCH_OBJ)->id;
    }


    public function getPreviousImageId($id)
    {
        $nextLowerImageId = self::getnextLowerImageId($id);

        if(!$nextLowerImageId) {
            $nextLowerImageId = self::getMaxImageByPersonId(self::getPersonIdByImageId($id));
        }

        return $nextLowerImageId;
    }


    public function getNextImageId($id)
    {
        $nextHigherImageId = self::getNextHigherImageId($id);

        if(!$nextHigherImageId) {
            $nextHigherImageId = self::getMinImageByPersonId(self::getPersonIdByImageId($id));
        }

        return $nextHigherImageId;
    }


    public function setPreviousNextImageId($id)
    {
        $this->previousImageId = self::getPreviousImageId($id);
        $this->nextImageId = self::getNextImageId($id);
    }

}
