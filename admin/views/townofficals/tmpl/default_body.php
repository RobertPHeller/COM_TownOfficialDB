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
 *  Last Modified : <220420.1546>
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
<?php foreach ($this->items as $i => $row): ?>
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
    <?php echo $row->name; ?>
  </td>
  <td>
    <?php echo $row->auxoffice; ?>
  </td>
  <td>
    <?php echo $row->termends; ?>
  </td>
  <td>
    <?php echo $row->iselected; ?>
  </td>
  <td align="center">
    <?php echo JHtml::_('jgrid.published', $row->published, $i, 'townofficials.', true, 'cb'); ?>
  </td>
  <td align="center">
    <?php echo $row->id; ?>
  </td>
</tr>
<?php endforeach; ?>
