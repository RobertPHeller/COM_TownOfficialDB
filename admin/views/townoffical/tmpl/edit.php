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
 *  Last Modified : <220422.1302>
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

?>
<form action="<?php echo JRoute::_('index.php?option=com_townoffical&layout=edit&id=' . (int) $this->item->id); ?>"
 method="post" name="adminForm" id="adminForm" class="form-validate">
<div class="form-horizontal">
  <?php foreach ($this->form->getFieldsets() as $name => $fieldset): ?>
    <fieldset class="adminform">
      <legend><?php echo JText::_($fieldset->label); ?></legend>
      <div class="row-fluid">
        <div class="span6">
          <?php foreach ($this->form->getFieldset($name) as $field): ?>
            <div class="control-group">
              <div class="control-label"><?php echo $field->label; ?></div>
              <div class="controls"><?php echo $field->input; ?></div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </fieldset>
  <?php endforeach; ?>
</div>
<input type="hidden" name="task" value="townoffical.edit" />
<?php echo JHtml::_('form.token'); ?>
</form>
