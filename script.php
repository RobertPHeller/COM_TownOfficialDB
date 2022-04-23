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
 *  Created       : Sat Apr 23 10:48:22 2022
 *  Last Modified : <220423.1050>
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
  * Script file of TownOffical component.
  *
  * The name of this class is dependent on the component being installed.
  * The class name should have the component's name, directly followed by
  * the text InstallerScript (ex:. com_townOfficalInstallerScript).
  *
  * This class will be called by Joomla!'s installer, if specified in your component's
  * manifest file, and is used for custom automation actions in its installation process.
  *
  * In order to use this automation script, you should reference it in your component's
  * manifest file as follows:
  * <scriptfile>script.php</scriptfile>
  *
  * @package     Joomla.Administrator
  * @subpackage  com_townoffical
  *
  * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
  * @license     GNU General Public License version 2 or later; see LICENSE.txt
  */
class com_townOfficalInstallerScript
{
  /**
    * This method is called after a component is installed.
    *
    * @param  \stdClass $parent - Parent object calling this method.
    *
    * @return void
    */
  public function install($parent) 
  {
    $parent->getParent()->setRedirectURL('index.php?option=com_townoffical');
  }
  
  /**
    * This method is called after a component is uninstalled.
    *
    * @param  \stdClass $parent - Parent object calling this method.
    *
    * @return void
    */
  public function uninstall($parent) 
  {
    echo '<p>' . JText::_('COM_TOWNOFFICAL_UNINSTALL_TEXT') . '</p>';
  }
  
  /**
    * This method is called after a component is updated.
    *
    * @param  \stdClass $parent - Parent object calling object.
    *
    * @return void
    */
  public function update($parent) 
  {
    echo '<p>' . JText::sprintf('COM_TOWNOFFICAL_UPDATE_TEXT', $parent->get('manifest')->version) . '</p>';
  }
  
  /**
    * Runs just before any installation action is performed on the component.
    * Verifications and pre-requisites should run in this function.
    *
    * @param  string    $type   - Type of PreFlight action. Possible values are:
    *                           - * install
    *                           - * update
    *                           - * discover_install
    * @param  \stdClass $parent - Parent object calling object.
    *
    * @return void
    */
  public function preflight($type, $parent) 
  {
    echo '<p>' . JText::_('COM_TOWNOFFICAL_PREFLIGHT_' . $type . '_TEXT') . '</p>';
  }
  
  /**
    * Runs right after any installation action is performed on the component.
    *
    * @param  string    $type   - Type of PostFlight action. Possible values are:
    *                           - * install
    *                           - * update
    *                           - * discover_install
    * @param  \stdClass $parent - Parent object calling object.
    *
    * @return void
    */
  function postflight($type, $parent) 
  {
    echo '<p>' . JText::_('COM_TOWNOFFICAL_POSTFLIGHT_' . $type . '_TEXT') . '</p>';
  }
}
