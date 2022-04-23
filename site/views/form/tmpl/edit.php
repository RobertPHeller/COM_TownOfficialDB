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
 *  Created       : Sat Apr 23 12:01:59 2022
 *  Last Modified : <220423.1203>
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

?>
<form action="<?php echo JRoute::_('index.php?option=com_townoffical&view=form&layout=edit'); ?>"
 method="post" name="adminForm" id="adminForm" class="form-validate">

  <div class="form-horizontal">
    <fieldset class="adminform">
    <legend><?php echo JText::_('COM_TOWNOFFICAL_LEGEND_DETAILS') ?></legend>
    <div class="row-fluid">
      <div class="span6">
        <?php echo $this->form->renderFieldset('details');  ?>
      </div>
    </div>
    </fieldset>
  </div>
  
  <div class="btn-toolbar">
    <div class="btn-group">
      <button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('townoffical.save')">
      <span class="icon-ok"></span><?php echo JText::_('JSAVE') ?>
      </button>
    </div>
    <div class="btn-group">
      <button type="button" class="btn" onclick="Joomla.submitbutton('townoffical.cancel')">
      <span class="icon-cancel"></span><?php echo JText::_('JCANCEL') ?>
      </button>
    </div>
  </div>

  <input type="hidden" name="task" />
  <?php echo JHtml::_('form.token'); ?>
</form>

