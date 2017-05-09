<?php
// Article Manager
class ArticleManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function add(Article $article)
    {
        $q = $this->_db->prepare('INSERT INTO articles(entry_date, title, text) 
                                  VALUES(NOW(), :title, :text )');

        $q->bindValue(':title', $article->title());
        $q->bindValue(':text', $article->text());

        $q->execute();
    }

    public function delete(Article $article)
    {
        $this->_db->exec('DELETE FROM articles WHERE id_article = ' .$article->idArticle());
    }

    public function get($idArticle)
    {
        $idArticle = (int) $idArticle;

        $q = $this->_db->query('SELECT id_article,entry_date, title, text FROM articles WHERE id_article = ' .$idArticle);
        $datas = $q->fetch(PDO::FETCH_ASSOC);

        return new Article($datas);
    }

    public function getList()
    {
        $articles = [];
        $q = $this->_db->query('SELECT id_article, entry_date, title, text FROM articles');

        while ($datas = $q->fetch(PDO::FETCH_ASSOC))
        {
            $articles[] = new Article($datas);
        }

        return $articles;
    }

    public function getDateList() //Getting list ordered by date
    {
        $articles = [];
        $q = $this->_db->query('SELECT id_article, entry_date, title, text FROM articles ORDER BY entry_date DESC');

        while ($datas = $q->fetch(PDO::FETCH_ASSOC))
        {
            $articles[] = new Article($datas);
        }

        return $articles;
    }

    public function getDateList2($productDateA, $productDateB) //Getting news between articles.
    {
        $articles = [];
        $q = $this->_db->query('SELECT id_article, entry_date, title, text FROM articles WHERE UNIX_TIMESTAMP(entry_date) <' .  strtotime($productDateA) . '  AND  UNIX_TIMESTAMP(entry_date) > "'. strtotime($productDateB) .'" ORDER BY entry_date DESC');

        while ($datas = $q->fetch(PDO::FETCH_ASSOC))
        {
            $articles[] = new Article($datas);
        }

        return $articles;
    }

    public function getLast()
    {
        $q = $this->_db->query('SELECT MAX(id_article) FROM articles');
        $last = $q->fetch(PDO::FETCH_ASSOC);
        $last = (int) $last['MAX(id_article)'];

        return $last;
    }

    public function update(Article $article)
    {
        $q = $this->_db->prepare('UPDATE articles SET id_article = :id_article, entry_date = :entry_date, title = :title, text = :text WHERE id_article = :id_article');

        $q->bindValue(':id_article', $article->id_article(), PDO::PARAM_INT);
        $q->bindValue(':entry_date', $article->entryDate());
        $q->bindValue(':title', $article->title());
        $q->bindValue(':text', $article->text());

        $q->execute();
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}