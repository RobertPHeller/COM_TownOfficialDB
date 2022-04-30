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
 *  Created       : Wed Apr 20 16:41:56 2022
 *  Last Modified : <220430.0844>
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
  * TownOffical Model
  *
  * @since  0.0.1
  */
class TownOfficalModelTownOffical extends JModelAdmin
{
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
    * Method to get the record form.
    *
    * @param   array    $data      Data for the form.
    * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
    *
    * @return  mixed    A JForm object on success, false on failure
    *
    * @since   1.6
    */
  public function getForm($data = array(), $loadData = true)
  {
    // Get the form.
    $form = $this->loadForm(
                            'com_townoffical.townoffical',
                            'townoffical',
                            array(
                                  'control' => 'jform',
                                  'load_data' => $loadData
                                  )
                            );
    
    if (empty($form))
    {
      return false;
    }
    
    return $form;
  }
  
  /**
    * Method to get the script that have to be included on the form
    *
    * @return stringScript files
    */
  public function getScript() 
  {
    return 'administrator/components/com_townoffical/models/forms/townoffical.js';
  }
  /**
    * Method to get the data that should be injected in the form.
    *
    * @return  mixed  The data for the form.
    *
    * @since   1.6
    */
  protected function loadFormData()
  {
    // Check the session for previously entered form data.
    $data = JFactory::getApplication()->getUserState(
                            'com_townoffical.edit.townoffical.data',
                            array()
                            );
    
    if (empty($data))
    {
      $data = $this->getItem();
    }
    
    return $data;
  }
  /**
    * Method to override the JModelAdmin save() function to handle Save as Copy correctly
    *
    * @param   The townoffical record data submitted from the form.
    *
    * @return  parent::save() return value
    */
  public function save($data)
  {
    $input = JFactory::getApplication()->input;
    
    JLoader::register('CategoriesHelper', JPATH_ADMINISTRATOR . '/components/com_categories/helpers/categories.php');
    
    // Validate the category id
    // validateCategoryId() returns 0 if the catid can't be found
    if ((int) $data['catid'] > 0)
    {
      $data['catid'] = CategoriesHelper::validateCategoryId($data['catid'], 'com_townoffical');
    }
    
    // Alter the name and alias for save as copy
    if ($input->get('task') == 'save2copy')
    {
      $origTable = clone $this->getTable();
      $origTable->load($input->getInt('id'));
      
      if ($data['name'] == $origTable->name)
      {
        list($name, $alias) = $this->generateNewTitle($data['catid'], $data['alias'], $data['name']);
        $data['name'] = $name;
        $data['alias'] = $alias;
      }
      else
      {
        if ($data['alias'] == $origTable->alias)
        {
          $data['alias'] = '';
        }
      }
      // standard Joomla practice is to set the new record as unpublished
      $data['published'] = 0;
    }
    
    return parent::save($data);
  }
  /**
    * Method to check if it's OK to delete a message. Overrides JModelAdmin::canDelete
    */
  protected function canDelete($record)
  {
    if( !empty( $record->id ) )
    {
      return JFactory::getUser()->authorise( "core.delete", "com_townoffical.townoffical." . $record->id );
    }
  }
}
