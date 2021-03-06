<?php
//Class Sub Type
class SubType
{
    //===ATTRIBUTES===

    private $_idSubType;
    private $_subTypeName;
    private $_idProductType;

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

    public function setId_Sub_Type($idSubType)
    {
        $idSubType = (int)$idSubType;

        if ($idSubType > 0) {
            $this->_idSubType = $idSubType;
        }
    }

    public function setIdSubType($idSubType)
    {
        $idSubType = (int)$idSubType;

        if ($idSubType > 0) {
            $this->_idSubType = $idSubType;
        }
    }

    public function setName($subTypeName)
    {
        if (is_string($subTypeName) && strlen($subTypeName) <= 40) {
            $this->_subTypeName = $subTypeName;
        }
    }

    public function setId_Product_Type($idProductType)
    {
        $idProductType = (int)$idProductType;

        if ($idProductType > 0) {
            $this->_idProductType = $idProductType;
        }
    }

    public function setIdProductType($idProductType)
    {
        $idProductType = (int)$idProductType;

        if ($idProductType > 0) {
            $this->_idProductType = $idProductType;
        }
    }

    //===GETTERS===

    public function idSubType()
    {
        return $this->_idSubType;
    }

    public function id_Sub_Type()
    {
        return $this->_idSubType;
    }

    public function subTypeName()
    {
        return $this->_subTypeName;
    }

    public function idProductType()
    {
        return $this->_idProductType;
    }
}