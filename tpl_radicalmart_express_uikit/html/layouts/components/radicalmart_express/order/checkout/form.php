<?php
/*
 * @package     RadicalMart Uikit Package
 * @subpackage  tpl_radicalmart_express_uikit
 * @version     __DEPLOY_VERSION__
 * @author      Delo Design - delo-design.ru
 * @copyright   Copyright (c) 2023 Delo Design. All rights reserved.
 * @license     GNU/GPL license: https://www.gnu.org/copyleft/gpl.html
 * @link        https://delo-design.ru/
 */

defined('_JEXEC') or die;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Form\Form;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\Component\RadicalMartExpress\Site\Helper\ProductsHelper;

extract($displayData);

/**
 * Layout variables
 * -----------------
 *
 * @var  object $product The product object.
 * @var  Form   $form    The form object.
 *
 */

$params = ComponentHelper::getParams('com_radicalmart_express');
if ($comment = $params->get('display_checkout_comment', ''))
{
	$comment = ProductsHelper::replaceShortcodes(Text::_($comment), $product);
}

$button      = $params->get('display_checkout_button', 'COM_RADICALMART_EXPRESS_PAY');
$button      = ProductsHelper::replaceShortcodes(Text::_($button), $product);
$buttonClass = $params->get('display_checkout_button_class');

?>
<form radicalmart_express-checkout="form" data-control="<?php echo $form->getFormControl(); ?>"
	  action="<?php echo Route::_('index.php?option=com_radicalmart_express'); ?>">
	<p radicalmart_express-checkout="formError" style="display: none; color: red;"></p>
	<div radicalmart_express-checkout="formLoading"
		 style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; background: rgba(255,255,255,0.6); display: none"></div>
	<?php foreach ($form->getFieldsets() as $fieldset): ?>
		<?php if ($fieldset->name === 'consents'): ?>
			<fieldset>
				<?php foreach ($form->getFieldset($fieldset->name) as $field): ?>
					<div style="display: none">
						<?php echo $form->getLabel($field->fieldname, $field->group); ?>
					</div>
					<div style="margin-bottom:10px">
						<?php echo $form->getInput($field->fieldname, $field->group); ?>
					</div>
				<?php endforeach; ?>
			</fieldset>
		<?php else: ?>
			<fieldset>
				<?php if ($params->get('display_checkout_fields_mode', 'label') === 'label'): ?>
					<?php echo $form->renderFieldset($fieldset->name); ?>
				<?php else: ?>
					<?php foreach ($form->getFieldset($fieldset->name) as $field):
						$name = $field->fieldname;
						$group = $field->group;
						if (empty($form->getFieldAttribute($name, 'hint', '', $group)))
						{
							$label = $form->getFieldAttribute($name, 'label', '', $group);
							$form->setFieldAttribute($name, 'hint', $label, $group);
						}
						?>
						<div style="margin-bottom:10px">
							<?php echo $form->getInput($name, $group); ?>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</fieldset>
		<?php endif; ?>
	<?php endforeach; ?>
	<?php if ($comment) echo '<p>' . nl2br($comment) . '</p>'; ?>
	<div style="text-align: center; margin-top: 10px">
		<a onclick="RadicalMartExpress().createOrder('<?php echo $form->getFormControl(); ?>')"
			<?php echo (!empty($buttonClass))
				? 'class="' . $buttonClass . '"'
				: 'style="display: inline-block; padding: 0 30px; vertical-align: middle; font-size: 16px; line-height: 40px; background-color: #1e87f0; color: #fff; cursor: pointer; text-decoration: none;"'; ?>>
			<?php echo $button; ?>
		</a>
	</div>
</form>