# COM_TownOfficialDB

This Joomla component (which includes one plugin and one module) implements a 
database of Town Officals, which would include indiviual elected and appointed 
officals (for example Town Clerk) and "bodies" -- committees, boards, and 
commissions (for example Board of Health).

## Database Structure

This component uses the Joomla category table for the "offices" and its own 
table for the officals themselves.  Each office has a name and a description. 
Typically the description contains the information that would be in the 
offical's or body's sidebar: contact info, meeting or office times, etc. For 
each offical the information stored includes the name of the offical, an 
(optional) sub-office (typically Chair or Clerk for bodies), the date the 
offical's term ends, the date the offical was sworn in, the date the offical's 
ethics certification expires, also whether the offical was elected or 
appointed.

## Usage

The database can be managed from either the backend (full functionallity) and 
the front end (limited functionallity).  

### Plugin

There is a plugin that allows 
insertingofficials by office and unit information by office into content 
(typicallyarticles) using special markup.

Officals:

`{townoffical "office" opts}`

where office is the name of the office and opts are *optional* options:

-  `member=1`   Include member office (default)
-  `member=0`   Don't include member office
-  `term=1`     Include term ending year (default)
-  `term=0`     Don't include term ending year
-  `beforeall=tag` Default: `beforeall=<p>`
-  `before=tag` Default: `before=`
-  `after=tag`  Default: `after=<br />`
-  `afterall=tag` Default: `afterall=</p>`
-  `class=class` Outer div class Default: `townoffical`

Example:   `{townoffical "Board of Health"
                  member=0 term=0 beforeall=<ul>
                  before=<li> after=</li>
                  afterall=</ul>}`

Generates something like this:

`<div class="townoffical"><ul><li>Barbara Craddock</li><li>Shay Cooper</li><li>Judith Bailey</li></ul></div>`

Unit:

`{townunit "unit" opts}`

where unit is the name of an office and opts are optional options:

- `description=1` Include the description (default)
- `description=0` Don't include the description
- `htag=tag` Default: h4
- `class=class` Outer div class Default: townunit

Example: `{townunit "Board of Health"}`


Generates something like this:

`<div class="townunit"><h4>Board of Health</h4>This is the board of health</div>`

### Module

The module generates sidebar content for a given offical or body.  It displays 
the officals' name(s), possible member office, and the description for the 
office (body).  The description could have contact info, office hours or 
meeting schedule, and any other info that might be useful.
