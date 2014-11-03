<?php 
$pageTitle = __('Browse Eureopeana4d kml exports') . ' ' . __('(%s total)', $total_results);
echo head(array('title' => $pageTitle,'bodyclass' => 'item-types')); ?>



<table>
    <thead>
        <tr>
            <th><?php echo __('Date'); ?></th>
            <th><?php echo __('File'); ?></th>
        </tr>
    </thead>
    <tbody>        
        <?php foreach (loop('Europeana4dExport_Export') as $export): ?>
        <tr class="itemtype">
            <td class="itemtype-name">
                <?php echo html_escape($export->date); ?>                            
            </td>
            <td class="itemtype-description">
                <a href="<?php echo $this->baseUrl($export->file) ; ?>">
                    <?php echo html_escape($export->file); ?>
                </a>
            </td>
            
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>



<?php echo foot(); ?>
