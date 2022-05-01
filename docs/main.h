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
//  Last Modified : <220501.0841>
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
 * @mainpage Town Official Joomla Component
 * This is a Joomla Component that implements a database of town officials,
 * both elected and appointed.  There is a plugin and a module that are used
 * to expose this data on the frontend.  The plugin implements a special
 * markup feature to include references to town officials in frontend 
 * content (such as articles).  The module implements a "sidebar" module
 * that provides displaying information about a town office, including
 * the involved officials' names and additional information such as office
 * hours or meeting times, contact info, etc.
 * 
 * @section main_infostored Information stored in the database
 * The Town Official database has two parts: a set of offices and the people
 * who inhabit those offices.
 * @subsection main_infostored_offices Offices
 * The offices have a name (eg Board of Health or Moderator) and a description
 * (actually the offices use the Joomla category table).  The description is
 * what the sidebar module displays, so this is a good place to include
 * information like office hours, meeting times, contact info, etc.
 * @subsection main_infostored_offical Officials' data
 * The Town Official's detailed information includes:
 * - Office This is a drop down from the Offices list.
 * - Name   This is the name of the Offical.
 * - Member Office This is a title within the Office. Typically this would be 
 *   something like Chair or Clerk, but it could include other possibilities
 * - Term Ends This is the date that the officials current term ends.
 * - Sworn in date This is the date the offical was last sworn in.
 * - Ethics Expires This is the date the official's ethics certification expired.
 * - Is Elected? This indicates if the official's position is an elected one.
 * - EMail This is the official's E-Mail address.
 * - Telephone This is the official's telephone number.
 * - Notes This is any additional notes.
 * 
 * @section main_plugin Plugin - embedding Town Offical information in frontend content
 * The Town Offical Content Plugin can display Town Officials in other Joomla! 
 * content such as articles.
 * 
 * The plugin is automatically installed/updated when installing/updating the 
 * Town Offical component.
 * 
 * @subsection main_plugin_usage Usage
 * 
 * @code{.unparsed}
 * {townoffical "office" opts}
 * @endcode
 * where office is the name of an office and opts are optional options:
 * - member=1   Include member office (default)
 * - member=0   Don't include member office
 * - term=1     Include term ending year (default)
 * - term=0     Don't include term ending year
 * - beforeall=tag Default: beforeall=\<p\>
 * - before=tag Default: before=
 * - after=tag  Default: after=\<br /\>
 * - afterall=tag Default: afterall=\</p\>
 * - class=class Outer div class Default: townoffical
 * 
 * Example:
 * @code{.unparsed}
 * {townoffical "Board of Health"  member=0 term=0 beforeall=<ul>
 *                                 before=<li> after=</li>
 *                                 afterall=</ul>}
 * @endcode
 * Generates something like this:
 * @code{.html}
 * <div class="townoffical" ><ul>
 *    <li>Barbara Craddock</li> 
 *    <li>Shay Cooper</li>
 *    <li>Judith Bailey</li></ul></div>
 * @endcode
 * 
 * @code{.unparsed}
 * {townunit "unit" opts}
 * @endcode
 * where unit is the name of an office and opts are optional options:
 * - description=1 Include the description (default)
 * - description=0 Don't include the description
 * - htag=tag Default: h4
 * - class=class Outer div class Default: townunit
 * 
 * Example:
 * @code{.unparsed}
 * {townunit "Board of Health"}
 * @endcode
 * Generates something like this:
 * @code{.unparsed}
 * <div class="townunit"><h4>Board of Health</h4>This is the board of health</div>
 * @endcode
 * 
 * @section main_module Module - generating "sidebars" for Town Offical pages
 * The Town Offical sidebar module can create sidebar content for Town Offical
 * pages.
 * 
 * The module is automatically installed/updated when installing/updating the
 * Town Offical component. 
 * 
 * @subsection main_module_usage Usage
 * 
 * The module has one parameter setting, the office.  The module will then 
 * generate the name of the office or body, the offical or officials that hold
 * that office or make up the body, along with their member offices (if any).
 * The office's or body's description is also included -- the description can be
 * used to hold the office's office hours or the body's meeting schedule, 
 * along with contact information and any other information for the sidebar.
 * 
**/

#endif // __MAIN_H

