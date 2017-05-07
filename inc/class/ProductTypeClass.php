<?php
//Class Product Type
class ProductType
{
    //===ATTRIBUTES===

    private $_idProductType;
    private $_typeName;

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
        }
    }

    //===SETTERS===

    public function setIdProductType($idProductType) // DB IN
    {
        $idProductType = (int) $idProductType;

        if ($idProductType > 0)
        {
            $this->_idProductType = $idProductType;
        }
    }

    public function setId_product_type($idProductType) // DB OUT
    {
        $idProductType = (int) $idProductType;

        if ($idProductType > 0)
        {
            $this->_idProductType = $idProductType;
        }
    }

    public function setName($typeName)
    {
        if (is_string($typeName) && strlen($typeName) <= 40)
        {
            $this->_typeName = $typeName;
        }
    }

    //===GETTERS===

    public function idProductType()
    {
        return $this->_idProductType;
    }

    public function typeName()
    {
        return $this->_typeName;
    }
}