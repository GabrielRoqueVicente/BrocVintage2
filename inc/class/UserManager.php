<?php
// User Manager
class UserManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function add(User $user)
    {
        $q = $this->_db->prepare('INSERT INTO users(surname, name, email, password, international_code, phone, title, city, post_code, address, subscription_date) 
                                  VALUES(:surname, :name, :email, :password, :international_code, :phone, :title, :city, :post_code, :address, NOW())');

        $q->bindValue(':surname', $user->surname());
        $q->bindValue(':name', $user->name());
        $q->bindValue(':email', $user->email());
        $q->bindValue(':password', $user->password());
        $q->bindValue(':international_code', $user->internationalCode());
        $q->bindValue(':phone', $user->phone());
        $q->bindValue(':title', $user->title());
        $q->bindValue(':city', $user->city());
        $q->bindValue(':post_code', $user->postCode());
        $q->bindValue(':address', $user->address());

        $q->execute();
    }

    public function delete(User $user)
    {
        $this->_db->exec('DELETE FROM users WHERE id_user = ' . $user->idUser());
    }

    public function get($idUser)
    {
        $idUser = (int) $idUser;

        $q = $this->_db->query('SELECT id_user, surname, name, email, password, international_code, phone, title, city, post_code, address, status, subscription_date FROM users WHERE id_user = ' .$idUser);
        $datas = $q->fetch(PDO::FETCH_ASSOC);

        return new User($datas);
    }

    public function getList()
    {
        $idUsers = [];
        $q = $this->_db->query('SELECT id_user, surname, name, email, password, international_code, phone, title, city, post_code, address, status, subscription_date FROM users');

        while ($datas = $q->fetch(PDO::FETCH_ASSOC))
        {
            $idUsers[] = new User($datas);
        }

        return $idUsers;
    }

    public function getDateList() //Getting list ordered by date
    {
        $idUsers = [];
        $q = $this->_db->query('SELECT id_user, surname, name, email, password, international_code, phone, title, city, post_code, address, status, subscription_date FROM users ORDER BY entry_date DESC');

        while ($datas = $q->fetch(PDO::FETCH_ASSOC))
        {
            $idUsers[] = new User($datas);
        }

        return $idUsers;
    }

    public function update(User $user)
    {
        $q = $this->_db->prepare('UPDATE users SET surname = :surname, name = :name, email = :email, password = :password, international_code = :international_code, phone = :phone, title = :title, city = :city, post_code = :post_code, address = :address, status = :status, subscription_date = :subscription_date WHERE id_user = :id_user');

        $q->bindValue(':id_user', $user->idUser(), PDO::PARAM_INT);
        $q->bindValue(':surname', $user->surname());
        $q->bindValue(':name', $user->name());
        $q->bindValue(':email', $user->email());
        $q->bindValue(':password', $user->password());
        $q->bindValue(':international_code', $user->internationalCode());
        $q->bindValue(':phone', $user->phone());
        $q->bindValue(':title', $user->title());
        $q->bindValue(':city', $user->city());
        $q->bindValue(':post_code', $user->postCode());
        $q->bindValue(':address', $user->address());
        $q->bindValue(':status', $user->status());
        $q->bindValue(':subscription_date', $user->subscriptionDate());


        $q->execute();
    }


    public function getEmail($email)
    {
        $q = $this->_db->query("SELECT * FROM users WHERE email = '$email'");
        $data = $q->fetch(PDO::FETCH_ASSOC);

        return ($data);
    }




    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}