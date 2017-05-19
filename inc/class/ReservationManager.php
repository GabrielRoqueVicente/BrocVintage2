<?php
// Reservation Manager
class ReservationManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function add(Reservation $reservation)
    {
        $q = $this->_db->prepare('INSERT INTO reservations(id_user, id_dispo, id_product) 
                                  VALUES(:id_user, :id_dispo, :id_product)');

        $q->bindValue(':id_user', $reservation->idUser(), PDO::PARAM_INT);
        $q->bindValue(':id_dispo', $reservation->idDispo(), PDO::PARAM_INT);
        $q->bindValue(':id_product', $reservation->idProduct(), PDO::PARAM_INT);

        $q->execute();
    }

    public function delete(Reservation $reservation)
    {
        $this->_db->exec("DELETE FROM reservations WHERE  id_reservation = " .$reservation->id_picture());
    }

    public function get($idReservation)
    {
        $idReservation = (int) $idReservation;

        $q = $this->_db->query('SELECT id_reservation, id_user, id_dispo, id_product FROM reservations WHERE id_reservation = ' .$idReservation);
        $datas = $q->fetch(PDO::FETCH_ASSOC);

        return new Reservation($datas);
    }

    public function getDate($idDispo)
    {
        $q = $this->_db->query("SELECT id_dispo FROM reservations WHERE id_dispo ='$idDispo'");
        $data = $q->fetch(PDO::FETCH_ASSOC);

        return ($data);
    }

    public function getList()
    {
        $idReservations = [];
        $q = $this->_db->query('SELECT id_reservation, id_user, id_dispo, id_product FROM reservations');

        while ($datas = $q->fetch(PDO::FETCH_ASSOC))
        {
            $idReservations[] = new Reservation ($datas);
        }

        return $idReservations;
    }

    public function getUserList($idUser)
    {
        $idReservations = [];
        $q = $this->_db->query('SELECT id_reservation, id_user, id_dispo, id_product FROM reservations WHERE id_user =' .$idUser);

        while ($datas = $q->fetch(PDO::FETCH_ASSOC))
        {
            $idReservations[] = new Reservation ($datas);
        }

        return $idReservations;
    }

    public function getCartList($idUser)
    {
        $idReservations = [];
        $q = $this->_db->query('SELECT id_reservation, id_user, id_dispo, id_product FROM reservations WHERE  id_dispo IS NULL AND id_user =' .$idUser);

        while ($datas = $q->fetch(PDO::FETCH_ASSOC))
        {
            $idReservations[] = new Reservation ($datas);
        }

        return $idReservations;
    }

    public function getProduct($idProduct)
    {
        $idProduct = (int) $idProduct;

        $q = $this->_db->query("SELECT id_reservation, id_user, id_dispo, id_product FROM reservations WHERE id_product = '$idProduct'");
        $datas = $q->fetch(PDO::FETCH_ASSOC);

        return $datas;
    }

    public function update($reservation)
    {
        $q = $this->_db->prepare('UPDATE reservations SET id_reservation = :id_reservation, id_user = :id_user, id_dispo = :id_dispo, id_product = :id_product  WHERE id_reservation = :id_reservation');

        $q->bindValue(':id_reservation', $reservation->idReservation(), PDO::PARAM_INT);
        $q->bindValue(':id_user', $reservation->idUser(), PDO::PARAM_INT);
        $q->bindValue(':id_dispo', $reservation->idDispo(), PDO::PARAM_INT);
        $q->bindValue(':id_product', $reservation->idProduct(), PDO::PARAM_INT);

        $q->execute();


        $q->execute();
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}