<?php
//Class Dispo
class Dispo
{
    //===ATTRIBUTES===

    private $_idDispo;
    private $_dispoDate;
    private $_meetingDate;
    private $_idUser;

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

    public function setId_dispo ($idDispo)
    {
        $idDispo = (int)$idDispo;

        if ($idDispo > 0)
        {
            $this->_idDispo= $idDispo;
        }
    }

    public function setDispo_Date($dispoDate)
    {
        $this->_dispoDate = $dispoDate;
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

    //===GETTERS===

    public function idDispo()
    {
        return $this->_idDispo;
    }

    public function dispoDate()
    {
        return $this->_dispoDate;
    }

    public function meetingDate()
    {
        return $this->_meetingDate;
    }

    public function idUser()
    {
        return $this->_idUser;
    }
}