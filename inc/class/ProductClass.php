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

    //===PROPERTIES===

    public function __construct(array $datas)
    {
        $this->hydrate($datas);
    }

    //Dynamic class hydrate
    public function hydrate(array $datas)
    {
        foreach ($datas as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);

            }
        }
    }

    //===SETTERS===

    public function setId_Product($idProduct)
    {
        $idProduct = (int)$idProduct;

        if ($idProduct > 0) {
            $this->_idProduct = $idProduct;
        }
    }

    public function setAutor($autor)
    {
        if (is_string($autor) && strlen($autor) <= 50) {
            $this->_autor = $autor;
        }
    }

    public function setYear($year)
    {
        $year = (int)$year;
        if ($year >= 1000 && $year <= 3000) {
            $this->_year = $year;
        }
    }

    public function setEntry_Date($entryDate)
    {
        $this->_entryDate = $entryDate;
    }

    public function setDisponibility($disponibility)
    {
        if ($disponibility == 'dis' || $disponibility == 'res' || $disponibility == 'ind') {
            $this->_disponibility = $disponibility;
        }
    }

    public function setName($name)
    {
        if (is_string($name) && strlen($name) <= 255) {
            $this->_name = $name;
        }
    }

    public function setDescription($description)
    {
        if (is_string($description)) {
            $this->_description = $description;
        }

    }

    public function setPrice($price)
    {
        $price = (float)$price;
        if (is_float($price) && $price >= 0 && $price <= 9999) {
            $this->_price = $price;
        }
    }

    public function setPromotion($promotion)
    {
        if (is_null($promotion)) {
            $this->_promotion = 0;
        } elseif ($promotion == 1) {
            $this->_promotion = 1;
        }
    }

    public function setProductType($productType)
    {
        $productType = (int)$productType;

        if (is_int($productType) && $productType >= 1 && $productType <= 100) {
            $this->_productType = $productType;
        }
    }

    public function setId_Product_Type($productType)
    {
        $productType = (int)$productType;

        if (is_int($productType) && $productType >= 1 && $productType <= 100) {
            $this->_productType = $productType;
        }
    }

    public function setId_Sub_Type($productSubType)
    {
        $productSubType = (int)$productSubType;

        if (is_int($productSubType) && $productSubType >= 1 && $productSubType <= 100) {
            $this->_productSubType = $productSubType;
        }
    }

    public function setProductSubType($productSubType)
    {
        $productSubType = (int)$productSubType;

        if (is_int($productSubType) && $productSubType >= 1 && $productSubType <= 100) {
            $this->_productSubType = $productSubType;
        }
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

    public function subType()
    {
        return $this->_productSubType;
    }
}