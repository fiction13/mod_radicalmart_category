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
        <div class="uk-grid-divider uk-grid-medium radicalmart-category__list" uk-grid
             uk-height-match="target: > div > .uk-card >.uk-card-body,> div > .uk-card >.uk-card-footer > .uk-grid; row:false">
			<?php foreach ($items as $i => $item):
				$layout = ($item->isMeta) ? 'modules.radicalmart_category.metas.' . $item->type . '.item.list'
					: 'modules.radicalmart_category.products.item.list';
				?>
                <div class="uk-width-1-<?php echo $params->get('cols'); ?>@s">
					<?php echo LayoutHelper::render($layout,
						array('product' => $item, 'mode' => $mode, 'params' => $params)); ?>
                </div>
			<?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
