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
 *  Created       : Wed Apr 20 14:43:11 2022
 *  Last Modified : <220430.1237>
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
  * TownOfficalList Model
  *
  * @since  0.0.1
  */
class TownOfficalModelTownOfficals extends JModelList
{
  /**
    * Constructor.
    *
    * @param   array  $config  An optional associative array of configuration settings.
    *
    * @see     JController
    * @since   1.6
    */
  public function __construct($config = array())
  {
    if (empty($config['filter_fields']))
    {
      $config['filter_fields'] = array(
                                       'id',
                                       'catid',
                                       'name',
                                       'author',
                                       'created',
                                       'published'
                                       );
    }
    
    parent::__construct($config);
  }
  /**
    * Method to build an SQL query to load the list data.
    *
    * @return      string  An SQL query
    */
  protected function getListQuery()
  {
    // Initialize variables.
    $db    = JFactory::getDbo();
    $query = $db->getQuery(true);
    
    // Create the base select statement.
    $query->select( 'a.id as id, a.name as name, a.auxoffice as auxoffice,'
                   .'a.termends as termends, a.iselected as iselected,'
                   .'a.published as published, a.created as created,'
                   .'a.checked_out as checked_out, a.checked_out_time as checked_out_time')
          ->from($db->quoteName('#__townoffical', 'a'));
    
    // Join over the categories (offices).
    $query->select($db->quoteName('c.title', 'office'))
           ->join('LEFT', $db->quoteName('#__categories', 'c') . 
                  ' ON c.id = a.catid');
           
    // Join with users table to get the username of the author
    $query->select($db->quoteName('u.username', 'author'))
          ->join('LEFT', $db->quoteName('#__users', 'u') . ' ON u.id = a.created_by');
          
    // Join with users table to get the username of the person who checked the record out
    $query->select($db->quoteName('u2.username', 'editor'))
          ->join('LEFT', $db->quoteName('#__users', 'u2') . ' ON u2.id = a.checked_out');
          
    // Filter: like / search
    $search = $this->getState('filter.search');
    
    if (!empty($search))
    {
      $like = $db->quote('%' . $search . '%');
      $query->where('a.name LIKE ' . $like);
    }
    
    // Filter by published state
    $published = $this->getState('filter.published');
    
    if (is_numeric($published))
    {
      $query->where('a.published = ' . (int) $published);
    }
    elseif ($published === '')
    {
      $query->where('(a.published IN (0, 1))');
    }
    // Filter by Office
    $catid = $this->getState('filter.catid');
    
    if (is_numeric($catid))
    {
      $query->where('a.catid = ' . (int) $catid);
    }
    
    // Filter by elected or not
    $iselected = $this->getState('filter.iselected');
    if (is_numeric($iselected))
    {
      $query->where('a.iselected = ' . (int) $iselected);
    }
    
    // Add the list ordering clause.
    $orderCol= $this->state->get('list.ordering', 'office');
    $orderDirn = $this->state->get('list.direction', 'asc');
    
    $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
    
    return $query;
  }
  
  public function getOfficalsDataAsIterator()
  {
    // Initialize variables.
    $db    = JFactory::getDbo();
    $query = $db->getQuery(true);
    
    // Create the base select statement.
    $query->select( 'a.name as name, a.auxoffice as auxoffice,'
                   .'a.termends as termends, a.iselected as iselected,'
                   .'a.swornindate as swornindate,'
                   .'a.ethicsexpires as ethicsexpires, a.email as email,'
                   .'a.telephone as telephone, a.notes as notes')
          ->from($db->quoteName('#__townoffical', 'a'));
    
    // Join over the categories (offices).
    $query->select($db->quoteName('c.title', 'office'))
           ->join('LEFT', $db->quoteName('#__categories', 'c') . 
                  ' ON c.id = a.catid');
    $db->setQuery($query);
    return $db->getIterator();       
           
  }
}
