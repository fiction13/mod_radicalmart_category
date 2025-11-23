<?php
/*
 * @package   mod_radicalmart_category
 * @version   2.0.0
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
			<?php foreach ($items as $i => $item)
			{
				$layout = $product_layout;

				if ($item->isMeta) $layout = $component_layouts ? 'components.radicalmart.metas.' . $item->type . '.item' : 'modules.radicalmart_category.metas.' . $item->type . '.item';

				echo LayoutHelper::render($layout . '.list', array('product' => $item, 'mode' => $mode, 'params' => $params));
			} ?>
        </div>
    </div>
<?php endif; ?>
