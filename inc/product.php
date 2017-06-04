<?php
//REDIRECT

if(empty($_GET['idProduct']) && empty($idProduct))
{
    header('Location: ../index.php');
}

//OBJETCS INSTANCE

$productManager = new ProductManager($db);
$pictureManager = new PictureManager($db);
$reservationManager = new ReservationManager($db);

// VARIABLES
$colPage=''; // col for individual product display
$imgPage=''; // Style for individual product display
if($_GET['page'] == 'product')
{
    $colPage = "col-md-9";
    $imgPage='imgPage';
}

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
<div class="<?php echo $colPage; ?>">
    <div class="panel-group">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h2><a href="<?php echo URL . '?page=product&idProduct=' . $product->idProduct() ?>"><strong><?php echo $product->name(); ?></strong></a></h2>
            </div>
            <div class="panel-body">
                <p>
                    <a target="_blank" href="<?php echo URL .'/inc/' .$primary['pic_final_name']; ?>"><img src="<?php echo URL .'/inc/' .$primary['pic_final_name']; ?>" alt="<?php echo $primary['pic_alt']; ?>" class="<?php echo $imgPage; ?>"></a>
                    <?php

                    if($product->autor() != NULL )
                    {
                        echo 'Designer : ' . $product->autor() .'<br /><br />';
                    }

                    if($product->year() != NULL )
                    {
                        echo 'Année de création : ' . $product->year() .'<br /><br />';
                    }
                    echo $product->description() .'<br /><br />';
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
                    ?><p><?php
                    foreach($pictures as $picture)
                    {
                        ?>
                        <div class="col-md-1">
                            <a target="_blank" href="<?php echo URL .'/inc/' . $picture->picFinalName(); ?>"><img src="<?php echo URL .'/inc/' . $picture->picFinalName(); ?>" alt="<?php echo $picture->picAlt(); ?>" class="imgProduct"></a>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php


if(isConnected() && $product->disponibility() == 'dis' && isset($_GET['page']) && $_GET['page'] == 'product')
{
?>
    <div class="col-md-3 resBtn">
        <p> Cet article vous intéresse ?<br />
            Reservez-le, puis <b>consultez le calendrier</b> pour connaitre mes disponibilités afin de fixer une date de rendez-vous.</p>
        <a href="?page=reservation&week=0&product=<?php echo $_GET['idProduct'] ; ?>" class="btn btn-success btn-lg" role="button">Réserver</a>

    </div>
<?php
}
?>


