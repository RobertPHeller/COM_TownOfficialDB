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
 *  Created       : Thu Apr 28 13:37:30 2022
 *  Last Modified : <220428.1651>
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
  * Get import information: file and delimeters, etc.
  *
  */

class townofficalViewimportform extends JViewLegacy
{
  protected $canDo;
  
  /**
    * Import Form display method
    * @return void
    **/
  function display($tpl = null)
  {
    $this->form = $this->get('Form');
    //set toolbar
    $this->addToolBar();
    // Display the template
    parent::display($tpl);
    
    // Set the document
    $this->setDocument();
  }
  /**
    * Setting the toolbar
    */
  protected function addToolBar() 
  {
    
    JToolBarHelper::title(JText::_('COM_TOWNOFFICAL_IMPORT'));
    
    JToolBarHelper::custom( 'townofficals.doimport', 'upload.png', 'upload.png', 'Import', false);
    JToolBarHelper::cancel('townofficals.cancel', 'JTOOLBAR_CLOSE');
  }
  protected function setDocument() 
  {
    $document = JFactory::getDocument();
    $document->setTitle(JText::_('COM_TOWNOFFICAL_IMPORT'));
  }
  
}

