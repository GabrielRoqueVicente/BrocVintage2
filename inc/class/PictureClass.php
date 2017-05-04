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

    //===PROPERTIES===

    public function __construct(array $datas, $alt)
    {
        $this->hydrate($datas, $alt);
    }

    //Dynamic class hydrate
    public function hydrate(array $datas, $alt)
    {
        $this->setPicName($datas['name']);
        $this->setPicSize($datas['size']);
        $this->setPicFinalName($datas);
        $this->setPicAlt($alt);
    }

    //===SETTERS===

    public function setIdPicture($idPicture)
    {
        $idPicture = (int) $idPicture;

        if ($idPicture > 0)
        {
            $this->_idPicture = $idPicture;
        }
    }

    public function setPicName($picName)
    {
        if (is_string($picName) && strlen($picName) <= 20)
        {
            $this->_picName = $picName;
        }
    }

    public function setPicSize($picSize)
    {
        $picSize = (int) $picSize;

        if ($picSize > 0)
        {
            $this->_picSize = $picSize;
        }
    }

    public function setPicAlt($picAlt)
    {
        if (is_string($picAlt) && strlen($picAlt) <= 255)
        {
            $this->_picAlt = $picAlt;
        }
    }

    public function setPicFinalName($picFinalName)
    {
        if (preg_match('#jpg$|jpeg$|gif$|png$#', $picFinalName['type']))
        {
            move_uploaded_file($picFinalName['tmp_name'], DOCUMENT_ROOT . 'inc/img/' . basename($picFinalName['name']));
            $this->_picFinalName = DOCUMENT_ROOT . 'inc/img/' . basename($picFinalName['name']);
        }
    }

    public function setPicFileDate($picFileDate)
    {
        if (is_date($picFileDate))
        {
            $this->_picFileDate = $picFileDate;
        }
    }

    public function setIdProduct($idProduct)
    {
        $idPicture = (int) $idProduct;

        if ($idProduct > 0)
        {
            $this->_idProduct = $idProduct;
        }
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

    public function picFileDate()
    {
        return $this->_picFileDate;
    }

    public function idProduct()
    {
        return $this->_idProduct;
    }
}