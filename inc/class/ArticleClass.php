<?php
//Class Article
class Articles
{
    //===ATTRIBUTES===

    private $_idArticle;
    private $_entryDate;
    private $_title;
    private $_text;

    //===PROPERTIES===

    public function __construct(array $datas)
    {
        $this->hydrate($datas);
    }

    //Dynamic class hydrate
    public function hydrate(array $datas)
    {
        foreach ($datas as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);

            }
        }
    }

    //===SETTERS===

    public function setId_article($idArticle)
    {
        $idArticle = (int)$idArticle;

        if ($idArticle > 0) {
            $this->_idArticle = $idArticle;
        }
    }

    public function setEntry_Date($entryDate)
    {
        //if(is_date($EntryDate))
        //{
        $this->_entryDate = $entryDate;
        //}
    }

    public function setTitle($title)
    {
        if (is_string($title) && strlen($title) <= 255) {
            $this->_title = $title;
        }
    }

    public function setText($text)
    {
        if (is_string($text)) {
            $this->_text = $text;
        }

    }

    //===GETTERS===

    public function idArticle()
    {
        return $this->_idArticle;
    }

    public function entryDate()
    {
        return $this->_entryDate;
    }

    public function title()
    {
        return $this->_title;
    }

    public function text()
    {
        return $this->_text;
    }
}