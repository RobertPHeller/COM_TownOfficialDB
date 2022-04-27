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
 *  Created       : Sat Apr 23 10:48:22 2022
 *  Last Modified : <220427.1010>
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

if (!defined('DS')){
  define('DS',DIRECTORY_SEPARATOR);
} 


/**
  * Script file of TownOffical component.
  *
  * The name of this class is dependent on the component being installed.
  * The class name should have the component's name, directly followed by
  * the text InstallerScript (ex:. com_townOfficalInstallerScript).
  *
  * This class will be called by Joomla!'s installer, if specified in your component's
  * manifest file, and is used for custom automation actions in its installation process.
  *
  * In order to use this automation script, you should reference it in your component's
  * manifest file as follows:
  * <scriptfile>script.php</scriptfile>
  *
  * @package     Joomla.Administrator
  * @subpackage  com_townoffical
  *
  * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
  * @license     GNU General Public License version 2 or later; see LICENSE.txt
  */

setlocale(LC_ALL, 'C.UTF-8', 'C');

use Joomla\CMS\Application\ApplicationHelper;
use Joomla\Utilities\ArrayHelper; 
use Joomla\String\StringHelper;
use Joomla\CMS\Factory;

JHtml::_('behavior.formvalidator');
JHtml::_('behavior.keepalive');

jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');
jimport('joomla.log.log');


class com_townofficalInstallerScript
{
  /**
    * This method is called after a component is installed.
    *
    * @param  \stdClass $parent - Parent object calling this method.
    *
    * @return void
    */
  public function install($parent) 
  {
    /*                                                                      
      / Install modules and plugins                                           
      */                                                                      
    jimport('joomla.installer.installer');                                  
    $status = new JObject();                                                
    $status->modules = array();                                             
    $status->plugins = array();                                             
    $src_modules = dirname(__FILE__).DS.'modules';                          
    $src_plugins = dirname(__FILE__).DS.'plugins';     
    // plugins
    $installer = new JInstaller;
    $result = $installer->install($src_plugins.DS.'embed_office');
    $status->plugins[] = array('name'=>'Embed Town Officals',
                               'group'=>'content', 
                               'result'=>$result);
    $result = $installer->install($src_modules.DS.'mod_townoffical_unit_sidebar');
    $status->modules[] = array('name'=>'Town Officals Module',
                               'result'=>$result);
      ?>
      <hr>
      <div class="adminlist" style="">
        <?php
          /*
            / Display the results from the extension installation
            */ 
          
          $rows = 0;
        ?>                           

        <table class="adminlist" style="width: 100%; margin:10px 10px 10px 10px;">
            <thead>
                <tr>
                    <th class="title" style="text-align:left;"><?php echo JText::_('COM_TOWNOFFICAL_INSTALL_EXTENSION'); ?></th>
                    <th style="width: 50%; text-align:center;"><?php echo JText::_('COM_TOWNOFFICAL_INSTALL_STATUS'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($status->modules)) : ?>
                <tr>
                    <th style="text-align:left;"><?php echo JText::_('COM_TOWNOFFICAL_INSTALL_MODULE'); ?></th>
                </tr>
                <?php foreach ($status->modules as $module) : ?>
                <tr class="row<?php echo (++ $rows % 2); ?>">
                    <td class="key"><?php echo $module['name']; ?></td>
                    <td style="text-align:center;"><?php echo ($module['result'])?JText::_('COM_TOWNOFFICAL_INSTALL_INSTALLED'):JText::_('COM_TOWNOFFICAL_INSTALL_NOT_INSTALLED'); ?></td>
                </tr>
                <?php endforeach;?>
                <?php endif;?>
                <?php if (count($status->plugins)) : ?>
                <tr>
                    <th style="text-align:left;"><?php echo JText::_('COM_TOWNOFFICAL_INSTALL_PLUGIN'); ?></th>
                </tr>
                <?php foreach ($status->plugins as $plugin) : ?>
                <tr class="row<?php echo (++ $rows % 2); ?>">
                    <td class="key"><?php echo ucfirst($plugin['name']); ?></td>
                    <td style="text-align:center;"><?php echo ($plugin['result'])?JText::_('COM_TOWNOFFICAL_INSTALL_INSTALLED'):JText::_('COM_TOWNOFFICAL_INSTALL_NOT_INSTALLED'); ?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <?php
        }

    
  /**
    * This method is called after a component is uninstalled.
    *
    * @param  \stdClass $parent - Parent object calling this method.
    *
    * @return void
    */
  public function uninstall($parent) 
  {
    echo '<p>' . JText::_('COM_TOWNOFFICAL_UNINSTALL_TEXT') . '</p>';
  }
  
  /**
    * This method is called after a component is updated.
    *
    * @param  \stdClass $parent - Parent object calling object.
    *
    * @return void
    */
  public function update($parent) 
  {
        // install the new modules when this not already exists
        jimport('joomla.installer.installer');

        $status = new JObject();
        $status->modules = array();
        $status->plugins = array();
        
        $src_modules = dirname(__FILE__).DS.'modules';
        $src_plugins = dirname(__FILE__).DS.'plugins';
        
        // we must install again all modules and plugins since it can be that we must also install here an update
        // plugins
        $installer = new JInstaller;
        $result = $installer->install($src_plugins.DS.'embed_office');
        $status->plugins[] = array('name'=>'Embed Town Officals',
                                   'group'=>'content', 
                                   'result'=>$result);
        $result = $installer->install($src_modules.DS.'mod_townoffical_unit_sidebar');
        $status->modules[] = array('name'=>'Town Officals Module',
                                   'result'=>$result);
      ?>
      <hr>
      <div class="adminlist" style="">
        <?php
          /*
            / Display the results from the extension installation
            */ 
          
          $rows = 0;
        ?>                           

        <table class="adminlist" style="width: 100%; margin:10px 10px 10px 10px;">
            <thead>
                <tr>
                    <th class="title" style="text-align:left;"><?php echo JText::_('COM_TOWNOFFICAL_INSTALL_EXTENSION'); ?></th>
                    <th style="width: 50%; text-align:center;"><?php echo JText::_('COM_TOWNOFFICAL_INSTALL_STATUS'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($status->modules)) : ?>
                <tr>
                    <th style="text-align:left;"><?php echo JText::_('COM_TOWNOFFICAL_INSTALL_MODULE'); ?></th>
                </tr>
                <?php foreach ($status->modules as $module) : ?>
                <tr class="row<?php echo (++ $rows % 2); ?>">
                    <td class="key"><?php echo $module['name']; ?></td>
                    <td style="text-align:center;"><?php echo ($module['result'])?JText::_('COM_TOWNOFFICAL_INSTALL_INSTALLED'):JText::_('COM_TOWNOFFICAL_INSTALL_NOT_INSTALLED'); ?></td>
                </tr>
                <?php endforeach;?>
                <?php endif;?>
                <?php if (count($status->plugins)) : ?>
                <tr>
                    <th style="text-align:left;"><?php echo JText::_('COM_TOWNOFFICAL_INSTALL_PLUGIN'); ?></th>
                </tr>
                <?php foreach ($status->plugins as $plugin) : ?>
                <tr class="row<?php echo (++ $rows % 2); ?>">
                    <td class="key"><?php echo ucfirst($plugin['name']); ?></td>
                    <td style="text-align:center;"><?php echo ($plugin['result'])?JText::_('COM_TOWNOFFICAL_INSTALL_INSTALLED'):JText::_('COM_TOWNOFFICAL_INSTALL_NOT_INSTALLED'); ?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <?php
  }
  
  /**
    * Runs just before any installation action is performed on the component.
    * Verifications and pre-requisites should run in this function.
    *
    * @param  string    $type   - Type of PreFlight action. Possible values are:
    *                           - * install
    *                           - * update
    *                           - * discover_install
    * @param  \stdClass $parent - Parent object calling object.
    *
    * @return void
    */
  public function preflight($type, $parent) 
  {
    echo '<p>' . JText::_('COM_TOWNOFFICAL_PREFLIGHT_' . $type . '_TEXT') . '</p>';
  }
  
  /**
    * Runs right after any installation action is performed on the component.
    *
    * @param  string    $type   - Type of PostFlight action. Possible values are:
    *                           - * install
    *                           - * update
    *                           - * discover_install
    * @param  \stdClass $parent - Parent object calling object.
    *
    * @return void
    */
  function postflight($type, $parent) 
  {
    echo '<p>' . JText::_('COM_TOWNOFFICAL_POSTFLIGHT_' . $type . '_TEXT') . '</p>';
  }
}
