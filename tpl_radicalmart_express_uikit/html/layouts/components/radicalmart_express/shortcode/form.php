<?php
/*
 * @package     RadicalMart Uikit Package
 * @subpackage  tpl_radicalmart_express_uikit
 * @version     __DEPLOY_VERSION__
 * @author      RadicalMart Team - radicalmart.ru
 * @copyright   Copyright (c) 2024 RadicalMart. All rights reserved.
 * @license     GNU/GPL license: https://www.gnu.org/copyleft/gpl.html
 * @link        https://radicalmart.ru/
 */

defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;
use Joomla\Component\RadicalMartExpress\Site\Helper\CheckoutHelper;

CheckoutHelper::loadAssets();

/** @var object $product */
$product = $displayData;
if (empty($product))
{
	return '';
}

$layoutData = CheckoutHelper::getBlankFormData('com_radicalmart_express.shortcode', $product->id);
if (!$layoutData)
{
	return '';
}

?>
<?php if ($layoutData['success'] === false): ?>
	<div class="uk-alert uk-alert-danger">
		<?php echo $layoutData['message']; ?>
	</div>
<?php else: ?>
	<div radicalmart_express-checkout="renderForm" data-product_id="<?php echo $product->id; ?>">
		<?php echo LayoutHelper::render('components.radicalmart_express.checkout.form', $layoutData); ?>
	</div>
<?php endif; ?>