<?php
//Class User
class User
{
    //===ATTRIBUTES===

    private $_idUser;
    private $_surname;
    private $_name;
    private $_email;
    private $_password;
    private $_internationalCode;
    private $_phone;
    private $_title;
    private $_city;
    private $_postCode;
    private $_address;
    private $_status;
    private $_subscriptionDate;

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

    public function setId_user($idUser)
    {
        $idUser = (int)$idUser;

        if ($idUser > 0)
        {
            $this->_idUser = $idUser;
        }
    }

    public function setSurname($surname)
    {
        if (is_string($surname) && strlen($surname) <= 20)
        {
            $surname=htmlspecialchars($surname);
            $this->_surname = $surname;
        }
    }

    public function setName($name)
    {
        if (is_string($name) && strlen($name) <= 20)
        {
            $name=htmlspecialchars($name);
            $this->_name = $name;
        }
    }

    public function setEmail($email)
    {
        if (is_string($email) && strlen($email) <= 40)
        {
            $email=htmlspecialchars($email);
            $this->_email = $email;
        }
    }

    public function setPassword($password)
    {
        if (is_string($password) && strlen($password) <= 64)
        {
            $this->_password = $password;
        }
    }

    public function setInternational_Code($internationalCode)
    {
        if (is_string($internationalCode) && strlen($internationalCode) <= 3) {
            $this->_internationalCode = $internationalCode;
        }
    }

    public function setPhone($phone)
    {
        if (is_string($phone) && strlen($phone) <= 11)
        {
            $this->_phone = $phone;
        }
    }

    public function setTitle($title)
    {
        if ($title == 'H' || $title == 'F')
        {
            $this->_title = $title;
        }
    }

    public function setCity($city)
    {
        if (is_string($city) && strlen($city) <= 20)
        {
            $city=htmlspecialchars($city);
            $this->_city = $city;
        }
    }

    public function setPost_Code($postCode)
    {
        if (is_string($postCode) && strlen($postCode) <= 5)
        {
            $this->_postCode = $postCode;
        }
    }

    public function setAddress($address)
    {
        if (is_string($address))
        {
            $address=htmlspecialchars($address);
            $this->_address = $address;
        }

    }

    public function setStatus($status)
    {
        if ($status == 'user' || $status == 'admin')
        {
            $this->_status = $status;
        }
    }

    public function setSubscription_Date($subscriptionDate)
    {
        $this->_subscriptionDate = $subscriptionDate;
    }

    //===GETTERS===

    public function idUser()
    {
        return $this->_idUser;
    }

    public function surname()
    {
        return $this->_surname;
    }

    public function name()
    {
        return $this->_name;
    }

    public function email()
    {
        return $this->_email;
    }
    public function password()
    {
        return $this->_password;
    }

    public function internationalCode()
    {
        return $this->_internationalCode;
    }

    public function phone()
    {
        return $this->_phone;
    }

    public function title()
    {
        return $this->_title;
    }

    public function city()
    {
        return $this->_city;
    }

    public function postCode()
    {
        return $this->_postCode;
    }

    public function address()
    {
        return $this->_address;
    }

    public function status()
    {
        return $this->_status;
    }

    public function subscriptionDate()
    {
        return $this->_subscriptionDate;
    }

}