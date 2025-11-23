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
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 radicalmart-category__grid">
			<?php foreach ($items as $item)
			{
				$layout = $product_layout;

				if ($item->isMeta) $layout = $component_layouts ? 'components.radicalmart.metas.' . $item->type . '.item' : 'modules.radicalmart_category.metas.' . $item->type . '.item';

				echo '<div class="mb-3">' . LayoutHelper::render($layout . '.grid', ['product' => $item, 'mode' => $mode]) . '</div>';
			} ?>
        </div>
    </div>
<?php endif; ?>