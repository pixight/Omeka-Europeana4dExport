<?php

/**
 * 
 * @package Europeana4dExport\models\Builder
 */
class Builder_Europeana4dExport_Export extends Omeka_Record_Builder_AbstractBuilder
{
    protected $_recordClass = 'Europeana4dExport_Export';
    
    protected $_settableProperties = array('date', 'file');
}
?>
