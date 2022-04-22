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
 *  Created       : Wed Apr 20 14:26:51 2022
 *  Last Modified : <220422.1713>
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

// import Joomla view library
jimport('joomla.application.component.view');

/**
  * TownOfficals View
  *
  * @since  0.0.1
  */
class TownOfficalViewTownOfficals extends JViewLegacy
{
  /**
    * Display the Town Officals view
    *
    * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
    *
    * @return  void
    */
  function display($tpl = null)
  {
    // Get application
    $app = JFactory::getApplication();
    $context = "townoffical.list.admin.townoffical";
    // Get data from the model
    $this->items= $this->get('Items');
    $this->pagination= $this->get('Pagination');
    $this->state= $this->get('State');
    $this->filter_order = $app->getUserStateFromRequest($context.'filter_order', 'filter_order', 'office', 'cmd');
    $this->filter_order_Dir = $app->getUserStateFromRequest($context.'filter_order_Dir', 'filter_order_Dir', 'asc', 'cmd');
    $this->filter_order_Dir = $app->getUserStateFromRequest($context.'filter_order_Dir', 'filter_order_Dir', 'asc', 'cmd');
    $this->filterForm    = $this->get('FilterForm');
    $this->activeFilters = $this->get('ActiveFilters');
    
    // What Access Permissions does this user have? What can (s)he do?
    $this->canDo = JHelperContent::getActions('com_townoffical');
    
    // Check for errors.
    if (count($errors = $this->get('Errors')))
    {
      JError::raiseError(500, implode('<br />', $errors));
      
      return false;
    }
    
    // Set the submenu
    TownOfficalHelper::addSubmenu('townofficals');
    
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
    $title = JText::_('COM_TOWNOFFICAL_MANAGER_TOWNOFFICALS');
    
    if ($this->pagination->total)
    {
      $title .= "<span style='font-size: 0.5em; vertical-align: middle;'>(" . $this->pagination->total . ")</span>";
    }
    
    JToolBarHelper::title($title, 'townoffical');
    
    if ($this->canDo->get('core.create'))
    {
      JToolbarHelper::addNew('townoffical.add', 'JTOOLBAR_NEW');
    }
    if ($this->canDo->get('core.edit')) 
    {
      JToolbarHelper::editList('townoffical.edit', 'JTOOLBAR_EDIT');
    }
    if ($this->canDo->get('core.delete'))
    {
      JToolbarHelper::deleteList('', 'townofficals.delete', 'JTOOLBAR_DELETE');
    }
    if ($this->canDo->get('core.admin'))
    {
      JToolBarHelper::divider();
      JToolBarHelper::preferences('com_townoffical');
    }
  }
  /**
    * Method to set up the document properties
    *
    * @return void
    */
  protected function setDocument() 
  {
    $document = JFactory::getDocument();
    $document->setTitle(JText::_('COM_TOWNOFFICAL_ADMINISTRATION'));
  }
}
