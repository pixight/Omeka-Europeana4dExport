<?php

$feed = new Europeana4dExport_Export();
        
$feed->start($items);

echo head(array('title'=> 'Export Europeana KML','bodyclass'=>'items'));
echo flash();

echo 'Export terminé';
echo foot();



?>