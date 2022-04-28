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
 *  Created       : Wed Apr 20 16:35:28 2022
 *  Last Modified : <220428.1725>
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

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Date\Date;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\Utilities\ArrayHelper;

/**
  * TownOfficals Controller
  *
  * @since  0.0.1
  */
class TownOfficalControllerTownOfficals extends JControllerAdmin
{
  /**
    * Proxy for getModel.
    *
    * @param   string  $name    The model name. Optional.
    * @param   string  $prefix  The class prefix. Optional.
    * @param   array   $config  Configuration array for model. Optional.
    *
    * @return  object  The model.
    *
    * @since   1.6
    */
  public function getModel($name = 'TownOffical', $prefix = 'TownOfficalModel', $config = array('ignore_request' => true))
  {
    $model = parent::getModel($name, $prefix, $config);
    
    return $model;
  }
  public function import()
  {
    $this->setRedirect(Route::_('index.php?option=com_townoffical&view=importform', false));
  }
  public function cancelimport()
  {
    $this->setRedirect(Route::_('index.php?option=com_townoffical&view=townofficals', false));
  }
  public function doimport()
  {
    // Check for request forgeries.
    $this->checkToken();
    
    $files = $_FILES['jform'];
    $tmp_name = $files['tmp_name']['file'];
    //$fp = fopen($tmp_name,"r");
                                  
    //fclose($fp);
    $this->setRedirect(Route::_('index.php?option=com_townoffical&view=townofficals', false));
  }
  private function getCsvData($data)
  {
    if (!is_iterable($data))
    {
      throw new InvalidArgumentException(
               sprintf('%s() requires an array or object implementing the Traversable interface, a %s was given.',
                       __METHOD__,
                       gettype($data) === 'object' ? get_class($data) : gettype($data)
                       )
               );
    }
    $disabledText = Text::_('COM_TOWNOFFICAL_DISABLED');
      
    // Header row
    yield array('Office','Name','Aux Office','Term Ends','Sworn In Date',
                'Ethics Expires','Is Elected','E-Mail','Phone','Notes');
    foreach ($data as $offical)
    {
      yield array('office' =>        $offical->office,
                  'name'   =>        $offical->name,
                  'auxoffice' =>     $offical->auxoffice,
                  'termends' =>      $offical->termends,
                  'swornindate' =>   $offical->swornindate,
                  'ethicsexpires' => $offical->ethicsexpires,
                  'iselected' =>     $offical->iselected,
                  'email' =>         $offical->email,
                  'telephone' =>     $offical->telephone,
                  'notes' =>         $offical->notes);
    }
  }
  public function export()
  {
    // Check for request forgeries.
    $this->checkToken();
    $model = $this->getModel('TownOfficals');
    $data = $model->getOfficalsDataAsIterator();
    if (count($data))
    {
      try
      {
        $rows = $this->getCsvData($data);
      }
      catch (InvalidArgumentException $exception)
      {
        $this->setMessage(Text::_('COM_TOWNOFFICAL_ERROR_COULD_NOT_EXPORT_DATA'), 'error');
        $this->setRedirect(Route::_('index.php?option=com_townoffical&view=townofficals', false));
        
        return;
      }
      // Destroy the iterator now
      unset($data);
      $date     = new Date('now', new DateTimeZone('UTC'));
      $filename = 'officals_' . $date->format('Y-m-d_His_T');
      $csvDelimiter = ComponentHelper::getComponent('com_townoffical')->getParams()->get('csv_delimiter', ',');
      
      $app = Factory::getApplication();
      $app->setHeader('Content-Type', 'application/csv', true)
      ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '.csv"', true)
      ->setHeader('Cache-Control', 'must-revalidate', true)
      ->sendHeaders();
      
      $output = fopen("php://output", "w");
      
      foreach ($rows as $row)
      {
        fputcsv($output, $row, $csvDelimiter);
      }
      
      fclose($output);
      $app->close();
    }
    else
    {
      $this->setMessage(Text::_('COM_TOWNOFFICAL_NO_OFFICALS_TO_EXPORT'));
      $this->setRedirect(Route::_('index.php?option=com_townoffical&view=townofficals', false));
    }
  }
}

