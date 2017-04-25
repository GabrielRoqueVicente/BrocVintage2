<?php
//Class Nav
class Nav
{
    //===ATTRIBUTES===

    private $_idSubType;
    private $_subTypeName;
    private $_idProductType;

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

    public function setId($idSubType)
    {
        $idSubType = (int) $idSubType;

        if ($idSubType > 0)
        {
            $this->_id = $idSubType;
        }
    }

    public function setSubTypeName($subTypeName)
    {
        if (is_string($subTypeName) && strlen($subTypeName) <= 40)
        {
            $this->_autor = $subTypeName;
        }
    }

    public function setIdProductType($idProductType)
    {
        $idProductType = (int) $idProductType;

        if ($idProductType > 0)
        {
            $this->_id = $idProductType;
        }
    }

    //===GETTERS===

    public function idSubType()
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
