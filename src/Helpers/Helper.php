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

use Joomla\Registry\Registry;
use Joomla\CMS\Factory;

class modRadicalMartCategoryHelper
{
    /**
     * @var array
     *
     * @since 1.1.0
     */
    protected $params = [];

    /**
     * @param Registry $params
     *
     * @throws Exception
     */
    public function __construct(Registry $params)
    {
        $this->params = $params;
        $this->input  = Factory::getApplication()->input;
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