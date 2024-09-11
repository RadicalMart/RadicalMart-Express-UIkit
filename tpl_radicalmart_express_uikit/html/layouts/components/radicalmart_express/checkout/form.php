<?php
/*
 * @package     RadicalMart Uikit Package
 * @subpackage  tpl_radicalmart_express_uikit
 * @version     3.0.2
 * @author      RadicalMart Team - radicalmart.ru
 * @copyright   Copyright (c) 2024 RadicalMart. All rights reserved.
 * @license     GNU/GPL license: https://www.gnu.org/copyleft/gpl.html
 * @link        https://radicalmart.ru/
 */

\defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\Component\RadicalMartExpress\Administrator\Helper\ParamsHelper;
use Joomla\Component\RadicalMartExpress\Site\Helper\CheckoutHelper;
use Joomla\Component\RadicalMartExpress\Site\Helper\MediaHelper;
use Joomla\Component\RadicalMartExpress\Site\Helper\ProductsHelper;

extract($displayData);

/**
 * Layout variables
 * -----------------
 *
 * @var  object                $item Order item object.
 * @var  \Joomla\CMS\Form\Form $form Form object.
 *
 */

CheckoutHelper::loadAssets();

$hasConsents = false;
$others      = [];
foreach ($form->getFieldsets() as $key => $fieldset)
{
	foreach ($form->getFieldset($key) as $field)
	{
		$name  = $field->fieldname;
		$group = $field->group;
		$type  = strtolower($field->type);
		$class = $form->getFieldAttribute($name, 'class', '', $group);
		$input = $field->input;
		if ($type === 'text' || $type === 'email')
		{
			$class .= ' uk-input';
		}
		elseif ($type === 'list' || preg_match('#<select#', $input))
		{
			$class .= ' uk-select';
		}
		elseif ($type === 'textarea' || preg_match('#<textarea#', $input))
		{
			$class .= ' uk-textarea';
		}
		elseif ($type === 'range')
		{
			$class .= ' uk-range';
		}

		$form->setFieldAttribute($name, 'class', $class, $group);

		if ($form->getFieldAttribute($name, 'readonly', '', $group) === 'true')
		{
			$form->setFieldAttribute($name, 'disabled', 'true', $group);
		}

		$hint = $form->getFieldAttribute($name, 'hint', '', $group);
		if (empty($hint))
		{
			$form->setFieldAttribute($name, 'hint',
				$form->getFieldAttribute($name, 'label', '', $group), $group);
		}


	}

	if ($key === 'consents')
	{
		$hasConsents = true;
	}

	if (!in_array($key, ['contacts', 'shipping', 'payment', 'billing', 'consents', 'standalone', 'hidden']))
	{
		$others[$key] = $fieldset;
	}
}

$product = $item->product;
if (!empty($product->link))
{
	$product->link = '#';
}

$control = $form->getFormControl();
$params  = ParamsHelper::getComponentParams();
?>
<div radicalmart_express-checkout="form" data-control="<?php echo $form->getFormControl(); ?>"
	 class="uk-position-relative">
	<div radicalmart_express-checkout="error" class="uk-hidden"></div>
	<div radicalmart_express-checkout="loading"
		 class="uk-position-absolute uk-position-cover uk-overlay-default uk-flex uk-position-z-index uk-flex-center uk-flex-middle">
		<div uk-spinner="ratio: 3"></div>
	</div>
	<div class="uk-card uk-card-default">
		<table class="uk-table uk-table-divider uk-table-responsive">
			<thead class="uk-visible@m">
			<tr>
				<th class="uk-text-center">
					<?php echo Text::_('COM_RADICALMART_EXPRESS_PRODUCT'); ?>
				</th>
				<th class="uk-text-center">
					<?php echo Text::_('COM_RADICALMART_EXPRESS_PRICE'); ?>
				</th>
				<th class="uk-text-center">
					<?php echo Text::_('COM_RADICALMART_EXPRESS_QUANTITY'); ?>
				</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td>
					<div class="uk-child-width-expand" uk-grid="">
						<div class="uk-width-1-4">
							<a href="<?php echo $product->link; ?>"
							   class="uk-height-max-small uk-width-1-1 uk-flex uk-flex-center uk-flex-middle">
								<?php echo MediaHelper::renderImage(
									'com_radicalmart_express.products.checkout',
									$product->image,
									[
										'alt'     => $product->title,
										'loading' => 'lazy',
										'class'   => 'uk-height-max-small'
									],
									[
										'product_id' => $product->id,
										'no_image'   => true,
										'thumb'      => true,
									]); ?>
							</a>
						</div>
						<div>
							<a href="<?php echo $product->link; ?>" class="uk-link-reset uk-h3">
								<?php echo $product->title; ?>
							</a>
						</div>
					</div>
				</td>
				<td class="uk-text-center">
					<?php if ($product->order['discount_enable']): ?>
						<div class="uk-text-small uk-text-muted">
							<s><?php echo $product->order['base_string']; ?></s>
							<?php echo ' ( - ' . $product->order['discount_string'] . ')'; ?>
						</div>
					<?php endif; ?>
					<div>
						<?php echo $product->order['final_string']; ?>
					</div>
				</td>
				<td class="uk-text-center">
					<?php if ($params->get('checkout_fields_quantity') !== 'required')
					{
						echo $product->quantity['min'];
					}
					echo $form->getInput('quantity'); ?>
				</td>
			</tr>
			</tbody>
		</table>
	</div>
	<div id="RadicalMartExpressCheckout_<?php echo $control; ?>_hidden" class="uk-hidden">
		<?php echo $form->renderFieldset('hidden'); ?>
	</div>
	<?php if ($contactsFields = $form->getFieldset('contacts')): ?>
		<div id="RadicalMartExpressCheckout_<?php echo $control; ?>_contacts" class="uk-margin">
			<div class="uk-h4">
				<?php echo Text::_('COM_RADICALMART_EXPRESS_CONTACTS'); ?>
			</div>
			<div class="uk-grid-row-small uk-child-width-1-2@s" uk-grid>
				<?php foreach ($contactsFields as $field):
					$name = $field->fieldname;
					$group = $field->group;
					$class = ($name === 'comment' && $group === 'contacts') ? 'uk-width-1-1' : '';
					?>
					<div class="<?php echo $class; ?>">
						<?php echo $form->renderField($name, $group, null, ['hiddenLabel' => true]); ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>
	<?php if ($item->shipping): ?>
		<?php
		$content = null;
		if (!empty($item->shipping->layout))
		{
			$content = LayoutHelper::render($item->shipping->layout, [
				'item'     => $item,
				'form'     => $form,
				'shipping' => $item->shipping,
			]);
		}
		else
		{
			$fieldset = $form->renderFieldset('shipping', ['hiddenLabel' => true]);
			if (!empty($fieldset))
			{
				$content = '<div class="uk-grid-row-small uk-child-width-1-2@s" uk-grid>'
					. $fieldset . '</div>';
			}
		} ?>
		<?php if (!empty($content)): ?>
			<div id="RadicalMartExpressCheckout_<?php echo $control; ?>_shipping" class="uk-margin">
				<div class="uk-h4">
					<?php echo Text::_('COM_RADICALMART_EXPRESS_SHIPPING'); ?>
				</div>
				<div id="RadicalMartExpressCheckout_<?php echo $control; ?>_shipping_content" class="uk-margin-top">
					<?php echo $content; ?>
				</div>
			</div>
		<?php endif; ?>
	<?php endif; ?>
	<?php if ($item->payment): ?>
		<?php
		$content = null;
		if (!empty($item->payment->layout))
		{
			$content = LayoutHelper::render($item->payment->layout, [
				'item'    => $item,
				'form'    => $form,
				'payment' => $item->payment,
			]);
		}
		else
		{
			$fieldset = $form->renderFieldset('payment');
			if (!empty($fieldset))
			{
				$content = '<div class="uk-grid-row-small uk-child-width-1-2@s" uk-grid>'
					. $fieldset . '</div>';
			}
		} ?>
		<?php if (!empty($content)): ?>
			<div id="RadicalMartExpressCheckout_<?php echo $control; ?>_payment" class="uk-margin">
				<div class="uk-h4">
					<?php echo Text::_('COM_RADICALMART_EXPRESS_PAYMENT'); ?>
				</div>
				<div id="RadicalMartExpressCheckout_<?php echo $control; ?>_payment_content" class="uk-margin-top">
					<?php echo $content; ?>
				</div>
			</div>
		<?php endif; ?>
		<?php if ((int) $item->payment->params->get('billing', 0) === 1): ?>
			<div id="RadicalMartExpressCheckout_<?php echo $control; ?>_payment_billing" class="uk-margin-top">
				<div class="uk-h4">
					<?php echo Text::_('COM_RADICALMART_EXPRESS_BILLING'); ?>
				</div>
				<div class="uk-grid-row-small uk-child-width-1-2@s" uk-grid>
					<?php echo $form->renderFieldset('billing', ['hiddenLabel' => true]); ?>
				</div>
			</div>
		<?php endif; ?>
	<?php endif; ?>
	<?php if (!empty($others)): ?>
		<?php foreach ($others as $key => $fieldset): ?>
			<div id="RadicalMartExpressCheckout_<?php echo $control; ?>_<?php echo $key; ?>" class="uk-margin">
				<div class="uk-h4">
					<?php echo Text::_($fieldset->label); ?>
				</div>
				<div class="uk-grid-row-small uk-child-width-1-2@s" uk-grid>
					<?php echo $form->renderFieldset($key); ?>
				</div>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
	<hr>
	<?php if ($item->shipping || $item->payment): ?>
		<div class="uk-grid-small uk-child-width-1-3@s" uk-grid>
			<?php if ($item->shipping): ?>
				<div>
					<div class="uk-tile uk-padding-small uk-text-center uk-display-block uk-tile-muted">
						<?php if (!empty($item->shipping->media->get('icon'))): ?>
							<div class="uk-text-center">
								<?php echo HTMLHelper::image($item->shipping->media->get('icon'), htmlspecialchars($item->shipping->title)); ?>
							</div>
						<?php endif; ?>
						<div class="uk-text-center">
							<?php echo Text::_('COM_RADICALMART_EXPRESS_SHIPPING') . ': ' . $item->shipping->title; ?>
						</div>
						<?php if (!empty($item->shipping->description)): ?>
							<div class="uk-text-small uk-text-muted">
								<?php echo nl2br($item->shipping->description); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
			<?php if ($item->payment): ?>
				<div>
					<div class="uk-tile uk-padding-small uk-text-center uk-display-block uk-tile-muted">
						<?php if (!empty($item->payment->media->get('icon'))): ?>
							<div class="uk-text-center">
								<?php echo HTMLHelper::image($item->payment->media->get('icon'), htmlspecialchars($item->payment->title)); ?>
							</div>
						<?php endif; ?>
						<div class="uk-text-center">
							<?php echo Text::_('COM_RADICALMART_EXPRESS_PAYMENT') . ': ' . $item->payment->title; ?>
						</div>
						<?php if (!empty($item->payment->description)): ?>
							<div class="uk-text-small uk-text-muted">
								<?php echo nl2br($item->payment->description); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<?php if ($text = $params->get('display_checkout_text'))
	{
		$text = ProductsHelper::replaceShortcodes(Text::_($text), $product);
		echo '<p>' . nl2br($text) . '</p>';
	} ?>
	<?php if ($hasConsents): ?>
		<div id=RadicalMartExpressCheckout_<?php echo $control; ?>_consents" class="uk-margin">
			<?php foreach ($form->getFieldset('consents') as $field): ?>
				<div class="uk-margin">
					<?php echo $field->input; ?>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
	<div class="uk-text-center uk-margin">
		<button radicalmart_express-checkout="createOrder" disabled
				class="<?php echo $params->get('display_checkout_button_class', 'uk-button uk-button-primary uk-button-large'); ?>">
			<?php echo ProductsHelper::replaceShortcodes(Text::_($params->get('display_checkout_button',
				'COM_RADICALMART_EXPRESS_CHECKOUT_BUTTON')), $product); ?>
		</button>
	</div>
</div>