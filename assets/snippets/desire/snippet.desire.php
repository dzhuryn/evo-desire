<?php
require_once MODX_BASE_PATH.'assets/snippets/desire/class.desire.php';

$noJS = isset($noJS)?$noJS:0;
$storage = isset($storage)?$storage:'cookie';
$typeOutput = isset($typeOutput)?$typeOutput:'code';
$class = isset($class)?$class:'';
$needAuthClass = isset($needAuthClass)?$needAuthClass:'need-sign-in';
$toDesireClass = 'add-to-desire';
$deleteFromDesireClass = 'delete-from-desire';
$_SESSION['desire_storage']=$storage;
$id = isset($id)?$id:$modx->documentIdentifier;


if(!$noJS){
    $modx->regClientScript('/assets/snippets/desire/js/desire.js');
}

$desire = new desire($storage,$modx);


$type = isset($type)?$type:'check';
if($type=='check'){
    if($typeOutput=='bool'){
        echo $desire->inDesire($id);
        return '';
    }

    if($storage=='database' && empty($_SESSION['webShortname'])){
        echo 'class="'.$class.' '.$needAuthClass.'"';
        return '';
    }
    if($desire->inDesire($id)){
        echo 'class="'.$class.''.$deleteFromDesireClass.'" data-id="'.$id.'"';
    }
    else{
        echo 'class="'.$class.''.$toDesireClass.'" data-id="'.$id.'"';
    }


}
if($type=='getList')
{
    return $desire->getItems();
}
