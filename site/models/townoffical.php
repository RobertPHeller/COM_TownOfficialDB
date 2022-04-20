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
 *  Created       : Wed Apr 20 13:34:35 2022
 *  Last Modified : <220420.1407>
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

// import Joomla modelitem library
jimport('joomla.application.component.modelitem');

/**
  * TownOffical Model
  *
  * @since  0.0.1
  */
class TownOfficalModelTownOffical extends JModelItem
{
  /**
    * @var array messages
    */
  protected $messages;
  
  /**
    * Method to get a table object, load it if necessary.
    *
    * @param   string  $type    The table name. Optional.
    * @param   string  $prefix  The class prefix. Optional.
    * @param   array   $config  Configuration array for model. Optional.
    *
    * @return  JTable  A JTable object
    *
    * @since   1.6
    */
  public function getTable($type = 'TownOffical', $prefix = 'TownOfficalTable', $config = array())
  {
    return JTable::getInstance($type, $prefix, $config);
  }
  
  /**
    * Get the message
    *
    * @return  string  The message to be displayed to the user
    */
  public function getMsg($id = 1)
  {
    if (!is_array($this->messages))
    {
      $this->messages = array();
    }
    
    if (!isset($this->messages[$id]))
    {
      $jinput = JFactory::getApplication()->input;
      $id     = $jinput->get('id', 1, 'INT');
      
      // Get a TableTownOffical instance
      $table = $this->getTable();
    
      // Load the message
      $table->load($id);
    
      // Assign the message
      $this->messages[$id] = $table->office . ' ' . $table->name;
    }
    
    return $this->messages[$id];
  }
}
