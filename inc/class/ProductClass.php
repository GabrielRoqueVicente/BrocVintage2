<?php
//Class Product
class Product
{
    //===ATTRIBUTES===

    private $_idProduct;
    private $_autor;
    private $_year;
    private $_entryDate;
    private $_disponibility;
    private $_name;
    private $_description;
    private $_price;
    private $_promotion;
    private $_productType;
    private $_productSubType;
    /*private $_primaryPicture;
    private $_picture1;
    private $_picture2;
    private $_picture3;*/

    //===PROPERTIES===

    public function __construct(array $datas)
    {
        $this->hydrate($datas);
    }

    //Dynamic class hydrate
    public function hydrate(array $datas)
    {
        foreach ($datas as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);

            }
            /*$this->setPrimaryPicture($this->_idProduct);
            $this->setPicture1();
            $this->setPicture2();
            $this->setPicture3();*/
        }
    }

    //===SETTERS===

    public function setId_Product($idProduct)
    {
        $idProduct = (int) $idProduct;

        if ($idProduct > 0)
        {
            $this->_idProduct = $idProduct;
        }
    }

    public function setAutor($autor)
    {
        if (is_string($autor) && strlen($autor) <= 50)
        {
            $this->_autor = $autor;
        }
    }

    public function setYear($year)
    {
        $year = (int) $year;
        if($year >= 1000 && $year <= 3000)
        {
            $this->_year = $year;
        }
    }

    public function setEntry_Date($entryDate)
    {
        //if(is_date($EntryDate))
        //{
            $this->_entryDate = $entryDate;
        //}
    }

    public function setDisponibility($disponibility)
    {
        if($disponibility == 'dis'|| $disponibility == 'res' || $disponibility == 'ind')
        {
            $this->_disponibility = $disponibility;
        }
    }

    public function setName($name)
    {
        if (is_string($name) && strlen($name) <= 255)
        {
            $this->_name = $name;
        }
    }

    public function setDescription($description)
    {
        if (is_string($description))
        {
            $this->_description = $description;
        }

    }

    public function setPrice($price)
    {
        $price = (float) $price;
        if(is_float($price) && $price >= 0 && $price <= 9999)
        {
            $this->_price = $price;
        }
    }

    public function setPromotion($promotion)
    {
        if(is_null($promotion))
        {
            $this->_promotion = 0;
        }elseif($promotion == 1)
        {
            $this->_promotion = 1;
        }
    }

    public function setId_Product_Type($productType)
    {
        $productType = (int) $productType;

        if (is_int($productType) && $productType >= 1 && $productType <= 100)
        {
            $this->_productType = $productType;
        }
    }

    public function setId_Sub_Type($productSubType)
    {
        $productSubType = (int) $productSubType;

        if (is_int($productSubType) && $productSubType >= 1 && $productSubType <= 100)
        {
            $this->_productSubType = $productSubType;
        }
    }

    /* ================================================================================================================
    ===================================================================================================================
    =================================/!\ DEFINIR LES CONTROLLES D'ENVOIE DE FICHIER /!\================================
    ===================================================================================================================
    ===================================================================================================================*/


   /* public function setPrimaryPicture()
    {
        $primaryPicture = productManager->getPrimary($this->_idProduct);
        $this->_primaryPicture = $primaryPicture;
    }

    public function setPicture1($picture1)
    {
        $this->_picture1 = $picture1;
    }

    public function setPicture2($picture2)
    {
        $this->_picture2 = $picture2;
    }

    public function setPicture3($picture3)
    {
        $this->_picture3 = $picture3;
    }*/

    //===GETTERS===

    public function idProduct()
    {
        return $this->_idProduct;
    }

    public function autor()
    {
        return $this->_autor;
    }

    public function year()
    {
        return $this->_year;
    }

    public function entryDate()
    {
        return $this->_entryDate;
    }

    public function disponibility()
    {
        return $this->_disponibility;
    }

    public function name()
    {
        return $this->_name;
    }

    public function description()
    {
        return $this->_description;
    }

    public function price()
    {
        return $this->_price;
    }

    public function promotion()
    {
        return $this->_promotion;
    }

    public function productType()
    {
        return $this->_productType;
    }

    public function productSubType()
    {
        return $this->_productSubType;
    }

    public function primaryPicture()
    {
        return $this->_primaryPicture;
    }

    public function picture1()
    {
        return $this->_picture1;
    }

    public function picture2()
    {
        return $this->_picture2;
    }

    public function picture3()
    {
        return $this->_picture3;
    }
}