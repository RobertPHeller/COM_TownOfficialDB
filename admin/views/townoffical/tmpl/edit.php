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
 *  Created       : Wed Apr 20 16:40:09 2022
 *  Last Modified : <220422.1647>
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

// No direct access
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.formvalidator');

// The following is to enable setting the permission's Calculated Setting 
// when you change the permission's Setting. 
// The core javascript code for initiating the Ajax request looks for a field
// with id="jform_title" and sets its value as the 'title' parameter to send in the Ajax request
JFactory::getDocument()->addScriptDeclaration('
           jQuery(document).ready(function() {
            name = jQuery("#jform_name").val();
            jQuery("#jform_title").val(name);
          });
');
                                                
?>
<form action="<?php echo JRoute::_('index.php?option=com_townoffical&layout=edit&id=' . (int) $this->item->id); ?>"
 method="post" name="adminForm" id="adminForm" class="form-validate">

  <input id="jform_title" type="hidden" name="townoffical-name-title"/>

  <div class="form-horizontal">
  
    <?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>
    <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details', 
                        empty($this->item->id) ? JText::_('COM_TOWNOFFICAL_TAB_NEW_MESSAGE') : JText::_('COM_TOWNOFFICAL_TAB_EDIT_MESSAGE')); ?>
      <fieldset class="adminform">
        <legend><?php echo JText::_('COM_TOWNOFFICAL_LEGEND_DETAILS') ?></legend>
        <div class="row-fluid">
          <div class="span6">
            <?php echo $this->form->renderFieldset('details');  ?>
          </div>
        </div>
      </fieldset>
    <?php echo JHtml::_('bootstrap.endTab'); ?>
      
    <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'params', JText::_('COM_TOWNOFFICAL_TAB_PARAMS')); ?>
      <fieldset class="adminform">
        <legend><?php echo JText::_('COM_TOWNOFFICAL_LEGEND_PARAMS') ?></legend>
        <div class="row-fluid">
          <div class="span6">
            <?php echo $this->form->renderFieldset('params');  ?>
          </div>
        </div>
      </fieldset>
    <?php echo JHtml::_('bootstrap.endTab'); ?>
      
    <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'permissions', JText::_('COM_TOWNOFFICAL_TAB_PERMISSIONS')); ?>
      <fieldset class="adminform">
        <legend><?php echo JText::_('COM_TOWNOFFICAL_LEGEND_PERMISSIONS') ?></legend>
        <div class="row-fluid">
          <div class="span12">
            <?php echo $this->form->renderFieldset('accesscontrol');  ?>
          </div>
        </div>
      </fieldset>
    <?php echo JHtml::_('bootstrap.endTab'); ?>
    <?php echo JHtml::_('bootstrap.endTabSet'); ?>
      
  </div>
  <input type="hidden" name="task" value="townoffical.edit" />
  <?php echo JHtml::_('form.token'); ?>
</form>
