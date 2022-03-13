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

\JLoader::register('RadicalMartHelperIntegration', JPATH_ADMINISTRATOR . '/components/com_radicalmart/helpers/integration.php');
RadicalMartHelperIntegration::initializeSite();

BaseDatabaseModel::addIncludePath(JPATH_SITE . '/components/com_radicalmart/models');
$model = BaseDatabaseModel::getInstance('Products', 'RadicalMartModel', array('ignore_request' => true));

$mode = ComponentHelper::getParams('com_radicalmart')->get('mode', 'shop');

list($order, $direction) = explode(' ', $params->get('ordering', 'p.ordering ASC'));

$model->setState('params', Factory::getApplication()->getParams());
$model->setState('filter.categories', $params->get('categories', array()));
$model->setState('filter.published', 1);
$model->setState('list.limit', (int) $params->get('limit', 12));
$model->setState('list.ordering', $order);
$model->setState('list.direction', $direction);

$items = $model->getItems();

require ModuleHelper::getLayoutPath($module->module, $params->get('layout', 'default'));
