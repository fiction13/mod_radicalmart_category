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

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;

// Include helper
\JLoader::register('modRadicalMartCategoryHelper', __DIR__ . '/src/Helpers/Helper.php');
\JLoader::register('RadicalMartHelperIntegration', JPATH_ADMINISTRATOR . '/components/com_radicalmart/helpers/integration.php');
RadicalMartHelperIntegration::initializeSite();

BaseDatabaseModel::addIncludePath(JPATH_SITE . '/components/com_radicalmart/models');

// Model
$model = BaseDatabaseModel::getInstance('Products', 'RadicalMartModel', array('ignore_request' => true));

// Helper
$helper   = new modRadicalMartCategoryHelper($params);

// Variables
$ordering        = $helper->getOrdering();
$categories      = $helper->getCategories();
$mode            = ComponentHelper::getParams('com_radicalmart')->get('mode', 'shop');
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');

$model->setState('params', Factory::getApplication()->getParams());
$model->setState('filter.categories', $categories);
$model->setState('filter.published', 1);
$model->setState('list.limit', (int) $params->get('limit', 12));
$model->setState('list.ordering', $ordering['order']);

// Order direction
if ($ordering['direction'])
{
    $model->setState('list.direction', $ordering['direction']);
}

// Get items
$items = $model->getItems();

require ModuleHelper::getLayoutPath($module->module, $params->get('layout', 'default'));
