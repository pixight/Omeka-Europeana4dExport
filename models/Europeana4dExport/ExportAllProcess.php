<?php
/**
 * The export process.
 * 
 * @package Europeana4dExport/models/Europeana4dExport
 */
class Europeana4dExport_ExportAllProcess extends Omeka_Job_Process_AbstractProcess
{
    
    /**
     * Runs the export process.
     * 
     * @param array $args Required arguments to run the process.
     */
    public function run($args)
    {
        // Raise the memory limit.
        ini_set('memory_limit', '2900M');
        
        $export = new Europeana4dExport_Export();
        
        $export->start($args['items']);                
        
        
    }
    
    
}
