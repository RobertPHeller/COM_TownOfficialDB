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
 *  Created       : Wed Apr 20 14:09:16 2022
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

// No direct access
defined('_JEXEC') or die('Restricted access');

/**
  * TownOffical Table class
  *
  * @since  0.0.1
  */
class TownOfficalTableTownOffical extends JTable
{
  /**
    * Constructor
    *
    * @param   JDatabaseDriver  &$db  A database connector object
    */
  function __construct(&$db)
  {
    parent::__construct('#__townoffical', 'id', $db);
  }
  /**
    * Overloaded bind function
    *
    * @param       array           named array
    * @return      null|string     null is operation was satisfactory, otherwise returns an error
    * @see JTable:bind
    * @since 1.5
    */
  public function bind($array, $ignore = '')
  {
    if (isset($array['params']) && is_array($array['params']))
    {
      // Convert the params field to a string.
      $parameter = new JRegistry;
      $parameter->loadArray($array['params']);
      $array['params'] = (string)$parameter;
    }
    
    // Bind the rules.
    if (isset($array['rules']) && is_array($array['rules']))
    {
      $rules = new JAccessRules($array['rules']);
      $this->setRules($rules);
    }
    return parent::bind($array, $ignore);
  }
  /**
    * Method to compute the default name of the asset.
    * The default name is in the form `table_name.id`
    * where id is the value of the primary key of the table.
    *
    * @returnstring
    * @since2.5
    */
  protected function _getAssetName()
  {
    $k = $this->_tbl_key;
    return 'com_townoffical.townoffical.'.(int) $this->$k;
  }
  /**
    * Method to return the title to use for the asset table.
    *
    * @returnstring
    * @since2.5
    */
  protected function _getAssetTitle()
  {
    return $this->name;
  }
  /**
    * Method to get the asset-parent-id of the item
    *
    * @returnint
    */
  protected function _getAssetParentId(JTable $table = NULL, $id = NULL)
  {
    // We will retrieve the parent-asset from the Asset-table
    $assetParent = JTable::getInstance('Asset');
    // Default: if no asset-parent can be found we take the global asset
    $assetParentId = $assetParent->getRootId();
    
    // Find the parent-asset
    if (($this->catid)&& !empty($this->catid))
    {
      // The item has a category as asset-parent
      $assetParent->loadByName('com_townoffical.category.' . (int) $this->catid);
    }
    else
    {
      // The item has the component as asset-parent
      $assetParent->loadByName('com_townoffical');
    }
    
    // Return the found asset-parent-id
    if ($assetParent->id)
    {
      $assetParentId=$assetParent->id;
    }
    return $assetParentId;
  }
  /**
    * Overriden JTable::store to set modified data.
    *
    * @param   boolean  $updateNulls  True to update fields even if they are null.
    *
    * @return  boolean  True on success.
    *
    * @since   1.6
    */
  public function store($updateNulls = false)
  {
    $date = JFactory::getDate();
    $user = JFactory::getUser();
    
    $this->modified = $date->toSql();
    
    if ($this->id)
    {
      // Existing item
      $this->modified_by = $user->get('id');
    }
    else
    {
      // New town offical. 
      $this->created = $date->toSql();
      $this->created_by = $user->get('id');
    }
    return parent::store($updateNulls);
  }
}
