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
 *  Created       : Thu Apr 21 15:28:07 2022
 *  Last Modified : <220421.1717>
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
  * TownOffical component helper.
  *
  * @param   string  $submenu  The name of the active view.
  *
  * @return  void
  *
  * @since   1.6
  */
abstract class TownOfficalHelper extends JHelperContent
{
  /**
    * Configure the Linkbar.
    *
    * @return Bool
    */
  
  public static function addSubmenu($submenu) 
  {
    JHtmlSidebar::addEntry(
                           JText::_('COM_TOWNOFFICAL_SUBMENU_OFFICIALS'),
                           'index.php?option=com_townoffical',
                           $submenu == 'townofficals'
                           );
    
    JHtmlSidebar::addEntry(
                           JText::_('COM_TOWNOFFICAL_SUBMENU_OFFICES'),
                           'index.php?option=com_categories&view=categories&extension=com_townoffical',
                           $submenu == 'categories'
                           );
    
    // Set some global property
    $document = JFactory::getDocument();
    $document->addStyleDeclaration('.icon-48-townoffical ' .
                                   '{background-image: url(../media/com_townoffical/images/offical-48x48.png);}');
    if ($submenu == 'categories') 
    {
      $document->setTitle(JText::_('COM_TOWNOFFICAL_ADMINISTRATION_OFFICES'));
    }
  }
}
