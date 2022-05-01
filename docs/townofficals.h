// -!- c++ -!- //////////////////////////////////////////////////////////////
//
//  System        : 
//  Module        : 
//  Object Name   : $RCSfile$
//  Revision      : $Revision$
//  Date          : $Date$
//  Author        : $Author$
//  Created By    : Robert Heller
//  Created       : Sat Apr 30 14:53:10 2022
//  Last Modified : <220430.1619>
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

#ifndef __TOWNOFFICALS_H
#define __TOWNOFFICALS_H

/** 
 * @page TownOfficals Town Offical Listing
 * This is the listing of town officials and their offices.  There are two
 * submenu items:
 * - Town Officals These are the officials themselves
 * - Offices These are the offices they hold.
 * @section offics_officals Town Officals page
 * This page contains the listing of town officals.
 * 
 * Below the toolbar are the search and filter options.  The search is by the
 * name of the offical.  The search tools open up three filtering options:
 * - Status This is the published status.
 * - Office This is the office
 * - Elected or Appointed
 * 
 * 
 * The table can also be sorted on various columns.  Below the filtering, 
 * searching, and sorting options is the table proper.  The displayed columns
 * are:
 * - row number
 * - checkbox
 * - Office This is the office.
 * - Name This is the official's name.  It can be clicked on to display or edit
 *   The official's data record.
 * - Member Office This is the member office.
 * - Term ends This is date the official's current term ends.  If the term has 
 *   already ended, it is displayed in red.
 * - Is Elected? Whether the office is elected or appointed.
 * - Created by The Joomla user who created this record.
 * - Created on The time the record was created.
 * - Published Whether the record is published.
 * - Id The record's ID.
 * 
 * @subsection offics_officals_toolbar Toolbar buttons
 * There are 10 toolbar buttons:
 * - New  This creates a new offical
 * - Edit This edits an existing offical
 * - Delete This deletes an offical
 * - Import This bulk imports officals from a CSV file
 * - Export This bulk exports officals to a CSV file
 * - Check-in This checks in officals whose data record has been checked out
 * - Publish This publishes an official's record
 * - Unpublish This unpublishes an official's record
 * - Help This provides help (documentation)
 * - Options This allows editing the parameter settings
 * @subsubsection offics_officals_toolbar_new Create a new offical
 * 
 * This button opens a @ref TownOffical where a new official's record can
 * be entered.
 * 
 * @subsubsection offics_officals_toolbar_edit Edit an existing offical
 * This button opens a @ref TownOffical where an existing official's record can
 * be edited.
 * 
 * @subsubsection offics_officals_toolbar_delete Delete selected officals
 * This button will delete the selected officals' records.
 * 
 * @subsubsection offics_officals_toolbar_import Import officals from a CSV file
 * This button will open a @ref ImportForm which allows for uploading a 
 * CSV file containing town offical records.
 * 
 * @subsubsection offics_officals_toolbar_export Export offices to a CSV file
 * This button will export the town offical records as a CSV file.
 * 
 * @subsubsection offics_officals_toolbar_checkin Checkin selected officals
 * This button will check in town offical records that are checked out.
 * 
 * @subsubsection offics_officals_toolbar_publish Publish selected officals
 * This button will publish selected officals.
 * 
 * @subsubsection offics_officals_toolbar_unpublish Unpublish selected officals
 * This button will unpublish selected officals.
 * 
 * @subsubsection offics_officals_toolbar_help Get documentation
 * This button will open documentation.
 * 
 * @subsubsection offics_officals_toolbar_options Edit global parameter settings
 * This button will edit global parameter settings.
 * 
 * @section offics_offices Offices (Categories) page
 * This page contains the listing of town offices.  This page uses Joomla's
 * category feature.
 **/


#endif // __TOWNOFFICALS_H

