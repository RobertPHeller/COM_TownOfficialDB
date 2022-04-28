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
 *  Created       : Thu Apr 28 14:02:11 2022
 *  Last Modified : <220428.1652>
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

// no direct access
defined('_JEXEC') or die('Restricted Access');

?>

<form action="<?php echo JRoute::_('index.php?option=com_townoffical&view=townofficals'); ?>"
 method="post" id="adminForm" name="adminForm" enctype="multipart/form-data">
  <div class="form-horizontal">
    <fieldset class="adminform">
    <legend><?php echo JText::_('COM_TOWNOFFICAL_IMPORT_DETAILS'); ?></legend>
    <div class="row-fluid">
      <div class="span6">
        <?php 
          if ($this->form)
          {
            foreach($this->form->getFieldset() as $field) 
            {
              echo $field->renderField();        
            }
          }
          else
          {
            echo "<!-- this->form is false... -->";
          }
        ?>
      </div>
    </div>
    </fieldset>
  </div>
  <!-- we need here the 'task' field to get NOT an error message like: 'TypeError: b.task is undefined' -->
  <input type="hidden" name="task" value="townofficals.doimport" />
  <input type="hidden" name="<?php echo JSession::getFormToken(); ?>" value="1" />
</form>
