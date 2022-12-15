<?php
/*
 * @package   mod_islamicdate
 * @version   1.2.0
 * @author    Dmitriy Vasyukov - https://fictionlabs.ru
 * @copyright Copyright (c) 2022 Fictionlabs. All rights reserved.
 * @license   GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link      https://fictionlabs.ru/
 */

namespace Joomla\Module\RadicalmartCategory\Site\Dispatcher;

\defined('JPATH_PLATFORM') or die;

use Joomla\CMS\Application\CMSApplicationInterface;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Dispatcher\AbstractModuleDispatcher;
use Joomla\CMS\Extension\ModuleInterface;
use Joomla\Input\Input;
use Joomla\CMS\Helper\HelperFactoryAwareTrait;
use Joomla\Module\RadicalmartCategory\Site\Helper\RadicalmartCategoryHelper;

/**
 * Dispatcher class
 *
 * @since  1.0.0
 */
class Dispatcher extends AbstractModuleDispatcher
{
	use HelperFactoryAwareTrait;

	/**
	 * The module extension. Used to fetch the module helper.
	 *
	 * @var   ModuleInterface|null
	 * @since 1.0.0
	 */
	private $moduleExtension;

	public function __construct(\stdClass $module, CMSApplicationInterface $app, Input $input)
	{
		parent::__construct($module, $app, $input);

		$this->moduleExtension = $this->app->bootModule('mod_radicalmart_category', 'site');
	}

	/**
	 * Returns the layout data.
	 *
	 * @return  array
	 *
	 * @since   1.0.0
	 */
	protected function getLayoutData()
	{
		$data                    = parent::getLayoutData();
		$data['items']           = (new RadicalmartCategoryHelper($data['params']))->getItems();
		$data['mode']            = ComponentHelper::getParams('com_radicalmart')->get('mode', 'shop');
		$data['moduleclass_sfx'] = htmlspecialchars($data['params']->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');

		return $data;
	}
}