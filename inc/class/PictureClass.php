<?php
//Class Picture
class Picture
{
    //===ATTRIBUTES===

    private $_idPicture;
    private $_picName;
    private $_picSize;
    private $_picAlt;
    private $_picFinalName;
    private $_picFileDate;
    private $_idProduct;
    private $_idArticle;

    //===PROPERTIES===

    public function __construct(array $datas, $alt)
    {
        $this->hydrate($datas, $alt);
    }

    //class hydrate

    public function hydrate(array $datas, $alt = 0)
    {
        if($alt !== 0) //Hydrate from form
        {
            $this->setPic_name($datas['name']);
            $this->setPic_size($datas['size']);
            $this->setPic_Alt($alt);
        }else{ //Dynamic Hydrate
            foreach ($datas as $key => $value)
            {
                $method = 'set'.ucfirst($key);

                if (method_exists($this, $method)) {
                    $this->$method($value);

                }

            }
        }
    }

    //===SETTERS===

    public function setId_picture($idPicture)
    {
        $idPicture = (int) $idPicture;

        if ($idPicture > 0)
        {
            $this->_idPicture = $idPicture;
        }
    }

    public function setPic_name($picName)
    {
        if (is_string($picName) && strlen($picName) <= 50)
        {
            $this->_picName = $picName;
        }
    }

    public function setPic_Size($picSize)
    {
        $picSize = (int) $picSize;

        if ($picSize > 0)
        {
            $this->_picSize = $picSize;
        }
    }

    public function setPic_alt($picAlt)
    {
        if (is_string($picAlt) && strlen($picAlt) <= 255)
        {
            $this->_picAlt = $picAlt;
        }
    }

    public function setPicfinalName($picture, $idProduct) //DB version
    {
        if (preg_match('#jpg$|jpeg$|gif$|png$#', $picture['type']))
        {
            move_uploaded_file($picture['tmp_name'], DOCUMENT_ROOT . 'inc/img/' . $idProduct .$picture['name']);
            $this->_picFinalName = 'img/' . $idProduct. $picture['name'];
        }
    }

    public function setPic_final_name($picFinalName) //Calling DB version
    {
       $this->_picFinalName = $picFinalName;
    }

    public function setPic_file_date($picFileDate)
    {
        $this->_picFileDate = $picFileDate;
    }

    public function setId_product($idProduct)
    {
        $idProduct = (int) $idProduct;

        if ($idProduct > 0)
        {
            $this->_idProduct = $idProduct;
        }
    }

    public function setId_article($idArticle)
    {
        $idArticle = (int) $idArticle;

        if ($idArticle > 0)
        {
            $this->_idArticle = $idArticle;
        }
    }

    public function getPrimary ($idProduct)
    {
        $q = $this->_db->query('SELECT MIN(id_picture) FROM pictures WHERE id_product = $idProduct');
        $primaryPicture = $q-fetch(PDO::FETCH_ASSOC);
        $primaryPicture = (int) $primaryPicture['MIN(id_picture)'];
        return $primaryPicture;
    }

    //===GETTERS===

    public function idPicture()
    {
        return $this->_idPicture;
    }

    public function picName()
    {
        return $this->_picName;
    }

    public function picSize()
    {
        return $this->_picSize;
    }

    public function picAlt()
    {
        return $this->_picAlt;
    }

    public function picFinalName()
    {
        return $this->_picFinalName;
    }

    public function pic_final_name()
    {
        return $this->_picFinalName;
    }

    public function picFileDate()
    {
        return $this->_picFileDate;
    }

    public function idProduct()
    {
        return $this->_idProduct;
    }

    public function idArticle()
    {
        return $this->_idArticle;
    }
}