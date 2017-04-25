<?php
// Product Type Manager
class TypeManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function addProductType(ProductType $productType)
    {
        $q = $this->_db->prepare('INSERT INTO products_types(id_product_type, name) 
                                  VALUES(:id_product_type, :name)');

        $q->bindValue(':id_product_type', $productType->id_product_type(), PDO::PARAM_INT);
        $q->bindValue(':name', $productType->name());

        $q->execute();
    }

    public function deleteProductType(ProductType $productType)
    {
        $this->_db->exec('DELETE FROM products_types WHERE id_product_type = ' .$productType->id_product_type());
        $this->_db->exec('DELETE FROM sub_types WHERE id_product_type = ' .$productType->id_product_type());
    }

    public function getProductType($idProductType)
    {
        $idProductType = (int) $idProductType;

        $q = $this->_db->query('SELECT id_product_type, name FROM products_types WHERE id_product_type = ' .$idProductType);
        $datas = $q->fetch(PDO::FETCH_ASSOC);

        return $datas;
    }

    public function getListProductType()
    {
        $productTypes = [];

        $q = $this->_db->query('SELECT id_product_type, name FROM products_types ORDER BY name');

        while ($datas = $q->fetch(PDO::FETCH_ASSOC))
        {
            $productTypes[] = new ProductType($datas);
        }

        return $productTypes;
    }

    public function update(Product_type $productType)
    {
        $q = $this->_db->prepare('UPDATE products_types SET id_product_type = :id_product_type, name = :name');

        $q->bindValue(':name', $productType->name());
        $q->bindValue(':id_product_type', $productType->id_product_type(), PDO::PARAM_INT);

        $q->execute();
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}