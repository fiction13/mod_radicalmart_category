<?php
/*
 * @package   mod_radicalmart_category
 * @version   1.0.0
 * @author    Dmitriy Vasyukov - https://fictionlabs.ru
 * @copyright Copyright (c) 2022 Fictionlabs. All rights reserved.
 * @license   GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link      https://fictionlabs.ru/
 */

defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;

?>

<?php if (!empty($items)): ?>
    <div class="radicalmart-category <?php echo $moduleclass_sfx; ?>">
        <div class="uk-grid-divider uk-grid-medium radicalmart-category__list" uk-grid
             uk-height-match="target: > div > .uk-card >.uk-card-body,> div > .uk-card >.uk-card-footer > .uk-grid; row:false">
            <?php foreach ($items as $i => $item): ?>
                <div class="uk-width-1-<?php echo $params->get('cols'); ?>@s">
                    <?php echo LayoutHelper::render('modules.radicalmart_category.grid',
                        array('product' => $item, 'mode' => $mode, 'params' => $params)); ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
