<?php
/**
 * @version     3.0.0
 * @package     com_einsatzkomponente
 * @copyright   Copyright (C) 2013 by Ralf Meyer. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Ralf Meyer <webmaster@feuerwehr-veenhusen.de> - http://einsatzkomponente.de
 */
// No direct access
defined('_JEXEC') or die;
jimport('joomla.application.component.view');
/**
 * View class for a list of Einsatzkomponente.
 */
 
class EinsatzkomponenteViewEinsatzberichte extends JViewLegacy
{
	
	protected $pagination;

	
	
	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$app                = JFactory::getApplication();
        $this->params       = $app->getParams('com_einsatzkomponente');
        $this->pagination	= $this->get('Pagination');

		
		
		require_once JPATH_SITE.'/administrator/components/com_einsatzkomponente/helpers/einsatzkomponente.php'; // Helper-class laden
		

		$layout_detail = $this->params->get('layout_detail',''); // Detailbericht Layout
		$this->layout_detail_link = '';  
		if ($layout_detail) : $this->layout_detail_link = '&layout='.$layout_detail;  endif; // Detailbericht Layout 'default' ?

		
		$rows 		= EinsatzkomponenteHelper::letze_x_einsatzdaten ($this->params->get('rss_items','10')); 
		
		$app	= JFactory::getApplication();
		$menus	= $app->getMenu();
		$title	= null;
		// Because the application sets a default page title,
		// we need to get it from the menu item itself
		$menu = $menus->getActive();
		$this->document->link = JRoute::_('index.php?option=com_einsatzkomponente&view=einsatzberichte&Itemid='.$menu->id);;

		foreach ( $rows as $row )
		{
			$auswahlorga = str_replace(",", " +++ ", $row->auswahlorga);
			$title = html_entity_decode( $title );
			$summary = $this->escape( $row->summary );
			$title = html_entity_decode( $summary );
			$desc = strip_tags( $row->desc);
			$desc = (strlen($desc) > $this->params->get('rss_chars','1000')) ? substr($desc,0,strrpos(substr($desc,0,$this->params->get('rss_chars','1000')+1),' ')).' ...' : $desc;

			// url link to article
			// & used instead of &amp; as this is converted by feed creator
			$link = JRoute::_('index.php?option=com_einsatzkomponente&view=einsatzbericht'.$this->layout_detail_link.'&id='.$row->id);

			// strip html from feed item description text
			/*$description	= ($params->get('feed_summary', 0) ? $row->introtext.$row->fulltext : $row->introtext);
			$author			= $row->created_by_alias ? $row->created_by_alias : $row->author;
*/
			// load individual item creator class
			
			$item = new JFeedItem();
			$item->title 		= $title;
			$item->link 		= $link;

			$item->description 	.= '<table>';

			if ($this->params->get('show_rss_image','1')) :
			if ($row->foto) :
			$item->description 	.= '<tr><td><img src="'.JURI::base().$row->foto.'" width="'.$this->params->get('rss_image_width','150px').'" height="'.$this->params->get('rss_image_height','').'" /></td></tr>';
			endif;
			endif;
			if ($row->desc) :
			$item->description 	.= '<tr><td>'.$desc.'</td></tr>';
			endif;
			if ($row->auswahlorga) :
			$item->description 	.= '<tr><td><b>Einsatzkräfte</b>: +++ '.$auswahlorga.'</td></tr>';
			endif;
		    $item->date = date('r', strtotime($row->date1));
			$item->description 	.= '</table>';
			/*$item->category   	= $row->category;
			$item->author		= $author;
			if ($feedEmail == 'site') {
				$item->authorEmail = $siteEmail;
			}
			else {
				$item->authorEmail = $row->author_email;
			}
*/
			// loads item info into rss array
			$this->document->addItem( $item );
		}
		
		
		 // Check for errors.
        if (count($errors = $this->get('Errors'))) {;
            throw new Exception(implode("\n", $errors));
        }
        parent::display($tpl);
	}
	
	}
	
