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
 *  Last Modified : <220422.1311>
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
    * @var object item
    */
  protected $item;
  
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
    * Method to auto-populate the model state.
    *
    * This method should only be called once per instantiation and is designed
    * to be called on the first call to the getState() method unless the model
    * configuration flag to ignore the request is set.
    *
    * Note. Calling getState in this method will result in recursion.
    *
    * @returnvoid
    * @since2.5
    */
  protected function populateState()
  {
    // Get the message id
    $jinput = JFactory::getApplication()->input;
    $id     = $jinput->get('id', 1, 'INT');
    $this->setState('message.id', $id);
    
    // Load the parameters.
    $this->setState('params', JFactory::getApplication()->getParams());
    parent::populateState();
  }
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
  public function getTable($type = 'HelloWorld', $prefix = 'HelloWorldTable', $config = array())
  {
    return JTable::getInstance($type, $prefix, $config);
  }
  
  /**
    * Get the message
    * @return object The message to be displayed to the user
    */
  public function getItem()
  {
    if (!isset($this->item)) 
    {
      $id    = $this->getState('message.id');
      $db    = JFactory::getDbo();
      $query = $db->getQuery(true);
      $query->select('o.name, o.params, c.title as office')
      ->from('#__townoffical as o')
      ->leftJoin('#__categories as c ON o.catid=c.id')
      ->where('o.id=' . (int)$id);
      $db->setQuery((string)$query);
      
      if ($this->item = $db->loadObject()) 
      {
        // Load the JSON string
        $params = new JRegistry;
        $params->loadString($this->item->params, 'JSON');
        $this->item->params = $params;
        
        // Merge global params with item params
        $params = clone $this->getState('params');
        $params->merge($this->item->params);
        $this->item->params = $params;
      }
    }
    return $this->item;
  }
}
