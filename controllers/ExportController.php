<?php
/**
 * @copyright PXG
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @package Europeana4dExport/Controller
 */

class Europeana4dExport_ExportController extends Omeka_Controller_AbstractActionController
{
    

    public function init()
    {
        $this->_helper->db->setDefaultModelName('Europeana4dExport_Export');
        
    }

    public function browseAction()
    {
        // specify view variables
        parent::browseAction();
    }
    
    
}
