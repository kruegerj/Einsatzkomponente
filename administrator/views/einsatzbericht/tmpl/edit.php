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
$params = JComponentHelper::getParams('com_einsatzkomponente');
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');

$version = new JVersion;
if ($version->isCompatible('3.0')) :
JHtml::_('formbehavior.chosen', 'select');
endif;
// Daten aus der Bilder-Galerie holen 
if (!$this->item->id == 0)
	{
	$db = JFactory::getDBO();
	$query = 'SELECT id, thumb, comment FROM `#__eiko_images` WHERE `report_id`="'.$this->item->id.'" AND `state`="1" ORDER BY `ordering` ASC';
	$db->setQuery($query);
	$rImages = $db->loadObjectList();
	}
// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_einsatzkomponente/assets/css/einsatzkomponente.css');
 
?>
<?php $gmap_latitude = $this->item->gmap_report_latitude; ?>
<?php $gmap_longitude = $this->item->gmap_report_longitude; ?>
<?php if ($gmap_latitude < '1') $gmap_latitude = $this->gmap_config->start_lat; ?>
<?php if ($gmap_longitude < '1') $gmap_longitude = $this->gmap_config->start_lang; ?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'einsatzbericht.cancel' || document.formvalidator.isValid(document.id('einsatzbericht-form'))) {
			Joomla.submitform(task, document.getElementById('einsatzbericht-form'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>
<form action="<?php echo JRoute::_('index.php?option=com_einsatzkomponente&layout=edit&id='.(int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="einsatzbericht-form" class="form-validate">
	<div class="row-fluid">
		<div class="span10 form-horizontal">
            <fieldset class="adminform">
		<div class="fltlft well" style="width:80%;">
    		<br/><h1>Bitte geben Sie die Einsatzdaten an :</h1>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('id'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('id'); ?></div>
			</div>
            <?php if (JFactory::getUser()->authorise('core.admin','einsatzkomponente')): ?>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('counter'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('counter'); ?></div>
			</div>
            <?php endif;?>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('alerting'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('alerting'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('data1'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('data1'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('tickerkat'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('tickerkat'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('address'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('address'); ?></div>
            </div> 
			
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('date1'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('date1'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('date2'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('date2'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('date3'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('date3'); ?></div>
			</div>
     </div>
    		<div class="fltlft well" style="width:80%;">
    		<br/><h1>Einsatzkräfte :</h1>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('boss'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('boss'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('boss2'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('boss2'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('people'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('people'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('auswahl_orga'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('auswahl_orga'); ?></div>
			</div>
			<?php
				foreach((array)$this->item->auswahl_orga as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="auswahl_orga" name="jform[auswahl_orgahidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>
			<script type="text/javascript">
				jQuery.noConflict();
				jQuery('input:hidden.auswahl_orga').each(function(){
					var name = jQuery(this).attr('name');
					if(name.indexOf('auswahlorga_hidden')){
						jQuery('#jform_auswahl_orga option[value="'+jQuery(this).val()+'"]').attr('selected',true);
					}
				});
			</script>			
            	
            <div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('vehicles'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('vehicles'); ?></div>
			</div>
			<?php
				foreach((array)$this->item->vehicles as $value): 
					if(!is_array($value)):
				echo '<input type="hidden" class="vehicles" name="jform[vehicleshidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
				
				
			?>
			<script type="text/javascript">
				jQuery.noConflict();
				jQuery('input:hidden.vehicles').each(function(){
					var name = jQuery(this).attr('name');
					if(name.indexOf('vehicleshidden')){
						jQuery('#jform_vehicles option[value="'+jQuery(this).val()+'"]').attr('selected',true);
					}
				});
				</script>	
                
                
           </div>		
           
<?php 

//			$array = array();
//			foreach((array)$this->item->vehicles as $value): 
//				if(!is_array($value)):
//					$array[] = $value;
//				endif;
//			endforeach;
//			$vehicles = implode(',',$array);

//echo '<input id="fahrzeug"/>';
?>
<script>
function displayVals() {
var multipleValues = jQuery( "#jform_vehicles" ).val() || [];
jQuery( "#fahrzeug" ).val(multipleValues.join( ", " ) );
}
jQuery( "select" ).change( displayVals );
displayVals();
</script>

<?php


?>
	
<!--			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('department'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('department'); ?></div>
			</div>
-->			
    		<div class="fltlft well" style="width:80%;">
    		<br/><h1>Einsatzbericht :</h1>
			<div class="control-group" style="height:100px;">
				<div class="control-label"><?php echo $this->form->getLabel('image'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('image'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('summary'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('summary'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('desc'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('desc'); ?></div>
			</div>
          	</div>  
    		<div class="fltlft well" style="width:80%;">
    		<br/><h1>Quelle oder weiterführende Informationen :</h1>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getInput('presse_label'); ?>
									  <?php echo $this->form->getInput('presse'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getInput('presse2_label'); ?>
				                      <?php echo $this->form->getInput('presse2'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getInput('presse3_label'); ?>
				                      <?php echo $this->form->getInput('presse3'); ?></div>
			</div>
    		</div>
    
				<input type="hidden" name="jform[updatedate]" value="<?php echo $this->item->updatedate; ?>" />
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('einsatzticker'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('einsatzticker'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('notrufticker'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('notrufticker'); ?></div>
			</div>
				
        
        
            <!--Slider für GMap-Ortsangabe-->
            <?php if ($params->get('gmap_action','0')) : ?>
			<div class="fltlft well" style="width:80%;">
            <h1>Bitte markieren Sie den Einsatzort auf der Karte :</h1>
            <div class="control-group" id="map_canvas" style="width:100%;max-width:600px;height:400px;border:1px solid;">Karte</div>
			<div class="control-group">
            <div class="control-label">Koordinaten:</div><div class="controls"><?php echo $this->form->getInput('gmap_report_latitude'); ?><?php echo $this->form->getInput('gmap_report_longitude'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('gmap'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('gmap'); ?></div>
			</div>
            
			</div>
 			<?php  endif; ?>
            
            <!--Slider für Bildergalerie-->
            
<?php if (!$this->item->id == 0 && count($rImages)>'0' )	{ ?>
	<div class="fltlft well" style="width:80%;">
    <br/><h1>Einsatzbilder :</h1>
        <table>
        
			<?php 
			for ($i = 0;$i < count($rImages);++$i) {
			$fileName = '../'.$rImages[$i]->thumb;
			?>   
  			<ul class="thumbnails inline">
            <li class="span2">  
            <div class="thumbnail">
            <a href="index.php?option=com_einsatzkomponente&task=einsatzbilderbearbeiten.edit&id=<?php echo $rImages[$i]->id;?>" target="_self" class="thumbnail" title ="<?php echo $rImages[$i]->comment;?>">
			<img data-src="holder.js/300x200" src="<?php echo $fileName;?>"  alt="" title="<?php echo $fileName;?>"/>
            </a>
            <h5 class="label label-info">Bild ID.Nr. <?php echo $rImages[$i]->id;?></h5>
            <?php if ($rImages[$i]->comment): ?>Kommentar:<p><?php echo $rImages[$i]->comment;?></p><?php endif; ?>
            </div>
            </li>
			<?php 	} ?>
            </ul>
       </table>
	</div>
<?php }?>
	
    		<div class="fltlft well" style="width:80%;">

			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('article_id'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('article_id'); ?></div>
			</div>
    
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('status_fb'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('status_fb'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('state'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('state'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('created_by'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('created_by'); ?></div>
			</div>
            		<fieldset class="panelform">

            <input type="hidden" name="jform[status]" value="<?php echo $this->item->status; ?>" />
            </fieldset>
    	</div></div>
        
           <!--Slider für ACL Configuration-->
<?php if (JFactory::getUser()->authorise('core.admin','einsatzkomponente')): ?>
		<div class="fltlft well" style="width:80%;">
		<?php echo JHtml::_('sliders.start', 'permissions-sliders-'.$this->item->id, array('startOffset'=>-1)); ?>
		<?php echo JHtml::_('sliders.panel', JText::_('<h1>ACL Configuration</h1>'), 'access-rules'); ?>
		<fieldset class="panelform">
			<?php echo $this->form->getLabel('rules'); ?>
			<?php echo $this->form->getInput('rules'); ?>
		</fieldset>
		<?php echo JHtml::_('sliders.end'); ?>
	</div>
<?php endif; ?>
        <input type="hidden" name="task" value="" />
        <?php echo JHtml::_('form.token'); ?>
        
    </div>
</form>

<!-- Javascript für GMap-Anzeige -->

<?php if(isset($_SERVER['HTTPS'])) : $ssl='https://'; else:	$ssl='http://'; endif;?>
<script type="text/javascript" src="<?php echo $ssl;?>maps.google.com/maps/api/js?v=3&sensor=false"></script> 

<script type="text/javascript"> 
      var map = null;
      var marker = null;
      var marker2 = null;
	  var geocoder;

	  
function codeAddress2() {
    var address = document.getElementById("jform_address").value;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        placeMarker(results[0].geometry.location);
		latLng = marker.getPosition();
            document.getElementById("jform_gmap_report_latitude").value=latLng.lat();
            document.getElementById("jform_gmap_report_longitude").value=latLng.lng();
            document.getElementById("jform_address").style.color = "green";
            document.getElementById("jform_address").style.border = "solid green 2px";
      } else {
            document.getElementById("jform_address").style.color = "red";
            document.getElementById("jform_address").style.border = "solid red 2px";
        	<!--alert("Geocode war nicht erfolgreich. Geben sie eine andere Adresse ein, oder markieren Sie zusätzlich den Einsatzort auf der Karte (siehe weiter unten)");-->
      }
    });
  }	 
  
function placeMarker(location) {
    if (marker) {
        //if marker already was created change positon
        marker.setPosition(location);
    } else {
        //create a marker
        marker = new google.maps.Marker({
            position: location,
            map: map,
            draggable: true
        });
    }
}
   
 
// A function to create the marker and set up the event window function 
function createMarker(latlng, name, html) {
    var contentString = html;
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        draggable: true,
        zIndex: Math.round(latlng.lat()*-100000)<<5
        });
  google.maps.event.addListener(marker, 'dragend', function() {
    latLng = marker.getPosition();
            document.getElementById("jform_gmap_report_latitude").value=latLng.lat();
            document.getElementById("jform_gmap_report_longitude").value=latLng.lng();
        });
     google.maps.event.addListener(marker, 'click', function() {
      latLng = marker.getPosition();
            document.getElementById("jform_gmap_report_latitude").value=latLng.lat();
            document.getElementById("jform_gmap_report_longitude").value=latLng.lng();
        });
    google.maps.event.trigger(marker, 'click');    
    return marker;
}
 
function updateInfoWindow () {
}
 
function initialize() {
  // create the map
  geocoder = new google.maps.Geocoder();
  var myOptions = {
    zoom: <?php echo $this->gmap_config->gmap_zoom_level; ?>,
    center: new google.maps.LatLng(<?php echo $gmap_latitude; ?>,<?php echo $gmap_longitude; ?>), 
    mapTypeControl: true,
      scrollwheel: false,
      disableDoubleClickZoom: true,
	  streetViewControl: false,
      keyboardShortcuts: false,
      mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
      navigationControl: true,
      navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
    mapTypeId: google.maps.MapTypeId.<?php echo $this->gmap_config->gmap_onload; ?>
  }
  map = new google.maps.Map(document.getElementById("map_canvas"),
                                myOptions);
var marker2 = new google.maps.Marker({
        position: new google.maps.LatLng(<?php echo $gmap_latitude; ?>,<?php echo $gmap_longitude; ?>), 
        map: map,
        draggable: true,
        title:""
    });
    google.maps.event.addListener(map, 'click', function(event) {
	//call function to create marker
         if (marker) {
            marker.setMap(null);
            marker = null;
			marker2 = null;
         }
         if (marker2) {
			marker = null;
            marker2.setMap(null);
            marker2 = null;
         }
	 marker = createMarker(event.latLng, "name", "<b>Location</b><br>"+event.latLng);
  });
}
    
// Onload handler to fire off the app.
google.maps.event.addDomListener(window, 'load', initialize);
</script>
<!-- Javascript für GMap-Anzeige ENDE -->
