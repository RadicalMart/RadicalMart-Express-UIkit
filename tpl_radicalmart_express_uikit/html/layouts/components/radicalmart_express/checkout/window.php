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

\defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;

extract($displayData);

/**
 * Layout variables
 * -----------------
 *
 * @var  object                $item Order object.
 * @var  \Joomla\CMS\Form\Form $form Form object.
 *
 */
?>
<div id="RadicalMartExpressCheckoutModal" class="uk-flex-top uk-modal-container" uk-modal="container:false">
	<div class="uk-modal-dialog uk-margin-auto-vertical">
		<div class="uk-modal-header">
			<?php echo Text::_('COM_RADICALMART_EXPRESS_CHECKOUT'); ?>
		</div>
		<div class="uk-modal-body">
			<div class="uk-padding uk-padding-remove-vertical">
				<?php echo LayoutHelper::render('components.radicalmart_express.checkout.form', $displayData); ?>
			</div>
		</div>
	</div>
</div>