<?php
//REDIRECT

if(empty($_GET['idProduct']) && empty($idProduct))
{
    header('Location: ..\index.php');
}

//OBJETCS INSTANCE

$productManager = new ProductManager($db);
$pictureManager = new PictureManager($db);

// VARIABLES
if(!empty($_GET['idProduct']))
{
    $product = $productManager->get($_GET['idProduct']);
    $primary = $pictureManager->getPrimaryPicture2($_GET['idProduct']);
    $primary = $pictureManager->getPicture($primary);
    $pictures = $pictureManager->getNewsPicture2($_GET['idProduct'], $primary['id_picture']);
}

if(!empty($idProduct))
{
    $product = $productManager->get($idProduct);
    $primary = $pictureManager->getPrimaryPicture2($idProduct);
    $primary = $pictureManager->getPicture($primary);
    $pictures = $pictureManager->getNewsPicture2($idProduct, $primary['id_picture']);
}

?>

<!-- DISPLAY PRODUCT -->
<div class="col-md-8">
    <h2><a href="<?php echo URL . '?page=product&idProduct=' . $product->idProduct() ?>"><strong><?php echo $product->name(); ?></strong></a></h2>
    <p>
        <img src="<?php echo URL .'\inc\\' .$primary['pic_final_name']; ?>" alt="<?php echo $primary['pic_alt']; ?>">
        <?php

        if($product->autor() != NULL )
        {
            echo 'Designer : ' . $product->autor() .'<br />';
        }

        if($product->year() != NULL )
        {
            echo 'Année de création : ' . $product->year() .'<br />';
        }
        echo $product->description() .'<br />';
        echo $product->price() . ' Frs';
        switch($product->disponibility())
        {
            case 'dis':
                echo ' Disponible !';
                break;

            case 'ind':
                echo ' N\'est plus disponible !';
                break;

            case 'res':
                echo ' Produit reservé.';
                break;
        }
        ?>
        <br />
    </p>

    <?php

    if(!empty($_GET['idProduct']))
    {
        foreach($pictures as $picture)
        {
            ?>
            <img src="<?php echo URL .'\inc\\' . $picture->picFinalName(); ?>" alt="<?php echo $picture->picAlt(); ?> ">
            <?php
        }
    }
    ?>
</div>
<?php
if(isConnected() && $product->disponibility() == 'dis' && isset($_GET['page']) && $_GET['page'] == 'product')
{
?>
    <div class="col-md-4">
        <a href="?page=reservation&week=0&product=<?php echo $_GET['idProduct'] ; ?>" class="btn btn-success" role="button">Réserver</a>
    </div>
<?php
}
?>

