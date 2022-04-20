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
 *  Created       : Wed Apr 20 13:21:57 2022
 *  Last Modified : <220420.1337>
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
  * HTML View class for the TownOffical Component
  *
  * @since  0.0.1
  */
class TownOfficalViewTownOffical extends JViewLegacy
{
  /**
    * Display the Town Offical view
    *
    * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
    *
    * @return  void
    */
  function display($tpl = null)
  {
    // Assign data to the view
    $this->msg = $this->get('Msg');
    
    // Check for errors.
    if (count($errors = $this->get('Errors')))
    {
      JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');
      
      return false;
    }
    
    // Display the view
    parent::display($tpl);
  }
}
