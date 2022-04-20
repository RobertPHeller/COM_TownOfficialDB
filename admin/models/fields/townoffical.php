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
 *  Created       : Wed Apr 20 13:57:55 2022
 *  Last Modified : <220420.1402>
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

// import the list field type
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

/**
  * TownOffical Form Field class for the TownOffical component
  *
  * @since  0.0.1
  */
class JFormFieldTownOffical extends JFormFieldList
{
  /**
    * The field type.
    *
    * @var         string
    */
  protected $type = 'TownOffical';
  
  /**
    * Method to get a list of options for a list input.
    *
    * @return  array  An array of JHtml options.
    */
  protected function getOptions()
  {
    $db    = JFactory::getDBO();
    $query = $db->getQuery(true);
    $query->select('id,office,name');
    $query->from('#__townoffical');
    $db->setQuery((string) $query);
    $messages = $db->loadObjectList();
    $options  = array();
    
    if ($messages)
    {
      foreach ($messages as $message)
      {
        $options[] = JHtml::_('select.option', $message->id, $message->office . ' ' . $message->name);
      }
    }
    
    $options = array_merge(parent::getOptions(), $options);
    
    return $options;
  }
}
