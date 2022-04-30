// -!- c++ -!- //////////////////////////////////////////////////////////////
//
//  System        : 
//  Module        : 
//  Object Name   : $RCSfile$
//  Revision      : $Revision$
//  Date          : $Date$
//  Author        : $Author$
//  Created By    : Robert Heller
//  Created       : Sat Apr 30 14:46:34 2022
//  Last Modified : <220430.1536>
//
//  Description	
//
//  Notes
//
//  History
//	
/////////////////////////////////////////////////////////////////////////////
//
//    Copyright (C) 2022  Robert Heller D/B/A Deepwoods Software
//			51 Locke Hill Road
//			Wendell, MA 01379-9728
//
//    This program is free software; you can redistribute it and/or modify
//    it under the terms of the GNU General Public License as published by
//    the Free Software Foundation; either version 2 of the License, or
//    (at your option) any later version.
//
//    This program is distributed in the hope that it will be useful,
//    but WITHOUT ANY WARRANTY; without even the implied warranty of
//    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//    GNU General Public License for more details.
//
//    You should have received a copy of the GNU General Public License
//    along with this program; if not, write to the Free Software
//    Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.
//
// 
//
//////////////////////////////////////////////////////////////////////////////

#ifndef __MAIN_H
#define __MAIN_H

/** 
 * @mainpage Town Offical Joomla Component
 * This is a Joomla Component that implements a database of town officials,
 * both elected and appointed.  There is a plugin and a module that are used
 * to expose this data on the frontend.  The plugin implements a special
 * markup feature to include references to town officials in frontend 
 * content (such as articles).  The module implemnets a "sidebar" module
 * that provides displaying information about a town office, including
 * the involved officials' names and additional information such as office
 * hours or meeting times, contact info, etc.
 * 
 * @section main_infostored Information stored in the database
 * The Town Offical database has two parts: a set of offices and the people
 * who inhabit those offices.
 * @subsection main_infostored_offices Offices
 * The offices have a name (eg Board of Health or Moderator) and a description
 * (actually the offices use the Joomla category table).  The description is
 * what the sidebar module displays, so this is a good place to include
 * information like office hours, meeting times, contact info, etc.
 * @subsection main_infostored_offical Officals' data
 * The Town Offical's detailed infomation includes:
 * - Office This is a dropdown from the Offices list.
 * - Name   This is the name of the Offical.
 * - Member Office This is a title within the Office. Typically this would be 
 *   something like Chair or Clerk, but it could include other possibilities
 * - Term Ends This is the date that the officals current term ends.
 * - Sworn in date This is the date the offical was last sworn in.
 * - Ethics Expires This is the date the offical's ethics certification expired.
 * - Is Elected? This indicates if the offical's position is an elected one.
 * - EMail This is the offical's E-Mail address.
 * - Telephone This is the offical's telephone number.
 * - Notes This is any addional notes.
 * 
**/

#endif // __MAIN_H

