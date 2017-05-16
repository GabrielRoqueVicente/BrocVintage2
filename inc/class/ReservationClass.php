<?php
//Class Reservation
class Reservation
{
    //===ATTRIBUTES===

    private $_idReservation;
    private $_idUser;
    private $_idDispo;
    private $_idProduct;

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
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method))
            {
                $this->$method($value);

            }
        }
    }

    //===SETTERS===

    public function setId_reservation ($idReservation)
    {
        $idReservation = (int)$idReservation;

        if ($idReservation > 0)
        {
            $this->_idReservation = $idReservation;
        }
    }

    public function setId_user($idUser)
    {
        $idUser = (int)$idUser;

        if ($idUser > 0)
        {
            $this->_idUser = $idUser;
        }
    }

    public function setId_dispo($idDispo)
    {
        $idDispo = (int)$idDispo;

        if ($idDispo > 0)
        {
            $this->_idDispo = $idDispo;
        }
    }

    public function setId_product($idProduct)
    {
        $idProduct = (int)$idProduct;

        if ($idProduct > 0)
        {
            $this->_idProduct = $idProduct;
        }
    }

    //===GETTERS===

    public function idReservation()
    {
        return $this->_idReservation;
    }

    public function idUser()
    {
        return $this->_idUser;
    }

    public function idDispo()
    {
        return $this->_idDispo;
    }

    public function idProduct()
    {
        return $this->_idProduct;
    }
}