<?php
//Class ProductType
class Nav
{
    //===ATTRIBUTES===

    private $_idProductType;
    private $_typeName;

    //===PROPERTIES===

    //Dynamic class hydrate
    public function hydrate(array $datas)
    {
        foreach ($datas as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

    //===SETTERS===

    public function setIdProductType($idProductType)
    {
        $idProductType = (int) $idProductType;

        if ($idProductType > 0)
        {
            $this->_id = $idProductType;
        }
    }

    public function setTypeName($typeName)
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