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
 *  Last Modified : <220423.1609>
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
$listOrder     = $this->escape($this->state->get('list.ordering'));
$listDirn      = $this->escape($this->state->get('list.direction'));
?>
<tr>
  <th width="1%">
  <?php echo JText::_('COM_TOWNOFFICAL_TOWNOFFICAL_HEADING_NUM') ;?>
  </th>
  <th width="2%">
  <?php echo JHtml::_('grid.checkall'); ?>
  </th>
  <th width="20%">
  <?php echo JHtml::_('searchtools.sort', 'COM_TOWNOFFICAL_TOWNOFFICAL_HEADING_OFFICE','office', $listDirn, $listOrder); ?>
  </th>
  <th width="20%">
  <?php echo JHtml::_('searchtools.sort', 'COM_TOWNOFFICAL_TOWNOFFICAL_HEADING_NAME','name', $listDirn, $listOrder); ?>
  </th>
  <th width="10%">
  <?php echo JHtml::_('searchtools.sort', 'COM_TOWNOFFICAL_TOWNOFFICAL_HEADING_AUXOFFICE', 'auxoffice', $listDirn, $listOrder); ?>
  </th>
  <th width="5%">
  <?php echo JHtml::_('searchtools.sort', 'COM_TOWNOFFICAL_TOWNOFFICAL_HEADING_TERMENDS', 'termends', $listDirn, $listOrder); ?>
  </th>
  <th width="5%">
  <?php echo JHtml::_('searchtools.sort', 'COM_TOWNOFFICAL_TOWNOFFICAL_HEADING_ISELECTED', 'iselected', $listDirn, $listOrder); ?>
  </th>
  <th width="20%">
  <?php echo JHtml::_('searchtools.sort', 'COM_TOWNOFFICAL_TOWNOFFICAL_HEADING_AUTHOR', 'author', $listDirn, $listOrder); ?>
  </th>
  <th width="10%">
  <?php echo JHtml::_('searchtools.sort', 'COM_TOWNOFFICAL_TOWNOFFICAL_HEADING_CREATED_DATE', 'created', $listDirn, $listOrder); ?>
  </th>
  <th width="5%">
  <?php echo JHtml::_('searchtools.sort', 'COM_TOWNOFFICAL_TOWNOFFICAL_HEADING_PUBLISHED', 'published', $listDirn, $listOrder); ?>
  </th>
  <th width="2%">
  <?php echo JHtml::_('searchtools.sort', 'COM_TOWNOFFICAL_TOWNOFFICAL_HEADING_ID','id', $listDirn, $listOrder); ?>
  </th>
</tr>
