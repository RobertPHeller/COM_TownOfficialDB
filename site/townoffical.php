<?php
/**
  * @package     Joomla.Administrator
  * @subpackage  com_townoffical
  *
  * @copyright   Copyright (C) 2022  Robert Heller
  * @license     GNU General Public License version 2 or later; see LICENSE
  */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import joomla controller library
jimport('joomla.application.component.controller');

// Get an instance of the controller prefixed by TownOffical
$controller = JControllerLegacy::getInstance('TownOffical');

// Perform the Request task
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));

// Redirect if set by the controller
$controller->redirect();
