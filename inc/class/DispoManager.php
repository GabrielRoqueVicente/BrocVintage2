<?php
// Dispo Manager
class DispoManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function add(Dispo $dispo)
    {
        $q = $this->_db->prepare('INSERT INTO dispo(dispo_date, meeting_date, id_user) 
                                  VALUES(NOW(), :meeting_date, :id_user)');

        $q->bindValue(':meeting_date', $dispo->meetingDate());
        $q->bindValue(':id_user', $dispo->idUser(), PDO::PARAM_INT);

        $q->execute();
    }

    public function delete($dispo)
    {
        $this->_db->exec("DELETE FROM dispo WHERE  meeting_date = '$dispo'");
    }

    public function get($idDispo)
    {
        $idDispo = (int) $idDispo;

        $q = $this->_db->query('SELECT id_dispo, dispo_date, meeting_date, id_user FROM dispo WHERE id_dispo = ' .$idDispo);
        $data = $q->fetch(PDO::FETCH_ASSOC);

        return new Dispo($data);
    }

    public function getDate($dateTime)
    {
        $q = $this->_db->query("SELECT meeting_date FROM dispo WHERE meeting_date ='$dateTime'");
        $data = $q->fetch(PDO::FETCH_ASSOC);

        return ($data);
    }

    public function getList()
    {
        $idDispo = [];
        $q = $this->_db->query('SELECT id_dispo, dispo_date, meeting_date, id_user FROM dispo');

        while ($datas = $q->fetch(PDO::FETCH_ASSOC))
        {
            $idDispos[] = new Dispo ($datas);
        }

        return $idDispos;
    }

    public function getDateList() //Getting list ordered by date
    {
        $idDispo = [];
        $q = $this->_db->query('SELECT id_dispo, dispo_date, meeting_date, id_user FROM dispo ORDER BY entry_date DESC');

        while ($datas = $q->fetch(PDO::FETCH_ASSOC))
        {
            $idDispos[] = new Dispo($datas);
        }

        return $idDispos;
    }

    public function update($dispo)
    {
        $q = $this->_db->prepare('UPDATE dispo SET id_dispo = :id_dispo, dispo_date = :dispo_date, meeting_date = :meeting_date, id_user = :id_user WHERE id_dispo = :id_dispo');

        $q->bindValue(':id_dispo', $dispo['idDispo'], PDO::PARAM_INT);
        $q->bindValue(':dispo_date', $dispo->dispoDate());
        $q->bindValue(':meeting_date', $dispo->meetingDate());
        $q->bindValue(':id_user', $dispo->idUser(), PDO::PARAM_INT);


        $q->execute();
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}