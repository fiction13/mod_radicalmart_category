<?php
/*
 * @package   mod_radicalmart_categories
 * @version   __DEPLOY_VERSION__
 * @author    Dmitriy Vasyukov - https://fictionlabs.ru
 * @copyright Copyright (c) 2022 Fictionlabs. All rights reserved.
 * @license   GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link      https://fictionlabs.ru/
 */

namespace Joomla\Module\RadicalmartCategory\Site\Helper;

defined('_JEXEC') or die;

use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Language\Text;
use Joomla\Input\Input;
use Joomla\Registry\Registry;
use Joomla\CMS\Factory;

/**
 * @package     Helper class
 *
 * @since       1.2.0
 */
class RadicalmartCategoryHelper
{
	/**
	 * @var Registry
	 *
	 * @since 1.0.0
	 */
	protected $params;

	/**
	 * @var Input
	 *
	 * @since 1.0.0
	 */
	protected $input;


	/**
	 * @param   Registry  $params
	 *
	 * @since 1.2.0
	 */
	public function __construct(Registry $params)
	{
		$this->params = $params;
		$this->input  = Factory::getApplication()->input;
	}

	/**
	 * Get items
	 *
	 * @since 1.2.0
	 */
	public function getItems()
	{
		if (!$model = Factory::getApplication()->bootComponent('com_radicalmart')->getMVCFactory()->createModel('Products', 'Site', ['ignore_request' => true]))
		{
			throw new \Exception(Text::_('MOD_RADICALMART_CATEGORY_ERROR_MODEL_NOT_FOUND'), 500);
		}

		// Variables
		$ordering   = $this->getOrdering();
		$categories = $this->getCategories();

		$model->setState('params', Factory::getApplication()->getParams());
		$model->setState('filter.categories', $categories);
		$model->setState('filter.published', 1);
		$model->setState('list.limit', (int) $this->params->get('limit', 12));
		$model->setState('list.ordering', $ordering['order']);

		// Set language filter state
		$model->setState('filter.language', Multilanguage::isEnabled());

		// Order direction
		if ($ordering['direction'])
		{
			$model->setState('list.direction', $ordering['direction']);

		}

		// Get items
		$items = $model->getItems();

		return $items;
	}

	/**
	 *
	 * @return false|int
	 *
	 * @since 1.1.0
	 */
	public function getCategories()
	{
		$categories = $this->params->get('categories', array());

		if (in_array(-1, $categories))
		{
			if ($this->input->get('option') == 'com_radicalmart' && $this->input->get('view') == 'product')
			{
				$currentCategory                 = $this->input->get('category');
				$currentCategoryKey              = array_search(-1, $categories);
				$categories[$currentCategoryKey] = $currentCategory;
			}
		}

		return $categories;
	}

	/**
	 *
	 * @return array
	 *
	 * @since 1.1.0
	 */
	public function getOrdering()
	{
		$result = [
			'order'     => '',
			'direction' => ''
		];

		if ($this->params->get('ordering', 'p.ordering ASC') == 'rand')
		{
			$result['order'] = Factory::getDbo()->getQuery(true)->Rand();
		}
		else
		{
			list($result['order'], $result['direction']) = explode(' ', $this->params->get('ordering', 'p.ordering ASC'));
		}

		return $result;
	}
}