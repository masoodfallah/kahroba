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
 * View to edit a product.
 *
 * @since  1.6
 */
class ProductViewProduct extends JViewLegacy
{
	/**
	 * The JForm object
	 *
	 * @var  JForm
	 */
	protected $form;

	/**
	 * The active item
	 *
	 * @var  object
	 */
	protected $item;

	/**
	 * The model state
	 *
	 * @var  object
	 */
	protected $state;

	/**
	 * Display the view.
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise an Error object.
	 */
	public function display($tpl = null)
	{
		// Initialise variables.
		$this->form  = $this->get('Form');
		$this->item  = $this->get('Item');
		$this->state = $this->get('State');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));

			return false;
		}

		if ($this->getLayout() == 'modal')
		{
			$this->form->setFieldAttribute('language', 'readonly', 'true');
			$this->form->setFieldAttribute('catid', 'readonly', 'true');
		}

		$this->addToolbar();

		return parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function addToolbar()
	{
		JFactory::getApplication()->input->set('hidemainmenu', true);

		$user       = JFactory::getUser();
		$userId     = $user->id;
		$isNew      = ($this->item->id == 0);
		$checkedOut = !($this->item->checked_out == 0 || $this->item->checked_out == $userId);

		// Since we don't track these assets at the item level, use the category id.
		$canDo = JHelperContent::getActions('com_product', 'category', $this->item->catid);

		JToolbarHelper::title($isNew ? JText::_('COM_PRODUCT_MANAGER_PRODUCT_NEW') : JText::_('COM_PRODUCT_MANAGER_PRODUCT_EDIT'), 'address product');

		// Build the actions for new and existing records.
		if ($isNew)
		{
			// For new records, check the create permission.
			if ($isNew && (count($user->getAuthorisedCategories('com_product', 'core.create')) > 0))
			{
				JToolbarHelper::apply('product.apply');
				JToolbarHelper::save('product.save');
				JToolbarHelper::save2new('product.save2new');
			}

			JToolbarHelper::cancel('product.cancel');
		}
		else
		{
			// Since it's an existing record, check the edit permission, or fall back to edit own if the owner.
			$itemEditable = $canDo->get('core.edit') || ($canDo->get('core.edit.own') && $this->item->created_by == $userId);

			// Can't save the record if it's checked out and editable
			if (!$checkedOut && $itemEditable)
			{
				JToolbarHelper::apply('product.apply');
				JToolbarHelper::save('product.save');

				// We can save this record, but check the create permission to see if we can return to make a new one.
				if ($canDo->get('core.create'))
				{
					JToolbarHelper::save2new('product.save2new');
				}
			}

			// If checked out, we can still save
			if ($canDo->get('core.create'))
			{
				JToolbarHelper::save2copy('product.save2copy');
			}

			if ($this->state->params->get('save_history', 0) && $itemEditable)
			{
				JToolbarHelper::versions('com_product.product', $this->item->id);
			}

			JToolbarHelper::cancel('product.cancel', 'JTOOLBAR_CLOSE');
		}

		JToolbarHelper::divider();
		JToolbarHelper::help('JHELP_COMPONENTS_PRODUCTS_PRODUCTS_EDIT');
	}
}
