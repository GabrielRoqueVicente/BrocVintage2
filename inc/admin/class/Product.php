<?php
//Class Product
class Product
{
    //===ATTRIBUTES===

    private $_idProduct;
    private $_autor;
    private $_year;
    private $_disponibility;
    private $_entryDate;
    private $_name;
    private $_description;
    private $_price;
    private $_promotion;
    private $_productType;
    private $_productSubType;
    private $_primaryPicture;
    private $_picture1;
    private $_picture2;
    private $_picture3;

    //===PROPERTIES===

    //===SETTERS===

    public function setAutor($autor)
    {
        if (!is_string($autor))
        {
            trigger_error('L\'auteur doit être une chaîne de charactères.', E_USER_WARNING);
            return;
        }

        if (strlen($autor) > 40)
        {
            trigger_error('L\'auteur ne peux contenir plus de 40 charactères.', E_USER_WARNING);
            return;
        }

        $this->_autor = $autor;
    }

    public function setYear($year)
    {
        if(!is_date($year))
        {
            trigger_error('Format de date incorrecte.', E_USER_WARNING);
            return;
        }

        $this->_year = $year;
    }

    public function setDisponibilty($disponibility)
    {
        if($disponibility !== ('dis' || 'res' || 'ind'))
        {
            trigger_error('Format de disponibilité incorrecte.', E_USER_WARNING);
            return;
        }

        $this->_disponibility = $disponibility;
    }

    public function setName($name)
    {
        if (!is_string($name))
        {
            trigger_error('Le nom de l\'objet doit être une chaîne de charactères.', E_USER_WARNING);
            return;
        }

        if (strlen($name) > 40)
        {
            trigger_error('Le nom de l\'objet ne peux contenir plus de 40 charactères.', E_USER_WARNING);
            return;
        }

        $this->_autor = $name;
    }

    public function setDescription($description)
    {
        if(!is_string($description))
        {
            trigger_error('La description doit être une chaîne de charactères.', E_USER_WARNING);
            return;
        }

        $this->_description = $description;
    }

    public function setPrice($price)
    {
        if(!is_float($price))
        {
            trigger_error('Le prix doit être une valeur.', E_USER_WARNING);
            return;
        }

        $this->_price = $price;
    }

    public function setPromotion($promotion)
    {
        if(!is_bool($promotion))
        {
            trigger_error('Promotion doit être un booléen.', E_USER_WARNING);
            return;
        }

        $this->_promotion = $promotion;
    }

    public function setProductType($productType)
    {
        if(!is_int($productType))
        {
            trigger_error('Type de produit incorrecte.', E_USER_WARNING);
            return;
        }

        if($productType > 100)
        {
            trigger_error('La valeur du type de produit ne dois pas depasser 100.', E_USER_WARNING);
            return;
        }

        $this->_productType = $productType;
    }

    public function setProductSubType($productSubType)
    {
        if(!is_int($productSubType))
        {
            trigger_error('Type de sous-produit incorrecte.', E_USER_WARNING);
            return;
        }

        if($productSubType > 100)
        {
            trigger_error('La valeur du sous-type de produit ne dois pas depasser 100.', E_USER_WARNING);
            return;
        }

        $this->_productSubType = $productSubType;
    }

    /* ================================================================================================================
    ===================================================================================================================
    =================================/!\ DEFINIR LES CONTROLLES D'ENVOIE DE FICHIER /!\================================
    ===================================================================================================================
    ===================================================================================================================*/


    public function setPrimaryPicture($primaryPicture)
    {
        /*if()
        {
            trigger_error('', E_USER_WARNING);
            return;
        }*/

        $this->_primaryPicture = $primaryPicture;
    }

    public function setPicture1($picture1)
    {
        /*if()
        {
            trigger_error('', E_USER_WARNING);
            return;
        }*/

        $this->_picture1 = $picture1;
    }

    public function setPicture2($picture2)
    {
        /*if()
        {
            trigger_error('', E_USER_WARNING);
            return;
        }*/

        $this->_picture2 = $picture2;
    }

    public function setPicture3($picture3)
    {
        /*if()
        {
            trigger_error('', E_USER_WARNING);
            return;
        }*/

        $this->_picture3 = $picture3;
    }

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

    public function disponibility()
    {
        return $this->_disponibility;
    }

    public function entryDate()
    {
        return $this->_entryDate;
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