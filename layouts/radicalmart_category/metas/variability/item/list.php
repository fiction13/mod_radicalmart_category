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

$hidePrice = (ParamsHelper::getComponentParams()->get('hide_prices', 0) || !empty($product->price['hide']));
?>
<div class="card position-relative mb-3">
	<div class="row g-0">
		<div class="col-md-3 position-relative">
			<a class="h-100 d-flex justify-content-center align-items-center bg-light p-1"
			   href="<?php echo $product->link; ?>">
				<?php echo MediaHelper::renderImage(
					'com_radicalmart.metas.variability.list',
					$product->image,
					[
						'alt'     => $product->title,
						'loading' => 'lazy',
						'class'   => 'mh-100 mw-100'
					],
					[
						'meta_id'  => $product->id,
						'no_image' => true,
						'thumb'    => true,
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
		<div class="col d-flex flex-column">
			<div class="card-body">
				<div class="card-title mb-2">
					<?php if ($product->category): ?>
						<div>
							<a href="<?php echo $product->category->link; ?>"
							   class="text-nowrap small text-muted text-decoration-none fw-light">
								<?php echo $product->category->title; ?>
							</a>
						</div>
					<?php endif; ?>
					<div>
						<a href="<?php echo $product->link; ?>" class="h5 text-decoration-none">
							<?php echo $product->title; ?>
						</a>
					</div>
				</div>
				<div class="card-text mb-3 d-none d-md-block">
					<?php if (!empty($product->introtext)): ?>
						<div class="small">
							<?php echo $product->introtext; ?>
						</div>
					<?php endif; ?>
					<?php if (!empty($product->manufacturers)): ?>
						<div>
							<?php foreach ($product->manufacturers as $manufacturer): ?>
								<a href="<?php echo $manufacturer->link; ?>"
								   class="btn btn-outline-info"
								   title="<?php echo Text::sprintf('COM_RADICALMART_PRODUCT_MANUFACTURER_LINK', $manufacturer->title); ?>">
									<?php if ($src = $manufacturer->media->get('icon'))
									{
										echo MediaHelper::renderImage(
											'com_radicalmart.categories.manufacturer',
											$src,
											[
												'alt'     => $manufacturer->title,
												'loading' => 'lazy',
												'style'   => 'height:48px'
											],
											[
												'category_id' => $manufacturer->id,
												'no_image'    => false,
												'thumb'       => true,
											]);
									}
									else
									{
										echo $manufacturer->title;
									} ?>
								</a>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-between align-items-center">
					<div>
						<?php if (!$hidePrice): ?>
							<div class="h6 m-0">
								<?php echo Text::sprintf('COM_RADICALMART_PRICE_FROM', $product->price['min_string']); ?>
							</div>
						<?php endif; ?>
					</div>
					<div>
						<a href="<?php echo $product->link; ?>"
						   class="btn btn-outline-success fw-bold">
							<?php echo Text::_('COM_RADICALMART_SHOW_VARIANTS'); ?>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>