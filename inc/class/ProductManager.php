<?php
// Product Manager
class ProductManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function add(Product $product)
    {
        $q = $this->_db->prepare('INSERT INTO products(autor, year, price, disponibility, entry_date, name, description, promotion, id_product_type, id_sub_type) 
                                  VALUES(:autor, :year, :price, :disponibility, :entry_date, :name, :description, :promotion, :id_product_type, :id_sub_type)');

        $q->bindValue(':autor', $product->autor());
        $q->bindValue(':year', $product->year());
        $q->bindValue(':price', $product->price());
        $q->bindValue(':disponibility', $product->disponibility());
        $q->bindValue(':entry_date', $product->entry_date());
        $q->bindValue(':name', $product->name());
        $q->bindValue(':description', $product->description());
        $q->bindValue(':promotion', $product->promotion(), PDO::PARAM_INT);
        $q->bindValue(':id_product_type', $product->id_product_type(), PDO::PARAM_INT);
        $q->bindValue(':id_sub_type', $product->id_sub_type(), PDO::PARAM_INT);

        $q->execute();
    }

    public function delete(Product $product)
    {
        $this->_db->exec('DELETE FROM products WHERE id_product = ' .$product->id_product());
    }

    public function get($id_product)
    {
        $id_product = (int) $id_product;

        $q = $this->_db->query('SELECT id_product autor, year, price, disponibility, entry_date, name, description, promotion, id_product_type, id_sub_type FROM products WHERE id_product = ' .$id_product);
        $datas = $q->fetch(PDO::FETCH_ASSOC);

        return new Product($datas);
    }

    public function getList()
    {
        $products = [];
        $q = $this->_db->query('SELECT id_product autor, year, price, disponibility, entry_date, name, description, promotion, id_product_type, id_sub_type FROM products ORDER BY name');

        while ($datas = $q->fetch(PDO::FETCH_ASSOC))
        {
            $products[] = new Product($datas);
        }

        return $products;
    }

    public function update(Product $product)
    {
        $q = $this->_db->prepare('UPDATE products SET autor = :autor, year = :year, price = :price, disponibility = :disponibility, entry_date = :entry_date, name = :name, description = :description, promotion = :promotion, id_product_type = :id_product_type, id_sub_type = :id_sub_type WHERE id_product = :id_product');

        $q->bindValue(':autor', $product->autor());
        $q->bindValue(':year', $product->year());
        $q->bindValue(':price', $product->price());
        $q->bindValue(':disponibility', $product->disponibility());
        $q->bindValue(':entry_date', $product->entry_date());
        $q->bindValue(':name', $product->name());
        $q->bindValue(':description', $product->description());
        $q->bindValue(':promotion', $product->promotion(), PDO::PARAM_INT);
        $q->bindValue(':id_product_type', $product->id_product_type(), PDO::PARAM_INT);
        $q->bindValue(':id_sub_type', $product->id_sub_type(), PDO::PARAM_INT);
        $q->bindValue(':id_product', $product->id_prouct(), PDO::PARAM_INT);

        $q->execute();
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}