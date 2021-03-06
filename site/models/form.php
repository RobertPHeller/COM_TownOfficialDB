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
 *  Created       : Sat Apr 23 12:04:32 2022
 *  Last Modified : <220423.1205>
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
class TownOfficalModelForm extends JModelAdmin
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
                            'com_townoffical.form',
                            'add-form',
                            array(
                                  'control' => 'jform',
                                  'load_data' => $loadData
                                  )
                            );
    
    if (empty($form))
    {
      $errors = $this->getErrors();
      throw new Exception(implode("\n", $errors), 500);
    }
    
    return $form;
  }
  
  /**
    * Method to get the data that should be injected in the form.
    * As this form is for add, we're not prefilling the form with an existing record
    * But if the user has previously hit submit and the validation has found an error,
    *   then we inject what was previously entered.
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
    
    return $data;
  }
  
  /**
    * Method to get the script that have to be included on the form
    * This returns the script associated with townoffical field greeting validation
    *
    * @return stringScript files
    */
  public function getScript() 
  {
    return 'administrator/components/com_townoffical/models/forms/townoffical.js';
  }
}
