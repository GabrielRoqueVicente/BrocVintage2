<?php
// Manager Sub Type
class SubTypeManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function addProductSubType(SubType $productSubType)
    {
        $q = $this->_db->prepare('INSERT INTO sub_types(id_sub_type, name, id_product_type) 
                                  VALUES(:id_sub_type, :name, :id_product_type)');

        $q->bindValue(':id_sub_type', $productSubType->idSubType(), PDO::PARAM_INT);
        $q->bindValue(':name', $productSubType->subTypeName());
        $q->bindValue(':id_product_type', $productSubType->idProductType(), PDO::PARAM_INT);

        $q->execute();
    }

    public function deleteProductSubType(SubType $productSubType)
    {
        $this->_db->exec('DELETE FROM sub_types WHERE id_sub_type = ' .$productSubType->id_sub_type());
    }

    public function deleteProductType(ProductType $productType)
    {
        $this->_db->exec('DELETE FROM sub_types WHERE id_product_type = ' .$productType->idProductType());
    }

    public function getProductSubType($idProductSubType)
    {
        $idProductSubType = (int) $idProductSubType;

        $q = $this->_db->query('SELECT id_sub_type, name, id_product_type FROM sub_types WHERE id_Sub_Type = ' .$idProductSubType);
        $datas = $q->fetch(PDO::FETCH_ASSOC);

        return new SubType ($datas);
    }

    public function getListProductSubType()
    {
        $subTypes = [];
        $q = $this->_db->query('SELECT id_sub_type, name, id_product_type FROM sub_types');

        while ($datas = $q->fetch(PDO::FETCH_ASSOC))
        {
            $subTypes[] = new SubType($datas);
        }

        return $subTypes;
    }

    public function getPTProductSubType($productType) //Get sub-products by product types.
    {
        $subTypes = [];
        $q = $this->_db->query('SELECT id_sub_type, name, id_product_type FROM sub_types WHERE id_product_type =' . $productType);

        while ($datas = $q->fetch(PDO::FETCH_ASSOC))
        {
            $subTypes[] = new SubType($datas);
        }

        return $subTypes;
    }

    public function update(SubType $productSubType)
    {
        $q = $this->_db->prepare('UPDATE  sub_types SET id_sub_type = :id_sub_type, name = :name, id_product_type = :id_product_type,  WHERE id_sub_type = :id_sub_type');

        $q->bindValue(':id_sub_type', $productSubType->id_sub_type(), PDO::PARAM_INT);
        $q->bindValue(':name', $productSubType->name());
        $q->bindValue(':id_product_type', $productSubType->id_product_type(), PDO::PARAM_INT);

        $q->execute();
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}