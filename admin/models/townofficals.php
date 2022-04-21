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
 *  Last Modified : <220421.1749>
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
                                       'office',
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
                   .'a.published as published')
          ->from($db->quoteName('#__townoffical', 'a'));
    
    // Join over the categories (offices).
    $query->select($db->quoteName('c.title', 'office'))
           ->join('LEFT', $db->quoteName('#__categories', 'c') . 
                  ' ON c.id = a.catid');
    
    // Filter: like / search
    $search = $this->getState('filter.search');
    
    if (!empty($search))
    {
      $like = $db->quote('%' . $search . '%');
      $query->where('office LIKE ' . $like);
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
    
    // Add the list ordering clause.
    $orderCol= $this->state->get('list.ordering', 'office');
    $orderDirn = $this->state->get('list.direction', 'asc');
    
    $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
    
    return $query;
  }
}
