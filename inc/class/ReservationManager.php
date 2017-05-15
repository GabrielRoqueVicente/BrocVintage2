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
        $q = $this->_db->prepare('INSERT INTO reservations(reservation_date, meeting_date, id_user, id_product) 
                                  VALUES(NOW(), :meeting_date, :id_user, :id_product)');

        $q->bindValue(':meeting_date', $reservation->meetingDate());
        $q->bindValue(':id_user', $reservation->idUser(), PDO::PARAM_INT);
        $q->bindValue(':id_product', $reservation->idProduct(), PDO::PARAM_INT);

        $q->execute();
    }

    public function delete(Reservation $reservation)
    {
        $this->_db->exec('DELETE FROM reservations WHERE id_reservation = ' . $reservation->idReservation());
    }

    public function get($idReservation)
    {
        $idReservation = (int) $idReservation;

        $q = $this->_db->query('SELECT id_reservation, reservation_date, meeting_date, id_user, id_product FROM reservations WHERE id_reservation = ' .$idReservation);
        $datas = $q->fetch(PDO::FETCH_ASSOC);

        return new Reservation($datas);
    }

    public function getDate($dateTime)
    {
        $q = $this->_db->query("SELECT meeting_date FROM reservations WHERE meeting_date ='$dateTime'");
        $data = $q->fetch(PDO::FETCH_ASSOC);

        return ($data);
    }

    public function getList()
    {
        $idReservations = [];
        $q = $this->_db->query('SELECT id_reservation, reservation_date, meeting_date, id_user, id_product FROM reservations');

        while ($datas = $q->fetch(PDO::FETCH_ASSOC))
        {
            $idReservations[] = new Reservation ($datas);
        }

        return $idReservations;
    }

    public function getDateList() //Getting list ordered by date
    {
        $idReservations = [];
        $q = $this->_db->query('SELECT id_reservation, reservation_date, meeting_date, id_user, id_product FROM reservations ORDER BY entry_date DESC');

        while ($datas = $q->fetch(PDO::FETCH_ASSOC))
        {
            $idReservations[] = new Reservation($datas);
        }

        return $idReservations;
    }

    public function update($reservation)
    {
        $q = $this->_db->prepare('UPDATE reservations SET id_reservation = :id_reservation, reservation_date = :reservation_date, meeting_date = :meeting_date, id_user = :id_user, id_product = :id_product WHERE id_reservation = :id_reservation');

        $q->bindValue(':id_reservation', $reservation['idReservation'], PDO::PARAM_INT);
        $q->bindValue(':reservation_date', $reservation->reservationDate());
        $q->bindValue(':meeting_date', $reservation->meetingDate());
        $q->bindValue(':id_user', $reservation->idUser(), PDO::PARAM_INT);
        $q->bindValue(':id_product', $reservation->idProduct(), PDO::PARAM_INT);


        $q->execute();
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}