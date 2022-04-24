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
 *  Created       : Sun Apr 24 11:10:30 2022
 *  Last Modified : <220424.1418>
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
 * Usage:
 *
 * {townoffical "office" opts}       where office is the name of an office 
 *                                   and opts are optional options:
 *                                   -  member=1   Include member office (default)
 *                                   -  member=0   Don't include member office
 *                                   -  term=1     Include term ending year (default)
 *                                   -  term=0     Don't include term ending year
 *                                   -  beforeall=tag Default: beforeall=<p>
 *                                   -  before=tag Default: before=
 *                                   -  after=tag  Default: after=<br />
 *                                   -  afterall=tag Default: afterall=</p>
 *                                   -  class=class Outer div class Default: townoffical
 *                                   Example:
 *                                   {townoffical "Board of Health"
 *                                     member=0 term=0 beforeall=<ul>
 *                                     before=<li> after=</li>
 *                                     afterall=</ul>}
 *                                   Generates something like this:
 * <div class="townoffical"><ul><li>Barbara Craddock</li>
 *                              <li>Shay Cooper</li>
 *                              <li>Judith Bailey</li></ul></div>
 *                              
 *
 ****************************************************************************/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

use Joomla\String\StringHelper;
use Joomla\CMS\HTML\HTMLHelper;

jimport( 'joomla.plugin.plugin' );

//if(!defined('DS')){
//  define('DS',DIRECTORY_SEPARATOR);
//} 
//require_once( JPATH_ROOT . DS . 'components' . DS . 'com_townoffical' . DS . 'helpers' . DS .'pluginhelper.php' );

class plgContentTownOfficalEmbedOffice extends JPlugin {
  
  protected $app;
  protected $db;
  
  function __construct(&$subject, $article_params)
  {
    parent::__construct($subject, $article_params);
    $db = JFactory::getDBO();
    $app = JFactory::getApplication();
  }
  
  function onContentPrepare($context, &$article, &$params, $limitstart)
  {
    if ($app->isSite()) 
    {
      // Simple performance check to determine whether bot should process further
      if (isset($article->text))
      {
        if (strpos($article->text, '{townoffical') === false)
        {
          return;
        }
      }
      else
      {
        return;
      }
      
      $regex = '#{townoffical "([^"]*)"[[:space:]]*([^}]*)}#s'
      $article->text = preg_replace_callback($regex, 
                                             array($this, 'embed_officals'), 
                                             $article->text);
      return true;
    }
  }
  function _parseOpts($opts,$options)
  {
    preg_match_all('/([[:alpha:]]+)=(|0|1|(<[^>]+>))[[:space:]]/',$opts.' ',$outs,
                   PREG_SET_ORDER);
    foreach ($outs as $out)
    {
      $options[$out[1]] = $out[2];
    }
    return $options;
  }
  
  function embed_officals($matches)
  {
    $office = $matches[1];
    $options = $this->_parseOpts ($matches[2],
                                  array('member' => true,
                                        'term' => true,
                                        'beforeall' => '<p>',
                                        'before' => '',
                                        'after' => '<br />',
                                        'afterall' => '</p>',
                                        'class' => 'townoffical'));
    
    $query = $db->getQuery(true);
    $query->select('o.id as id, o.name as name, o.auxoffice as member, o.termends as termends, c.title as office')
          ->from('#__townoffical as o')
          ->leftJoin('#__categories as c ON o.catid=c.id')
          ->where('o.published = 1 AND office = '.$db->quote($office));
    $items = $db->loadObjectList('id');
    $result = '<div class=".$options['class'].">'.$options['beforeall'];
    foreach ($items as $item)
    {
      $result .= $options['before'];
      $result .= $item->name;
      if ($options['member'] && $item->member != '')
      {
        $result .= ',&nbsp;'.$item->member
      }
      if ($options['term']) {
        $result .= '&nbsp;'.date_format ( date_create($item->termends), 'Y' );
      }
      $result .= $options['after'];
    }
    $result .= $options['afterall'].'</div>';
    return $result;          
  }
}

