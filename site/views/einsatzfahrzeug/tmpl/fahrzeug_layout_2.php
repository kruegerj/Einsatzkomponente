<?php
/**
 * @version     3.0.0
 * @package     com_einsatzkomponente
 * @copyright   Copyright (C) by Ralf Meyer 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Ralf Meyer <webmaster@feuerwehr-veenhusen.de> - http://einsatzkomponente.de
 */
// no direct access
defined('_JEXEC') or die;
//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_einsatzkomponente', JPATH_ADMINISTRATOR);
?>
<input type="button" class="btn eiko_back_button" value="Zurück" onClick="history.back();">

<?php if( $this->item ) : ?>
    <div class="item_fields">
        
        <ul class="fields_list">
			<li><?php echo JText::_('COM_EINSATZKOMPONENTE_FORM_LBL_EINSATZFAHRZEUG_ID'); ?>:
			<?php echo $this->item->id; ?></li>
			<li><?php echo JText::_('COM_EINSATZKOMPONENTE_FORM_LBL_EINSATZFAHRZEUG_ORDERING'); ?>:
			<?php echo $this->item->ordering; ?></li>
			<li><?php echo JText::_('COM_EINSATZKOMPONENTE_FORM_LBL_EINSATZFAHRZEUG_NAME'); ?>:
			<?php echo $this->item->name; ?></li>
			<li><?php echo $this->item->detail1_label; ?>:
			<?php echo $this->item->detail1; ?></li>
			<li><?php echo $this->item->detail2_label; ?>:
			<?php echo $this->item->detail2; ?></li>
			<li><?php echo $this->item->detail3_label; ?>:
			<?php echo $this->item->detail3; ?></li>
			<li><?php echo $this->item->detail4_label; ?>:
			<?php echo $this->item->detail4; ?></li>
			<li><?php echo $this->item->detail5_label; ?>:
			<?php echo $this->item->detail5; ?></li>
			<li><?php echo $this->item->detail6_label; ?>:
			<?php echo $this->item->detail6; ?></li>
			<li><?php echo $this->item->detail7_label; ?>:
			<?php echo $this->item->detail7; ?></li>
			<li><?php echo JText::_('COM_EINSATZKOMPONENTE_FORM_LBL_EINSATZFAHRZEUG_DEPARTMENT'); ?>:
			<?php echo $this->item->department; ?></li>
			<li><?php echo JText::_('COM_EINSATZKOMPONENTE_FORM_LBL_EINSATZFAHRZEUG_LINK'); ?>:
			<?php echo $this->item->link; ?></li>
			<li><?php echo JText::_('COM_EINSATZKOMPONENTE_FORM_LBL_EINSATZFAHRZEUG_IMAGE'); ?>:
			<?php echo $this->item->image; ?></li>
			<li><?php echo JText::_('COM_EINSATZKOMPONENTE_FORM_LBL_EINSATZFAHRZEUG_DESC'); ?>:
			<?php echo $this->item->desc; ?></li>
			<li><?php echo JText::_('COM_EINSATZKOMPONENTE_FORM_LBL_EINSATZFAHRZEUG_STATE'); ?>:
			<?php echo $this->item->state; ?></li>
			<li><?php echo JText::_('COM_EINSATZKOMPONENTE_FORM_LBL_EINSATZFAHRZEUG_CREATED_BY'); ?>:
			<?php echo $this->item->created_by; ?></li>
        </ul>
        
    </div>
								<?php if(JFactory::getUser()->authorise('core.delete','com_einsatzkomponente.einsatzfahrzeug.'.$this->item->id)):
								?>
									<a href="javascript:document.getElementById('form-einsatzfahrzeug-delete-<?php echo $this->item->id ?>').submit()">Delete</a>
									<form id="form-einsatzfahrzeug-delete-<?php echo $this->item->id; ?>" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_einsatzkomponente&task=einsatzfahrzeug.remove'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
										<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />
										<input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>" />
										<input type="hidden" name="jform[name]" value="<?php echo $this->item->name; ?>" />
										<input type="hidden" name="jform[detail1]" value="<?php echo $this->item->detail1; ?>" />
										<input type="hidden" name="jform[detail2]" value="<?php echo $this->item->detail2; ?>" />
										<input type="hidden" name="jform[detail3]" value="<?php echo $this->item->detail3; ?>" />
										<input type="hidden" name="jform[detail4]" value="<?php echo $this->item->detail4; ?>" />
										<input type="hidden" name="jform[detail5]" value="<?php echo $this->item->detail5; ?>" />
										<input type="hidden" name="jform[detail6]" value="<?php echo $this->item->detail6; ?>" />
										<input type="hidden" name="jform[detail7]" value="<?php echo $this->item->detail7; ?>" />
										<input type="hidden" name="jform[detail1_label]" value="<?php echo $this->item->detail1_label; ?>" />
										<input type="hidden" name="jform[detail2_label]" value="<?php echo $this->item->detail2_label; ?>" />
										<input type="hidden" name="jform[detail3_label]" value="<?php echo $this->item->detail3_label; ?>" />
										<input type="hidden" name="jform[detail4_label]" value="<?php echo $this->item->detail4_label; ?>" />
										<input type="hidden" name="jform[detail5_label]" value="<?php echo $this->item->detail5_label; ?>" />
										<input type="hidden" name="jform[detail6_label]" value="<?php echo $this->item->detail6_label; ?>" />
										<input type="hidden" name="jform[detail7_label]" value="<?php echo $this->item->detail7_label; ?>" />
										<input type="hidden" name="jform[department]" value="<?php echo $this->item->department; ?>" />
										<input type="hidden" name="jform[link]" value="<?php echo $this->item->link; ?>" />
										<input type="hidden" name="jform[image]" value="<?php echo $this->item->image; ?>" />
										<input type="hidden" name="jform[desc]" value="<?php echo $this->item->desc; ?>" />
										<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />
										<input type="hidden" name="jform[created_by]" value="<?php echo $this->item->created_by; ?>" />
										<input type="hidden" name="option" value="com_einsatzkomponente" />
										<input type="hidden" name="task" value="einsatzfahrzeug.remove" />
										<?php echo JHtml::_('form.token'); ?>
									</form>
								<?php
								endif;
							?>
<?php else: ?>
    Could not load the item
<?php endif; ?>
