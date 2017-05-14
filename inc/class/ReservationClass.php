<?php
//Class Reservation
class Reservation
{
    //===ATTRIBUTES===

    private $_idReservation;
    private $_reservationDate;
    private $_meetingDate;
    private $_idUser;
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

    public function setReservation_Date($reservationDate)
    {
        $this->_reservationDate = $reservationDate;
    }

    public function setMeeting_Date($meetingDate)
    {
        $this->_meetingDate = $meetingDate;
    }

    public function setId_user($idUser)
    {
        $idUser = (int)$idUser;

        if ($idUser > 0)
        {
            $this->_idUser = $idUser;
        }
    }


    public function setId_product($IdProduct)
    {
        $IdProduct = (int)$IdProduct;

        if ($IdProduct > 0)
        {
            $this->_IdProduct = $IdProduct;
        }
    }

    //===GETTERS===

    public function idReservation()
    {
        return $this->_idReservation;
    }

    public function reservationDate()
    {
        return $this->_reservationDate;
    }

    public function meetingDate()
    {
        return $this->_meetingDate;
    }

    public function idUser()
    {
        return $this->_idUser;
    }

    public function idProduct()
    {
        return $this->_idProduct;
    }
}