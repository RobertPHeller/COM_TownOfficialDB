<?php
/* -*- php -*- ****************************************************************
 *
 *  System        : 
 *  Module        : 
 *  Object Name   : $RCSfile$
 *  Revision      : $Revision$
 *  Date          : $Date$
 *  Author        : $Author$
 *  Created By    : Robert Heller
 *  Created       : Wed Apr 20 16:37:54 2022
 *  Last Modified : <220430.1430>
 *
 *  Description	
 *
 *  Notes
 *
 *  History
 *	
 ****************************************************************************
 *
 *    Copyright (C) 2022  Robert Heller D/B/A Deepwoods Software
 *			51 Locke Hill Road
 *			Wendell, MA 01379-9728
 *
 *    This program is free software; you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation; either version 2 of the License, or
 *    (at your option) any later version.
 *
 *    This program is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with this program; if not, write to the Free Software
 *    Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.
 *
 * 
 *
 ****************************************************************************/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
  * TownOffical View
  *
  * @since  0.0.1
  */
class TownOfficalViewTownOffical extends JViewLegacy
{
  /**
    * View form
    *
    * @var         form
    */
  protected $form = null;
  protected $item;
  protected $script;
  protected $canDo;
  
  /**
    * Display the Hello World view
    *
    * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
    *
    * @return  void
    */
  public function display($tpl = null)
  {
    // Get the Data
    $this->form = $this->get('Form');
    $this->item = $this->get('Item');
    $this->script = $this->get('Script');
    
    // What Access Permissions does this user have? What can (s)he do?
    $this->canDo = JHelperContent::getActions('com_townoffical', 'townoffical', $this->item->id);
    
    // Check for errors.
    if (count($errors = $this->get('Errors')))
    {
      JError::raiseError(500, implode('<br />', $errors));
      
      return false;
    }
    
    
    // Set the toolbar
    $this->addToolBar();
    
    // Display the template
    parent::display($tpl);
    
    // Set the document
    $this->setDocument();
  }
  
  /**
    * Add the page title and toolbar.
    *
    * @return  void
    *
    * @since   1.6
    */
  protected function addToolBar()
  {
    $input = JFactory::getApplication()->input;
    
    // Hide Joomla Administrator Main menu
    $input->set('hidemainmenu', true);
    
    $isNew = ($this->item->id == 0);
    
    JToolBarHelper::title($isNew ? JText::_('COM_TOWNOFFICAL_MANAGER_TOWNOFFICAL_NEW')
                                 :  JText::_('COM_TOWNOFFICAL_MANAGER_TOWNOFFICAL_EDIT'));
    
    // Build the actions for new and existing records.
    if ($isNew)
    {
      // For new records, check the create permission.
      if ($this->canDo->get('core.create'))
      {
        JToolBarHelper::apply('townoffical.apply', 'JTOOLBAR_APPLY');
        JToolbarHelper::save('townoffical.save', 'JTOOLBAR_SAVE');
        JToolBarHelper::custom('townoffical.save2new', 'save-new.png', 
                               'save-new_f2.png',
                               'JTOOLBAR_SAVE_AND_NEW', false);
      }                               
      JToolbarHelper::cancel('townoffical.cancel','JTOOLBAR_CANCEL');
    }
    else
    {
      if ($this->canDo->get('core.edit'))
      {
        JToolBarHelper::apply('townoffical.apply', 'JTOOLBAR_APPLY');
        JToolbarHelper::save('townoffical.save', 'JTOOLBAR_SAVE');
        
        // We can save this record, but check the create permission to see
        // if we can return to make a new one.
        if ($this->canDo->get('core.create'))
        {
          JToolBarHelper::custom('townoffical.save2new', 'save-new.png', 
                               'save-new_f2.png',
                               'JTOOLBAR_SAVE_AND_NEW', false);
        }
      }
      if ($this->canDo->get('core.create')) 
      {
        JToolBarHelper::custom('townoffical.save2copy', 'save-copy.png', 'save-copy_f2.png',
                               'JTOOLBAR_SAVE_AS_COPY', false);
      }
      JToolBarHelper::cancel('townoffical.cancel', 'JTOOLBAR_CLOSE');
    }
    JToolBarHelper::divider();
    JToolBarHelper::help('TownOffical',true);
  }
  /**
    * Method to set up the document properties
    *
    * @return void
    */
  protected function setDocument() 
  {
    $isNew = ($this->item->id < 1);
    $document = JFactory::getDocument();
    $document->setTitle($isNew ? JText::_('COM_TOWNOFFICAL_TOWNOFFICAL_CREATING') :
                        JText::_('COM_TOWNOFFICAL_TOWNOFFICAL_EDITING'));
    $document->addScript(JURI::root() . $this->script);
    $document->addScript(JURI::root() . "/administrator/components/com_townoffical"
                         . "/views/townoffical/submitbutton.js");
    JText::script('COM_TOWNOFFICAL_TOWNOFFICAL_ERROR_UNACCEPTABLE');
  }
}
