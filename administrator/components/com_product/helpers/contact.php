<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_product
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Product component helper.
 *
 * @since  1.6
 */
class ProductHelper extends JHelperContent
{
	/**
	 * Configure the Linkbar.
	 *
	 * @param   string  $vName  The name of the active view.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	public static function addSubmenu($vName)
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_PRODUCT_SUBMENU_PRODUCTS'),
			'index.php?option=com_product&view=productS',
			$vName == 'productS'
		);

		JHtmlSidebar::addEntry(
			JText::_('COM_PRODUCT_SUBMENU_CATEGORIES'),
			'index.php?option=com_categories&extension=com_product',
			$vName == 'categories'
		);
	}

	/**
	 * Adds Count Items for Category Manager.
	 *
	 * @param   stdClass[]  &$items  The product category objects
	 *
	 * @return  stdClass[]
	 *
	 * @since   3.5
	 */
	public static function countItems(&$items)
	{
		$db = JFactory::getDbo();

		foreach ($items as $item)
		{
			$item->count_trashed = 0;
			$item->count_archived = 0;
			$item->count_unpublished = 0;
			$item->count_published = 0;
			$query = $db->getQuery(true);
			$query->select('published AS state, count(*) AS count')
				->from($db->qn('#__product_details'))
				->where('catid = ' . (int) $item->id)
				->group('published');
			$db->setQuery($query);
			$productS = $db->loadObjectList();

			foreach ($productS as $product)
			{
				if ($product->state == 1)
				{
					$item->count_published = $product->count;
				}

				if ($product->state == 0)
				{
					$item->count_unpublished = $product->count;
				}

				if ($product->state == 2)
				{
					$item->count_archived = $product->count;
				}

				if ($product->state == -2)
				{
					$item->count_trashed = $product->count;
				}
			}
		}

		return $items;
	}
}
