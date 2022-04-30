// -!- c++ -!- //////////////////////////////////////////////////////////////
//
//  System        : 
//  Module        : 
//  Object Name   : $RCSfile$
//  Revision      : $Revision$
//  Date          : $Date$
//  Author        : $Author$
//  Created By    : Robert Heller
//  Created       : Sat Apr 30 14:53:58 2022
//  Last Modified : <220430.1643>
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

#ifndef __IMPORTFORM_H
#define __IMPORTFORM_H

/**
 * @page ImportForm Town Offical bulk import form
 * This page collects this information to import town offical records from a 
 * csv file:
 * - CSV file to upload The file to upload
 * - Use CSV Header Whether to use the first line as column headers
 * - CSV Delimiter The CSV delimiter
 * - CSV Quote character The CSV quote characted
 * 
 * If you check the Use CSV Header, the first line of the file contains column
 * headers.  Recognozed headers are (case insensitive):
 * - auxoffice This is the member office (Chair, Clerk, etc.).
 * - name This is the offical's name.
 * - termends This is date (dd-mm-yyyy or mm-dd-yyyy) the offical's term ends.
 * - swornindate This is the date the offical was sworn in.
 * - ethicsexpires This is the date the offical's ethics certification expires.
 * - iselected whether the offical position is elected (can be yes, no, true, false, 1, or 0).
 * - email The offical's email address.
 * - telephone The offical's phone number.
 * - notes Additional notes.
 * - "aux office" (alias for auxoffice)
 * - office
 * - "term ends" (alias for termends)
 * - "sworn in date" (alias for swornindate)
 * - "ethics expires" (alias for ethicsexpires)
 * - "is elected" (alias for iselected)
 * - e-mail (alias for email)
 * - phone (alias telephone)
 * 
 * The columns office, name, termends, iselected are manditory.
 * 
 * If the Use CSV Header checkbox is not checked, the columns are assumed to 
 * be this order:
 * - 4 columns: office, name, termends, iselected
 * - 5 columns: office, name, termends, iselected, email
 * - 6 columns: office, name, termends, iselected, email, telephone
 * - 7 columns: office, name, termends, swornindate, iselected, email, telephone
 * - 8 columns: office, name, termends, swornindate, ethicsexpires, iselected, email, telephone
 * - 9 columns: office, name, termends, swornindate, ethicsexpires, iselected, email, telephone, notes
 * - 10 columns: office, name, termends, swornindate, ethicsexpires, iselected, email, telephone, notes, auxoffice
 * 
 **/


#endif // __IMPORTFORM_H

