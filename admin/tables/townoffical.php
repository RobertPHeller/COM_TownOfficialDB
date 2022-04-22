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
 *  Last Modified : <220422.1255>
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
    return parent::bind($array, $ignore);
  }
}
