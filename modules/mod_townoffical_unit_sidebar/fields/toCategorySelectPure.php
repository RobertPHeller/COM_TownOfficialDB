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
 *  Created       : Wed Apr 27 09:27:12 2022
 *  Last Modified : <220427.0945>
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

defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

/**
  * Form Field class
  *
  */
class JFormFieldtoCategorySelectPure extends JFormFieldList
{
  /**
    * The form field type.
    *
    * @var         string
    */
  protected $type = 'toCategorySelectPure';
  /**
    * Method to get the field options.
    *
    * @return      array   The field option objects.
    */
  protected function getOptions()
  {
    // Initialise variables.
    $options = array();
    $db     = JFactory::getDbo();
    $query  = $db->getQuery(true);
    $query->select('id AS value, title AS text');
    $query->from('#__categories');
    $query->where('published = 1 AND extension="com_townoffical"');
    $db->setQuery($query);
    $options = $db->loadObjectList();
    // Check for a database error.
    if ($db->getErrorNum()) {
      JError::raiseWarning(500, $db->getErrorMsg());
    }
    // Initialise variables.
    $user = JFactory::getUser();
    if (empty($id)) {
      // New item, only have to check core.create.
      foreach ($options as $i => $option)
      {
        // Unset the option if the user isn't authorised for it.
        if (!$user->authorise('core.create', 'com_townoffical.category.'.$option->value))
        {
          unset($options[$i]);
        }
      }
    }
    else
    {
      // Existing item is a bit more complex. Need to account for core.edit and core.edit.own.
      foreach ($options as $i => $option)
      {
        // Unset the option if the user isn't authorised for it.
        if (!$user->authorise('core.edit', 'com_townoffical.category.'.$option->value))
        {
          // As a backup, check core.edit.own
          if (!$user->authorise('core.edit.own', 'com_townoffical.category.'.$option->value))
          {
            // No core.edit nor core.edit.own - bounce this one
            unset($options[$i]);
          }
          else
          {
            // TODO I've got a funny feeling we need to check core.create here.
            // Maybe you can only get the list of categories you are allowed to create in?
            // Need to think about that. If so, this is the place to do the check.
          }
        }
      }
    }
    // Merge any additional options in the XML definition.
    $options = array_merge(parent::getOptions(), $options);
    return $options;
  }
}

                              
