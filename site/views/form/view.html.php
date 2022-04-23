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
 *  Created       : Sat Apr 23 11:58:45 2022
 *  Last Modified : <220423.1200>
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
  * This is the site view presenting the user with the ability to add a new TownOffical record
  * 
  */
class TownOfficalViewForm extends JViewLegacy
{
  
  protected $form = null;
  protected $canDo;
  
  /**
    * Display the Town Offical view
    *
    * @param   string  $tpl  The name of the layout file to parse.
    *
    * @return  void
    */
  public function display($tpl = null)
  {
    // Get the form to display
    $this->form = $this->get('Form');
    // Get the javascript script file for client-side validation
    $this->script = $this->get('Script'); 
    
    // Check that the user has permissions to create a new townoffical record
    $this->canDo = JHelperContent::getActions('com_townoffical');
    if (!($this->canDo->get('core.create'))) 
    {
      $app = JFactory::getApplication(); 
      $app->enqueueMessage(JText::_('JERROR_ALERTNOAUTHOR'), 'error');
      $app->setHeader('status', 403, true);
      return;
    }
    
    // Check for errors.
    if (count($errors = $this->get('Errors')))
    {
      throw new Exception(implode("\n", $errors), 500);
    }
    
    // Call the parent display to display the layout file
    parent::display($tpl);
    
    // Set properties of the html document
    $this->setDocument();
  }
  
  /**
    * Method to set up the html document properties
    *
    * @return void
    */
  protected function setDocument() 
  {
    $document = JFactory::getDocument();
    $document->setTitle(JText::_('COM_TOWNOFFICAL_TOWNOFFICAL_CREATING'));
    $document->addScript(JURI::root() . $this->script);
    $document->addScript(JURI::root() . "/administrator/components/com_townoffical"
                         . "/views/townoffical/submitbutton.js");
    JText::script('COM_TOWNOFFICAL_TOWNOFFICAL_ERROR_UNACCEPTABLE');
  }
}


