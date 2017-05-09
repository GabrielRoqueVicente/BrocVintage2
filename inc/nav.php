<?php

$typeManager = new TypeManager($db);
$subTypeManager = new SubTypeManager($db);

$types = $typeManager->getListProductType();
$subTypes = $subTypeManager->getListProductSubType();
?>

<!--
<ul>
    <li>

    </li>
    <ul>

    </ul>
</ul>
-->

<?php
foreach ($types as $type)
{
    echo '<ul class=""nav nav-pills nav-stacked">';
    echo '<li>' . $type->typeName() . '</li>';

    foreach ($subTypes as $subType)
    {
        if ($type->idProductType() == $subType->idProductType()) {

            echo '<ul><li>' . $subType->subTypeName() . '</li></ul>';


        } else {

        }

    }
    echo '</ul>';
}

?>

