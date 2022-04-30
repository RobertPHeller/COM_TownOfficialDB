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
 *  Last Modified : <220430.1054>
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

require_once( JPATH_ADMINISTRATOR.'/components/com_townoffical/tables/townoffical.php');
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
    
    $input = Factory::getApplication()->input;
    $files = $input->files->get('jform');
    $use_csv_headers = $input->get('useCSVheader', '1', 'boolean' );
    $field_sep       = $input->get('delimiter', ',', 'string');
    $enclose_char    = $input->get('quote', '"', 'string');
    $tmp_name        = $files['file']['tmp_name'];
    $fp = fopen($tmp_name,"r");
    $firstline = fgetcsv($fp,10*1024, $field_sep, $enclose_char);
    $skipfirstline = false;
    fclose($fp);
    if ($use_csv_headers) {
      $skipfirstline = true;
      foreach($firstline as $h) {
        if (trim($h) != "") {
          $col = strtolower(trim($h));
          if (in_array($col,array('auxoffice','name','termends','swornindate',
                                  'ethicsexpires','iselected','email',
                                  'telephone','notes','aux office','office',
                                  "term ends","sworn in date","ethics expires",
                                  "is elected",'e-mail','phone')))
          {
            switch ($col)
            {
            case 'aux office': $col = 'auxoffice'; break;
            case 'term ends': $col = 'termends'; break;
            case "sworn in date": $col = 'swornindate'; break;
            case "ethics expires": $col = 'ethicsexpires'; break;
            case "is elected": $col = 'iselected'; break;
            case 'e-mail': $col = 'email'; break;
            case 'phone': $col = 'telephone'; break;
            default: break;
            }
            $columns[] = $col;
          }
          else
          {
            JError::raiseError(500, '<p>Undefined column: '.$h.'</p>');
            return;
          }
        }
      }
      $manditorycolcount = 0;
      foreach ($columns as $col) {
        if (in_array($col,array('office','name','termends','iselected')))
        {
          $manditorycolcount++;
        }
      }
      if ($manditorycolcount < 4) 
      {
        JError::raiseError(500, '<p>Some mandatory columns are missing!</p>');
        return;
      }  
    }
    else
    {
      switch (count($firstline)) {
      case 4:
        $columns = array('office','name','termends','iselected');
        break;
      case 5:
        $columns = array('office','name','termends','iselected','email');
        break;
      case 6:
        $columns = array('office','name','termends','iselected','email',
                         'telephone');
        break;
      case 7:
        $columns = array('office','name','termends','swornindate','iselected',
                         'email','telephone');
        break;
      case 8:
        $columns = array('office','name','termends','swornindate',
                         'ethicsexpires','iselected','email','telephone');
        break;
      case 9:
        $columns = array('office','name','termends','swornindate',
                         'ethicsexpires','iselected','email','telephone',
                         'notes');
        break;
      case 10:
        $columns = array('office','name','termends','swornindate',
                         'ethicsexpires','iselected','email','telephone',
                         'notes','auxoffice');
        break;
      default:
        JError::raiseError(500, '<p>Bad number of columns: '.
                           count($firstline).'</p>');
        return;
      }
    }
    $indexes = array();
    foreach ($columns as $i => $col) 
    {
      $indexes[$col] = $i;
    }
    $fp = fopen($tmp_name,"r");
    if ($skipfirstline)
    {
      $dummy = fgetcsv($fp,10*1024, $field_sep, $enclose_char);
    }
    $db = JFactory::getDbo();
    while ($line = fgetcsv($fp,10*1024, $field_sep, $enclose_char))
    {
      if (count($line) < count($columns))
      {
        continue; //skip short lines (ignore extra columns)
      }
      $offical = new TownOfficalTableTownOffical($db);
      $offical_data = array();
      foreach ($columns as $col) 
      {
        switch ($col)
        {
        case 'office':
          $query = $db->getQuery(true);
          $query->select('id');
          $query->from('#__categories');
          $query->where('extension = "com_townoffical" AND '
                        .'title = '.$db->quote($line[$indexes['office']]));
          $db->setQuery($query);
          $catid = $db->loadResult();
          if ($catid == null)
          {
            // new office (category)
            $table = JTable::getInstance('category');
            $data = array();
            // name the category
            $data['title'] = $line[$indexes['office']];
            $data['language'] = '*';
            // set what extension the category is for
            $data['extension'] = 'com_townoffical';
            // Set the category to be published by default
            $data['published'] = 1;
            // setLocation uses the parent_id and updates the nesting columns correctly
            $table->setLocation($data['parent_id'], 'last-child');
            // push our data into the table object
            $table->bind($data);
            // some data checks including setting the alias based on the name
            if ($table->check()) {
              // and store it!
              $table->store();
              // Success
            } else {
              // Error
              JError::raiseError(500, "Category table check failed");
              return;
            }
            $catid = $table->id;
          }
          $offical_data['catid'] = $catid;
          break;
        case 'name':
          $query = $db->getQuery(true);
          $query->select('a.id as id');
          $query->from($db->quoteName('#__townoffical', 'a'));
          $query->join('LEFT', $db->quoteName('#__categories', 'c') .
                       ' ON c.id = a.catid');
          $query->where('a.name = '.$db->quote($line[$indexes['name']]).' AND '.
                        'c.title = '.$db->quote($line[$indexes['office']]));
          $db->setQuery($query);
          $id = $db->loadResult();
          if ($id != null) 
          {
            $offical_data['id'] = $id;
          }
          else
          {
            $offical_data['name'] = $line[$indexes['name']];
          }
          break;
        case 'iselected':
          switch (strtolower($line[$indexes[$col]]))
          {
          case 1:
          case 'true':
          case 'yes':
            $offical_data[$col] = 1;
            break;
          case 0:
          case 'false':
          case 'no':
          default:
            $offical_data[$col] = 0;
            break;
          }
          break;
        case 'termends':
        case 'swornindate':
        case 'ethicsexpires':
          try {
            $date = new Date($line[$indexes[$col]]);
          } catch(Exception $e) {
            $date = new Date(DateTime::createFromFormat("m-d-Y",$line[$indexes[$col]])->format("d-m-Y"));
          }
          $offical_data[$col] = $date->toSql();
          break;
        default:
          $offical_data[$col] = $line[$indexes[$col]];
          break;
        }
      }
      $offical->bind($offical_data);
      if ($offical->check()) 
      {
        $offical->store();
      }
      else
      {
        // Error
        JError::raiseError(500, "Town Offical table check failed");
        return;
      }
    }
    fclose($fp);
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

