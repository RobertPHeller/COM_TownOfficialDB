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
 *  Created       : Wed Apr 20 14:35:13 2022
 *  Last Modified : <220423.1228>
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
?>
<?php if (!empty($this->items)) : ?>
  <?php foreach ($this->items as $i => $row): 
      $link = JRoute::_('index.php?option=com_townoffical&task=townoffical.edit&id=' . $row->id);
  ?>
    <tr class="row<?php echo $i % 2; ?>">
      <td>
        <?php echo $this->pagination->getRowOffset($i); ?>
      </td>
      <td>
        <?php echo JHtml::_('grid.id', $i, $row->id); ?>
      </td>
      <td>
        <?php echo $row->office; ?>
      </td>
      <td>
        <a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_TOWNOFFICAL_EDIT_TOWNOFFICAL'); ?>">
        <?php echo $row->name; ?>
        </a>
      </td>
      <td>
        <?php echo $row->auxoffice; ?>
      </td>
      <td <?php 
             $today = new DateTime("now");
             $term  = new DateTime("$row->termends");
             if ($today > $term) echo 'style="color:red;"'; ?>>
          <?php echo $row->termends; ?>
      </td>
      <td>
        <?php if ($row->iselected)
          {
            echo JText::_('JYES'); 
          }
          else
          {
            echo JText::_('JNO');
          } ?>
      </td>
      <td align="center">
        <?php echo $row->author; ?>
      </td>
      <td align="center">
        <?php echo substr($row->created, 0, 10); ?>
      </td>
      <td align="center">
        <?php echo JHtml::_('jgrid.published', $row->published, $i, 'townofficals.', true, 'cb'); ?>
      </td>
      <td align="center">
        <?php echo $row->id; ?>
      </td>
    </tr>
  <?php endforeach; ?>
<?php endif; ?>
