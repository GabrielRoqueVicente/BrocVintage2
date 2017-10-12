<?php
$typeManager = new TypeManager($db);
$subTypeManager = new SubTypeManager($db);

$types = $typeManager->getListProductType();
$subTypes = $subTypeManager->getListProductSubType();

$content = '';

foreach($types as $type)
{
    $typeName = str_replace(chr(32), '-', $type->typeName()); //replace spaces to avoid bugs with ids
    $content .= '<a class="list-group-item contentType" data-toggle="collapse" data-parent="#mainMenu" href="#' . $typeName . '">
        ' . $type->typeName() . '<span class="caret"></span></a>
        <div class="collapse" id="' . $typeName . '">';

            foreach ($subTypes as $subType)
            {
                if ($type->idProductType() == $subType->idProductType())
                {
                    $content .= '<a class="list-group-item" href="?page=produits&subType=' . $subType->idSubType() . '">' . $subType->subTypeName() . '</a>';
                }
            }

        $content .= '</div>';
}

echo'
<div class="col-md-3">
    <p class="lead">Articles</p>
    <div id="mainMenu">
        <div class="list-group panel">' .
            $content . '
        </div>
    </div>
</div>';