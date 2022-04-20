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
 *  Created       : Wed Apr 20 14:32:22 2022
 *  Last Modified : <220420.1434>
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
<tr>
    <th width="1%"><?php echo JText::_('COM_TOWNOFFICAL_NUM'); ?></th>
    <th width="2%">
    <?php echo JHtml::_('grid.checkall'); ?>
    </th>
    <th width="20%">
    <?php echo JText::_('COM_TOWNOFFICAL_TOWNOFFICAL_OFFICE') ;?>
    </th>
    <th width="20%">
    <?php echo JText::_('COM_TOWNOFFICAL_TOWNOFFICAL_NAME') ;?>
    </th>
    <th width="10%">
    <?php echo JText::_('COM_TOWNOFFICAL_TOWNOFFICAL_AUXOFFICE') ;?>
    </th>
    <th width="15%">
    <?php echo JText::_('COM_TOWNOFFICAL_TOWNOFFICAL_TERMENDS') ;?>
    </th>
    <th width="5%">
    <?php echo JText::_('COM_TOWNOFFICAL_TOWNOFFICAL_ISELECTED') ;?>
    </th>
    <th width="5%">
    <?php echo JText::_('COM_TOWNOFFICAL_PUBLISHED'); ?>
    </th>
    <th width="2%">
    <?php echo JText::_('COM_TOWNOFFICAL_ID'); ?>
    </th>
</tr>
