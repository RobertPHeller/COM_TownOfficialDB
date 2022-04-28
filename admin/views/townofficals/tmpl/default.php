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
 *  Created       : Wed Apr 20 14:29:20 2022
 *  Last Modified : <220428.1320>
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
defined('_JEXEC') or die('Restricted Access');

// load tooltip behavior
JHtml::_('behavior.tooltip');

JHtml::_('formbehavior.chosen', 'select');

$listOrder     = $this->escape($this->state->get('list.ordering'));
$listDirn      = $this->escape($this->state->get('list.direction'));
?>
<form action="<?php echo JRoute::_('index.php?option=com_townoffical&view=townofficals'); ?>" method="post" name="adminForm" id="adminForm">
  <div id="j-sidebar-container" class="span2">
    <?php echo JHtmlSidebar::render(); ?>
  </div>
  <div id="j-main-container" class="span10">
    <div class="row-fluid">
      <div class="span6">
        <?php echo JText::_('COM_TOWNOFFICAL_TOWNOFFICALS_FILTER'); ?>
        <?php
          echo JLayoutHelper::render(
                                     'joomla.searchtools.default',
                                     array('view' => $this)
                                     );
        ?>
      </div>
    </div>
    <table class="table table-striped table-hover">
      <thead><?php echo $this->loadTemplate('head'); ?></thead>
      <tfoot><?php echo $this->loadTemplate('foot'); ?></tfoot>
      <tbody><?php echo $this->loadTemplate('body'); ?></tbody>
    </table>
    <input type="hidden" name="task" value=""/>
    <input type="hidden" name="boxchecked" value="0"/>
    <?php echo JHtml::_('form.token'); ?>
  </div>
</form>

