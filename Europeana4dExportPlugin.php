<?php
/**
* @version $Id$
* @copyright pxg, 2014
* @license http://www.gnu.org/licenses/gpl-3.0.txt
* @package Europeana4dExport
*/


/**
* *
* @package Omeka\Plugins\Europeana4dExport
*/

if (!defined('EUROPEANa4dEXPORT_PLUGIN_DIR')) {
    define('EUROPEANa4dEXPORT_PLUGIN_DIR', dirname(__FILE__));
}


class Europeana4dExportPlugin extends Omeka_Plugin_AbstractPlugin
{
    const GPS_NAME = 'Coordonnees Lat&Long';
    
    /**
     * @var array Hooks for the plugin.
     */
    protected $_hooks = array('install', 'uninstall','define_routes');
   
    
    protected $_filters = array('admin_navigation_main','action_contexts','response_contexts');
        

    
    /**
    * Installs the plugin. 
     */
    public function hookInstall()
    {
        $db = $this->_db;
        $sql = "
        CREATE TABLE IF NOT EXISTS `{$db->prefix}europeana4d_export_exports` (
            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,          
            `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
            `file` text COLLATE utf8_unicode_ci,
            PRIMARY KEY (`id`),
            UNIQUE KEY `date` (`date`)
          ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
        $db->query($sql);
        
        $this->_installOptions();
    }
    
    /**
     * Uninstall the plugin.
     */
    public function hookUninstall()
    { 
        $db = $this->_db;
        //drop table
        $sql = "DROP TABLE IF EXISTS `{$db->prefix}europeana4d_export_exports`";
        $db->query($sql);
    }
    
    function hookDefineRoutes($args)
    {
       $router = $args['router'];
        
       $router->addConfig(new Zend_Config_Ini(EUROPEANa4dEXPORT_PLUGIN_DIR .
       '/routes.ini', 'routes'));    
    }  
 
    function filterActionContexts($context, $args)
    {
        if ($args['controller'] instanceof ItemsController) {
            array_push($context['browse'],'europeana-kml');
        }

        return $context;
    }
 
    function filterResponseContexts($context)
    {
        $context['europeana-kml'] = array('suffix'  => 'europeana-kml', 
                                'headers' => array('Content-Type' => 'text/html'));

        return $context;
    }
    
    public function filterAdminNavigationMain($nav)
    {
        if(get_db()->getTable('Element')->findByElementSetNameAndElementName(ArchitectureAnalyse::ARCHITECTURE_ANALYSE_NAME,self::GPS_NAME)){
            $nav[] = array(
                'label' => __('Exports Europeana4d'),
                'uri' => url('europeana4d-export/browse')
            );
        }
        return $nav;
    }
}