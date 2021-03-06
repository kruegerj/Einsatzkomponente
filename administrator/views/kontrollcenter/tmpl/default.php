<?php
/**
 * @version     3.0.0
 * @package     com_einsatzkomponente
 * @copyright   Copyright (C) 2013 by Ralf Meyer. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Ralf Meyer <webmaster@feuerwehr-veenhusen.de> - http://einsatzkomponente.de
 */
// no direct access
defined('_JEXEC') or die;
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');

JHtml::_('behavior.multiselect');

$version = new JVersion;
if ($version->isCompatible('3.0')) :
	JHtml::_('bootstrap.tooltip');
	JHtml::_('formbehavior.chosen', 'select'); 
endif;

// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_einsatzkomponente/assets/css/einsatzkomponente.css');
// Versions-Nummer 
$db = JFactory::getDbo();
$db->setQuery('SELECT manifest_cache FROM #__extensions WHERE name = "com_einsatzkomponente"');
$params = json_decode( $db->loadResult(), true );
$user	= JFactory::getUser();
$userId	= $user->get('id');
?>
<script type="text/javascript">
	Joomla.orderTable = function() {
		table = document.getElementById("sortTable");
		direction = document.getElementById("directionTable");
		order = table.options[table.selectedIndex].value;
		if (order != '<?php echo $listOrder; ?>') {
			dirn = 'asc';
		} else {
			dirn = direction.options[direction.selectedIndex].value;
		}
		Joomla.tableOrdering(order, dirn, '');
	}
</script>
<?php
//Joomla Component Creator code to allow adding non select list filters
if (!empty($this->extra_sidebar)) {
    $this->sidebar .= $this->extra_sidebar;
}
?>
<form action="<?php echo JRoute::_('index.php?option=com_einsatzkomponente&view=kontrollcenter'); ?>" method="post" name="adminForm" id="adminForm">
<?php if(!empty($this->sidebar)): ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
<?php else : ?>
	<div id="j-main-container">
<?php endif;?>
    
		<div id="filter-bar" class="btn-toolbar"></div> 
               
        
		<table class="table">
			<thead>
				<tr>
					<th>
			<div class="row-fluid">
				<div class="span12">
						
	    					<a class="btn" href="index.php?option=com_einsatzkomponente&view=einsatzberichte">
		    				<img alt="<?php echo JText::_('COM_EINSATZKOMPONENTE_TITLE_EINSATZBERICHTE'); ?>" src="components/com_einsatzkomponente/assets/images/menu/liste.png" /><br/>
		    				<span><?php echo JText::_('COM_EINSATZKOMPONENTE_TITLE_EINSATZBERICHTE'); ?></span>
	    					</a>
    						
						
	    					<a class="btn" href="index.php?option=com_einsatzkomponente&view=einsatzarten">
		    				<img alt="<?php echo JText::_('COM_EINSATZKOMPONENTE_TITLE_EINSATZARTEN'); ?>" src="components/com_einsatzkomponente/assets/images/menu/einsatzarten.png" /><br/>
		    				<span><?php echo JText::_('COM_EINSATZKOMPONENTE_TITLE_EINSATZARTEN'); ?></span>
	    					</a>
    						
						
	    					<a class="btn" href="index.php?option=com_einsatzkomponente&view=organisationen">
		    				<img alt="<?php echo JText::_('COM_EINSATZKOMPONENTE_TITLE_ORGANISATIONEN'); ?>" src="components/com_einsatzkomponente/assets/images/menu/organisationen.png" /><br/>
		    				<span><?php echo JText::_('COM_EINSATZKOMPONENTE_TITLE_ORGANISATIONEN'); ?></span>
	    					</a>
    						
						
	    					<a class="btn" href="index.php?option=com_einsatzkomponente&view=alarmierungsarten">
		    				<img alt="<?php echo JText::_('COM_EINSATZKOMPONENTE_TITLE_ALARMIERUNGSARTEN'); ?>" src="components/com_einsatzkomponente/assets/images/menu/alarmierungsarten.png" /><br/>
		    				<span><?php echo JText::_('COM_EINSATZKOMPONENTE_TITLE_ALARMIERUNGSARTEN'); ?></span>
	    					</a>
    						
						
	    					<a class="btn" href="index.php?option=com_einsatzkomponente&view=einsatzfahrzeuge">
		    				<img alt="<?php echo JText::_('COM_EINSATZKOMPONENTE_TITLE_EINSATZFAHRZEUGE'); ?>" src="components/com_einsatzkomponente/assets/images/menu/einsatzfahrzeuge.png" /><br/>
		    				<span><?php echo JText::_('COM_EINSATZKOMPONENTE_TITLE_EINSATZFAHRZEUGE'); ?></span>
	    					</a>
    						
	    					<!--<a class="btn" href="index.php?option=com_einsatzkomponente&view=beispiel">
		    				<img alt="<?php echo JText::_('COM_EINSATZKOMPONENTE_TITLE_BEISPIEL'); ?>" src="components/com_einsatzkomponente/assets/images/menu/beispiel.png" /><br/>
		    				<span><?php echo JText::_('COM_EINSATZKOMPONENTE_TITLE_BEISPIEL'); ?></span>
	    					</a>-->
    					
	    					<a class="btn" href="index.php?option=com_einsatzkomponente&view=einsatzbildmanager">
		    				<img alt="<?php echo JText::_('COM_EINSATZKOMPONENTE_TITLE_EINSATZBILDMANAGER'); ?>" src="components/com_einsatzkomponente/assets/images/menu/einsatzbildmanager.png" /><br/>
		    				<span><?php echo JText::_('COM_EINSATZKOMPONENTE_TITLE_EINSATZBILDMANAGER'); ?></span>

	    					</a>
<?php
$version = new JVersion;
if ($version->isCompatible('3.0')) : ?>
	    					<a class="btn" href="index.php?option=com_config&view=component&component=com_einsatzkomponente">
		    				<img alt="<?php echo JText::_('Optionen'); ?>" src="components/com_einsatzkomponente/assets/images/menu/einstellungen.png" /><br/>
		    				<span><?php echo JText::_('Optionen'); ?></span>
	    					</a>
<?php endif;?>                           
                    </div>
                    </div>
	
					</th>
				</tr>
			</thead>
			<tbody>
            

            
				<tr>
					<td>


<div class="span4">
<div class="alert alert-info" style=" float:left;">
<a target="_blank" href="http://www.einsatzkomponente.de/index.php"><img src="<?php echo JURI::base(); ?>components/com_einsatzkomponente/assets/images/komponentenbanner.jpg" style="float:left; margin-right:20px; padding-right:20px;"/></a>
<span class="label label-important">Was könnt Ihr zur Entwicklung beitragen ?</span><br/><br/>
Neben sehr viel Freizeit kostet die Entwicklung unserer Software und der Unterhalt dieser Supportseite natürlich auch Geld.
Unterstützen Sie die Weiterentwicklung unseres Projekts EINSATZKOMPONENTE mit einer Spende, damit wir unsere Software auch weiterhin kostenlos und werbefrei zur Verfügung stellen können.
<br/>Vielen Dank ! <br />
<small>Kontakt: <?php echo $params['authorEmail'];?></small><br />


<p><a target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=9HDFKVJSKSEFY"><span style="float:right;">Spenden über PAYPAL : <img border=0  src="https://www.paypalobjects.com/de_DE/DE/i/btn/btn_donateCC_LG.gif" /></span></a>
<p><small><span style="float:right;"></br>Alternativ können Sie die Kontodaten per <a href="mailto:validate@einsatzkomponente.de?Subject=Spende%20Einsatzkomponente%20J3.x" target="_top">Email </a>anfordern.</span></small></p></p>


</div>
</div>
<div class="span5">
					<div class="well well-small" style=" float:left;">
						<div class="center">
							<?php echo '<h4>'.JTEXT::_('Einsatzkomponente Version ');?><?php echo $params['version'].'</h4>';?>
						</div>
						<hr class="hr-condensed">
						<dl class="dl-horizontal">
							<dt>Version:</dt>
							<dd><?php echo $params['version'];?>
							<?php if ($this->params->get('eiko')) : ?>
							<?php echo '<span class="label label-success"> ( validiert ) </span>';?>
                            <?php else:?>
							<?php echo '<span class="label label-important"> ( nicht validiert ) </span> siehe Optionen / Info';?>
                            <?php endif;?>
                            </dd>
							<dt>Release-Datum:</dt>
							<dd><?php echo $params['creationDate'];?></dd>
							<dt>Autor:</dt>
							<dd><?php echo $params['author'];?></dd>
							<dt>Autor-Email:</dt>
							<dd><?php echo $params['authorEmail'];?></dd>
							<dt>Copyright:</dt>
							<dd><?php echo $params['copyright'];?></dd>
							<dt>Lizenz:</dt>
							<dd>GNU General Public License version 2 or later </dd>
						</dl>
</div>
          
					<div class="well well-small" style="float:left;">
					
						Aktuellste Version: <iframe  frameborder="0" height="30px" width="250px" src="http://www.feuerwehr-veenhusen.de/images/einsatzkomponenteJ30/index.html" scrolling="no"></iframe><br/><a target="_blank" class="btn" href="http://www.einsatzkomponente.de">Download-Link Webseite</a> <a target="_blank" class="btn" href="https://github.com/veenmeyer/Einsatzkomponente">Link zu GitHub</a>			

						<!-- Button to trigger modal -->
						<a href="#myModal" role="button" class="btn" data-toggle="modal">Verfügbare Module ...</a>
     
						<!-- Modal -->
						<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h3 id="myModalLabel">Verfügbare Module</h3>
						</div>
						<div class="modal-body">
						<ul>
						<li>mod_eiko_last (Modul zur Anzeige der letzten Einsätze auf einer Modulposition)</li>
						<li>mod_eiko_chart (Modul zur Anzeige einer Statistik in Kuchenform auf einer Modulposition)</li>
						<li>mod_eiko_statistik (Modul zur Anzeige einer Statistik als Balkendiagramm auf einer Modulposition)</li>
						<li>mod_eiko_melder (Modul zur Anzeige des letzten Einsatzes auf einen Meldeempfänger)</li>
						<li>mod_eiko_einsatzticker (Modul zur Anzeige des letzten Einsatzes als Tickerlaufschrift)</li>
						<li>mod_eiko_led (Modul zur Anzeige des letzten Einsatzes als LED-Tickerlaufschrift)</li>
						<li>mod_eiko_articles_news (Modul zur Anzeige der letzten Einsätze als Joomla-Artikel)</li>
						</ul>
						<h4>Mehr Infos dazu auf www.einsatzkomponente.de</h4>
						</div>
						<div class="modal-footer">
						<button class="btn" data-dismiss="modal" aria-hidden="true">Schliessen</button>
						<!--<button class="btn btn-primary">Save changes</button> !-->
						</div>
						</div>		
				</div>
				
						
					</td>
                    
               </tr>
               
                
                <tr>
               		 <td>
						<div class="alert alert-block alert-info">
						<button class="close" data-dismiss="alert" type="button">×</button>
						<p> </p>
						<h4 style="margin-bottom:5px;">Nützliche Links</h4>
						<ul>
						<li>
						<a target="_blank" href="http://einsatzkomponente.de" style="text-decoration:underline">Supportforum für die Einsatzkomponente</a>
						</li>
						<li>
						<a target="_blank" href="http://www.leitstelle-joomla.de" style="text-decoration:underline">Testseite für die Einsatzkomponente V3.x für J3</a>
						</li>
						<li>
						<a target="_blank" href="http://www.feuerwehr-veenhusen.de" style="text-decoration:underline">Freiwillige Feuerwehr Veenhusen </a><font-size:small>(über ein paar nette im Gästebuch würde ich mich sehr freuen  lg Ralf Meyer )</font-size>
						</li>
						</ul>
						</div>
                  </td>
             </tr>
                
            </tbody>
			<tfoot>
				<tr>
					<td colspan="10">
						<?php echo 'Copyright (C) 2013 by Ralf Meyer. All rights reserved.
 *  GNU General Public License version 2 or later'; ?>
					</td>
				</tr>
			</tfoot>
            
		</table>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>     
		
