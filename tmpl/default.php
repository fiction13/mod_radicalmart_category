<?php
/*
 * @package   mod_radicalmart_category
 * @version   __DEPLOY_VERSION__
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
        <div class="radicalmart-category__list">
            <?php foreach ($items as $i => $item): ?>
                <?php if ($i > 0) echo '<hr class="uk-margin-remove">'; ?>
                <div class="item-<?php echo $item->id; ?>">
                    <?php echo LayoutHelper::render('modules.radicalmart_category.list',
                        array('product' => $item, 'mode' => $mode, 'params' => $params)); ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
