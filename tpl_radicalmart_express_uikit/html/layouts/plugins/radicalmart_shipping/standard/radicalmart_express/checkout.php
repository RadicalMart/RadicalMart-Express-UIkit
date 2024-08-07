<?php
/*
 * @package     RadicalMart Shipping Standard Plugin
 * @subpackage  plg_radicalmart_shipping_standard
 * @version     __DEPLOY_VERSION__
 * @author      RadicalMart Team - radicalmart.ru
 * @copyright   Copyright (c) 2024 RadicalMart. All rights reserved.
 * @license     GNU/GPL license: https://www.gnu.org/copyleft/gpl.html
 * @link        https://radicalmart.ru/
 */

\defined('_JEXEC') or die;

extract($displayData);

/**
 * Layout variables
 * -----------------
 *
 * @var  Joomla\CMS\Form\Form $form     Form object.
 * @var  object               $item     Checkout object.
 * @var  object               $shipping Checkout shipping method object.
 *
 */

if (empty($shipping))
{
	return false;
}
?>
<div class="uk-grid-small" uk-grid="">
	<?php if ($shipping->params->get('field_country', 1)): ?>
		<div class="uk-width-1-1"><?php echo $form->renderField('country', 'shipping', null, ['hiddenLabel' => true]); ?></div>
	<?php endif; ?>
	<?php if ($shipping->params->get('field_city', 1)): ?>
		<div class="uk-width-2-3@s"><?php echo $form->renderField('city', 'shipping', null, ['hiddenLabel' => true]); ?></div>
	<?php endif; ?>
	<?php if ($shipping->params->get('field_zip', 1)): ?>
		<div class="uk-width-1-3@s"><?php echo $form->renderField('zip', 'shipping', null, ['hiddenLabel' => true]); ?></div>
	<?php endif; ?>
	<?php if ($shipping->params->get('field_street', 1)): ?>
		<div class="uk-width-2-3@s"><?php echo $form->renderField('street', 'shipping', null, ['hiddenLabel' => true]); ?></div>
	<?php endif; ?>
	<?php if ($shipping->params->get('field_house', 1)): ?>
		<div class="uk-width-1-3@s"><?php echo $form->renderField('house', 'shipping', null, ['hiddenLabel' => true]); ?></div>
	<?php endif; ?>
	<?php if ($shipping->params->get('field_building', 1)): ?>
		<div class="uk-width-1-4@s"><?php echo $form->renderField('building', 'shipping', null, ['hiddenLabel' => true]); ?></div>
	<?php endif; ?>
	<?php if ($shipping->params->get('field_entrance', 1)): ?>
		<div class="uk-width-1-4@s"><?php echo $form->renderField('entrance', 'shipping', null, ['hiddenLabel' => true]); ?></div>
	<?php endif; ?>
	<?php if ($shipping->params->get('field_floor', 1)): ?>
		<div class="uk-width-1-4@s"><?php echo $form->renderField('floor', 'shipping', null, ['hiddenLabel' => true]); ?></div>
	<?php endif; ?>
	<?php if ($shipping->params->get('field_apartment', 1)): ?>
		<div class="uk-width-1-4@s"><?php echo $form->renderField('apartment', 'shipping', null, ['hiddenLabel' => true]); ?></div>
	<?php endif; ?>
	<?php if ($shipping->params->get('field_comment', 1)): ?>
		<div class="uk-width-1-1"><?php echo $form->renderField('comment', 'shipping', null, ['hiddenLabel' => true]); ?></div>
	<?php endif; ?>
</div>