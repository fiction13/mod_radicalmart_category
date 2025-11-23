<?php
/*
 * @package   mod_radicalmart_category
 * @version   __DEPLOY_VERSION__
 * @author    Dmitriy Vasyukov - https://fictionlabs.ru
 * @copyright Copyright (c) 2022 Fictionlabs. All rights reserved.
 * @license   GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link      https://fictionlabs.ru/
 */

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\Component\RadicalMart\Administrator\Helper\ParamsHelper;
use Joomla\Component\RadicalMart\Site\Helper\MediaHelper;

extract($displayData);

/**
 * Layout variables
 * -----------------
 *
 * @var  object $product Product object.
 * @var  string $mode    RadicalMart mode.
 *
 */
$hidePrice = (ParamsHelper::getComponentParams()->get('hide_prices', 0) || !empty($product->price['hide'])
	|| empty($product->in_stock));

if (!$hidePrice)
{
	// Load assets
	/** @var \Joomla\CMS\WebAsset\WebAssetManager $assets */
	$assets = Factory::getApplication()->getDocument()->getWebAssetManager();
	$assets->getRegistry()->addExtensionRegistryFile('com_radicalmart');
	$assets->useScript('com_radicalmart.site.cart');

	$params = ParamsHelper::getComponentParams();
	if ($params->get('radicalmart_js', 1))
	{
		$assets->useScript('com_radicalmart.site')
			->useScript('bootstrap.toast')
			->useScript('bootstrap.offcanvas');
	}

	if ($params->get('trigger_js', 1))
	{
		$assets->useScript('com_radicalmart.site.trigger');
	}
}
?>
<div class="card h-100 <?php if (empty($product->in_stock)) echo 'opacity-50'; ?>">
	<div class="card-header position-relative">
		<a href="<?php echo $product->link; ?>"
		   class="card-img-top bg-light d-flex justify-content-center align-items-center text-center p-1"
		   style="height: 250px">
			<?php echo MediaHelper::renderImage(
				'com_radicalmart.products.grid',
				$product->image,
				[
					'alt'     => $product->title,
					'loading' => 'lazy',
					'class'   => 'mh-100 mw-100'
				],
				[
					'product_id' => $product->id,
					'no_image'   => true,
					'thumb'      => true,
				]); ?>
		</a>
		<?php if (!empty($product->badges)): ?>
			<div class="position-absolute top-0 start-0 p-1">
				<?php foreach ($product->badges as $badge): ?>
					<a href="<?php echo $badge->link; ?>" class="hasTooltip text-decoration-none"
					   title="<?php echo Text::sprintf('COM_RADICALMART_PRODUCT_BADGE_LINK', $badge->title); ?>">
						<?php if ($src = $badge->media->get('icon'))
						{
							echo MediaHelper::renderImage(
								'com_radicalmart.categories.badge',
								$src,
								[
									'alt'     => $badge->title,
									'loading' => 'lazy',
								],
								[
									'category_id' => $badge->id,
									'no_image'    => false,
									'thumb'       => true,
								]);
						}
						else
						{
							echo '<span class="badge">' . $badge->title . '</span>';
						} ?>
					</a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
	<div class="card-body">
		<div class="card-title">
			<?php if ($product->category): ?>
				<div>
					<a href="<?php echo $product->category->link; ?>"
					   class="text-nowrap small text-muted text-decoration-none fw-light">
						<?php echo $product->category->title; ?>
					</a>
				</div>
			<?php endif; ?>
			<div>
				<a href="<?php echo $product->link; ?>" class="h6 text-decoration-none">
					<?php echo $product->title; ?>
				</a>
			</div>
		</div>
	</div>
	<div class="card-footer">
		<div class="d-flex justify-content-between align-items-center">
			<div>
				<?php if (!$hidePrice): ?>
					<?php if ($product->price['discount_enable']): ?>
						<div class="small text-muted">
							<s><?php echo $product->price['base_string']; ?></s>
						</div>
					<?php endif; ?>
					<div class="h6 m-0"><?php echo $product->price['final_string']; ?></div>
				<?php elseif (empty($product->in_stock)): ?>
					<span class="text-danger">
						<?php echo Text::_('COM_RADICALMART_NOT_IN_STOCK'); ?>
					</span>
				<?php endif; ?>
			</div>
			<div>
				<?php if (!$hidePrice && $mode === 'shop' && (int) $product->state === 1): ?>
					<div radicalmart-cart="product" data-id="<?php echo $product->id; ?>">
						<input radicalmart-cart="quantity" type="hidden" name="quantity"
							   step="<?php echo $product->quantity['step']; ?>"
							   min="<?php echo $product->quantity['min']; ?>"
							<?php if (!empty($product->quantity['max'])) echo 'max="' . $product->quantity['max'] . '"'; ?>
							   value="<?php echo $product->quantity['min']; ?>"/>
						<button type="button" radicalmart-cart="add"
								class="btn btn-outline-success fw-bold">
							<?php echo Text::_('COM_RADICALMART_CART_ADD'); ?>
						</button>
					</div>
				<?php elseif ($hidePrice || $mode === 'catalog'): ?>
					<a href="<?php echo $product->link; ?>"
					   class="btn btn-success fw-bold">
						<?php echo Text::_('COM_RADICALMART_READMORE'); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>