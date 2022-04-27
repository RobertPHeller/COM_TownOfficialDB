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
 *  Created       : Wed Apr 27 09:46:47 2022
 *  Last Modified : <220427.1030>
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

defined( '_JEXEC' ) or die( 'Restricted access' );

class ModTownOfficalHelper
{
  static function getOfficals($unitcat)
  {
    $db = JFactory::getDbo();
    $query = $db->getQuery(true);
    $query->select('o.id as id, o.name as name, o.auxoffice as member, '.
                   'o.termends as termends, c.title as office');
    $query->from('#__townoffical as o');
    $query->leftJoin('#__categories as c ON o.catid=c.id');
    $query->where('o.published = 1 AND c.id = '.$unitcat);
    $db->setQuery( (string)$query );
    $items = $db->loadObjectList();
    return $items;
  }
  static function getUnit($unitcat)
  {
    $db = JFactory::getDbo();
    $query = $db->getQuery(true);
    $query->select('id,title,description');
    $query->from('#__categories');
    $query->where('published = 1 AND id = '.$unitcat);
    $db->setQuery( (string)$query );
    $item = $db->loadObject();
    return $item;
  }
}

