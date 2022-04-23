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
 *  Created       : Sat Apr 23 12:06:51 2022
 *  Last Modified : <220423.1209>
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
  * TownOffical Controller
  *
  * @package     Joomla.Site
  * @subpackage  com_townoffical
  *
  * Used to handle the http POST from the front-end form which allows 
  * users to enter a new townoffical message
  *
  */
class TownOfficalControllerTownOffical extends JControllerForm
{   
  public function cancel($key = null)
  {
    parent::cancel($key);
    
    // set up the redirect back to the same form
    $this->setRedirect(
                       (string)JUri::getInstance(), 
                       JText::_('COM_TOWNOFFICAL_ADD_CANCELLED')
                       );
  }
  
  /*
    * Function handing the save for adding a new townoffical record
    * Based on the save() function in the JControllerForm class
    */
  public function save($key = null, $urlVar = null)
  {
    // Check for request forgeries.
    JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
    
    $app = JFactory::getApplication(); 
    $input = $app->input; 
    $model = $this->getModel('form');
    
    // Get the current URI to set in redirects. As we're handling a POST, 
    // this URI comes from the <form action="..."> attribute in the layout file above
    $currentUri = (string)JUri::getInstance();
    
    // Check that this user is allowed to add a new record
    if (!JFactory::getUser()->authorise( "core.create", "com_townoffical"))
    {
      $app->enqueueMessage(JText::_('JERROR_ALERTNOAUTHOR'), 'error');
      $app->setHeader('status', 403, true);
      
      return;
    }
    
    // get the data from the HTTP POST request
    $data  = $input->get('jform', array(), 'array');
    
    // set up context for saving form data
    $context = "$this->option.edit.$this->context";
    
    // Validate the posted data.
    // First we need to set up an instance of the form ...
    $form = $model->getForm($data, false);
    
    if (!$form)
    {
      $app->enqueueMessage($model->getError(), 'error');
      return false;
    }
    
    // ... and then we validate the data against it
    // The validate function called below results in the running of the validate="..." routines
    // specified against the fields in the form xml file, and also filters the data 
    // according to the filter="..." specified in the same place (removing html tags by default in strings)
    $validData = $model->validate($form, $data);
    
    // Handle the case where there are validation errors
    if ($validData === false)
    {
      // Get the validation messages.
      $errors = $model->getErrors();
      
      // Display up to three validation messages to the user.
      for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++)
      {
        if ($errors[$i] instanceof Exception)
        {
          $app->enqueueMessage($errors[$i]->getMessage(), 'warning');
        }
        else
        {
          $app->enqueueMessage($errors[$i], 'warning');
        }
      }
      
      // Save the form data in the session.
      $app->setUserState($context . '.data', $data);
      
      // Redirect back to the same screen.
      $this->setRedirect($currentUri);
      
      return false;
    }
    
    // add the 'created by' and 'created' date fields
    $validData['created_by'] = JFactory::getUser()->get('id', 0);
    $validData['created'] = date('Y-m-d h:i:s');
    
    // Attempt to save the data.
    if (!$model->save($validData))
    {
      // Handle the case where the save failed
      
      // Save the data in the session.
      $app->setUserState($context . '.data', $validData);
      
      // Redirect back to the edit screen.
      $this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError()));
      $this->setMessage($this->getError(), 'error');
      
      $this->setRedirect($currentUri);
      
      return false;
    }
    
    // clear the data in the form
    $app->setUserState($context . '.data', null);
    
    // notify the administrator that a new townoffical message has been added on the front end
    
    // get the id of the person to notify from global config
    $params   = $app->getParams();
    $userid_to_email = (int) $params->get('user_to_email');
    $user_to_email = JUser::getInstance($userid_to_email);
    $to_address = $user_to_email->get("email");
    
    // get the current user (if any)
    $current_user = JFactory::getUser();
    if ($current_user->get("id") > 0) 
    {
      $current_username = $current_user->get("username");
    }
    else 
    {
      $current_username = "a visitor to the site";
    }
    
    // get the Mailer object, set up the email to be sent, and send it
    $mailer = JFactory::getMailer();
    $mailer->addRecipient($to_address);
    $mailer->setSubject("New Town Offical added by " . $current_username);
    $mailer->setBody("New offical is " . $validData['name']);
    try 
    {
      $mailer->send(); 
    }
    catch (Exception $e)
    {
      JLog::add('Caught exception: ' . $e->getMessage(), JLog::Error, 'jerror');
    }
    
    $this->setRedirect(
                       $currentUri,
                       JText::_('COM_TOWNOFFICAL_ADD_SUCCESSFUL')
                       );
    
    return true;
    
  }
  
}
