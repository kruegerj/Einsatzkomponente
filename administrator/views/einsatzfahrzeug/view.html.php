<?php
/**
 * @version     3.0.0
 * @package     com_einsatzkomponente
 * @copyright   Copyright (C) by Ralf Meyer 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Ralf Meyer <webmaster@feuerwehr-veenhusen.de> - http://einsatzkomponente.de
 */
// No direct access
defined('_JEXEC') or die;
jimport('joomla.application.component.view');
/**
 * View to edit
 */
class EinsatzkomponenteViewEinsatzfahrzeug extends JViewLegacy
{
	protected $state;
	protected $item;
	protected $form;
	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->state	= $this->get('State');
		$this->item		= $this->get('Item');
		$this->form		= $this->get('Form');
		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
            throw new Exception(implode("\n", $errors));
		}
		$this->addToolbar();
		parent::display($tpl);
	}
	/**
	 * Add the page title and toolbar.
	 */
	protected function addToolbar()
	{
		JFactory::getApplication()->input->set('hidemainmenu', true);
		$user		= JFactory::getUser();
		$isNew		= ($this->item->id == 0);
        if (isset($this->item->checked_out)) {
		    $checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));
        } else {
            $checkedOut = false;
        }
		$canDo		= EinsatzkomponenteHelper::getActions();
		JToolBarHelper::title(JText::_('COM_EINSATZKOMPONENTE_TITLE_EINSATZFAHRZEUG'), 'einsatzfahrzeug.png');
		// If not checked out, can save the item.
		if (!$checkedOut && ($canDo->get('core.edit')||($canDo->get('core.create'))))
		{
			JToolBarHelper::apply('einsatzfahrzeug.apply', 'JTOOLBAR_APPLY');
			JToolBarHelper::save('einsatzfahrzeug.save', 'JTOOLBAR_SAVE');
		}
		if (!$checkedOut && ($canDo->get('core.create'))){
			JToolBarHelper::custom('einsatzfahrzeug.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
		}
		// If an existing item, can save to a copy.
		if (!$isNew && $canDo->get('core.create')) {
			JToolBarHelper::custom('einsatzfahrzeug.save2copy', 'save-copy.png', 'save-copy_f2.png', 'JTOOLBAR_SAVE_AS_COPY', false);
		}
		if (empty($this->item->id)) {
			JToolBarHelper::cancel('einsatzfahrzeug.cancel', 'JTOOLBAR_CANCEL');
		}
		else {
			JToolBarHelper::cancel('einsatzfahrzeug.cancel', 'JTOOLBAR_CLOSE');
		}
	}
}
