<?php
// Picture Manager
class PictureManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function addPicture(Picture $picture)
    {
        $q = $this->_db->prepare('INSERT INTO pictures(pic_name, pic_size, pic_alt, pic_final_name, pic_file_date, id_product) 
                                  VALUES(:pic_name, :pic_size, :pic_alt, :pic_final_name, NOW(), :id_product)');

        $q->bindValue(':pic_name', $picture->picName());
        $q->bindValue(':pic_size', $picture->picSize(), PDO::PARAM_INT);
        $q->bindValue(':pic_alt', $picture->picAlt());
        $q->bindValue(':pic_final_name', $picture->picFinalName());
        $q->bindValue(':id_product', $picture->idProduct(), PDO::PARAM_INT);

        $q->execute();
    }

    public function deletePicture(Picture $picture)
    {
        $this->_db->exec('DELETE FROM pictures WHERE id_picture = ' .$picture->id_picture());
    }

    public function getPicture($idPicture)
    {
        $idPicture = (int) $idPicture;

        $q = $this->_db->query('SELECT id_picture, pic_name, pic_size, pic_alt, pic_final_name, pic_file_date, id_product FROM pictures WHERE id_picture = ' .$idPicture);
        $datas = $q->fetch(PDO::FETCH_ASSOC);

        return $datas;
    }

    public function getListPicture()
    {
        $pictures = [];

        $q = $this->_db->query('SELECT id_picture, pic_name, pic_size, pic_alt, pic_final_name, pic_file_date, id_product FROM pictures');

        while ($datas = $q->fetch(PDO::FETCH_ASSOC))
        {
            $pictures[] = new Picture($datas, $alt=0);
        }

        return $pictures;
    }

    public function update(Picture $picture)
    {
        $q = $this->_db->prepare('UPDATE pictures SET id_picture = :id_picture, pic_name = :pic_name, pic_size = :pic_size, pic_alt = :pic_alt, pic_final_name = :pic_final_name, pic_file_date = :pic_file_date, id_product = :id_product FROM pictures WHERE id_picture = :id_picture');

        $q->bindValue(':id_picture', $picture->id_picture(), PDO::PARAM_INT);
        $q->bindValue(':pic_name', $picture->pic_name());
        $q->bindValue(':pic_size', $picture->pic_size(), PDO::PARAM_INT);
        $q->bindValue(':pic_alt', $picture->pic_alt());
        $q->bindValue(':pic_final_name', $picture->pic_final_name());
        $q->bindValue(':pic_file_date', $picture->pic_file_date());
        $q->bindValue(':id_product', $picture->id_product(), PDO::PARAM_INT);

        $q->execute();
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}