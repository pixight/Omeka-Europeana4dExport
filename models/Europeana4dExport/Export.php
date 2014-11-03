<?php
/**
 * CsvImport_Import class - represents a csv import event
 *
 * @copyright Copyright 2007-2012 Roy Rosenzweig Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU GPLv3
 * @package Europeana4dExport_
 */
class Europeana4dExport_Export extends Omeka_Record_AbstractRecord
{
    /**
     * Name of this ItemType.
     *
     * @var string
     */
    public $date;

    /**
     * Description for this ItemType.
     *
     * @var string
     */
    public $file;
    
   
    
    public function start($items){
        
        
        //ini_set('memory_limit', '2048M');
        
        $records = $items;//get_db()->getTable('Item')->findAll();
        
        $datefile = date("Y") . date("m") . date("d") . date("H") . date("i") .date("s");
        $this->date = date("Y-m-d H:i:s");
        
        $filename = 'omeka-europeana4d-export-'. $datefile  .'.kml';
        $this->file = $filename;
        
        $this->setPostData(array('date'=>$this->date, 'file'=>$this->file));
        
        $fp = fopen($filename, 'w');
        
        $kml = '<xml version="1.0" encoding="UTF-8" standalone="yes"?>
                <kml xmlns="http://www.opengis.net/kml/2.2" xmlns:gx="http://www.google.com/kml/ext/2.2" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:xal="urn:oasis:names:tc:ciq:xsdschema:xAL:2.0">
                    <Folder>';
        fwrite ( $fp , $kml);
        foreach ($records as $item):
            //if(metadata($item, array('Architecture Analyse Metadata', Europeana4dExportPlugin::GPS_NAME)) != null){
                $tmp = '<Placemark>
                            <name>'.metadata($item, array('Dublin Core', 'Title')).'</name>
                            <address>'.metadata($item, array('Dublin Core', 'Coverage')).'</address>
                            <description>'.metadata($item, array('Dublin Core', 'Description')).'</description>
                            <TimeStamp>
                                <when>'.metadata($item, array('Dublin Core', 'Date')).'</when>
                            </TimeStamp>
                            <Point>
                                <coordinates>'.metadata($item, array('Architecture Analyse Metadata', 'Coordonnees Lat&Long')).'</coordinates>
                            </Point>
                        </Placemark>';
        
                //$kml .=$tmp; 

                fwrite ( $fp , $tmp); 
            //}
        endforeach;
        $tmp = '</Folder>
            <kml>';
        //$kml .= $tmp;
        fwrite ( $fp , $tmp);
        //$this->_feed = $kml;
        
        fclose($fp);
        
        $this->save();
    }
    
   
}
