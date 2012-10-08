<?php
/**
 * Resolve creating db tables
 *
 * @package minipayment
 * @subpackage build
 */
if ($object->xpdo) {
	switch ($options[xPDOTransport::PACKAGE_ACTION]) {
		case xPDOTransport::ACTION_INSTALL:
			$modx =& $object->xpdo;
			$modelPath = $modx->getOption('minipayment.core_path',null,$modx->getOption('core_path').'components/minipayment/').'model/';
			$modx->addPackage('minipayment',$modelPath);

			$manager = $modx->getManager();

			$manager->createObjectContainer('mpOperation');
			$manager->createObjectContainer('mpStatus');
			$manager->createObjectContainer('mpMethod');

			$lang = $modx->getOption('manager_language','','en');
			if (!$modx->getCount('mpStatus')) {
				$tmp = $modx->newObject('mpStatus', array(
					'name' => $lang == 'ru' ? 'Новый' : 'New'
					,'description' => $lang == 'ru' ? 'Новый платеж' : 'New payment'
					,'color' => '000000'
				));
				$tmp->save();
				$tmp = $modx->newObject('mpStatus', array(
					'name' => $lang == 'ru' ? 'Оплачен' : 'Paid'
					,'description' => $lang == 'ru' ? 'Платеж был успешно оплачен' : 'Payment has been successfully paid'
					,'color' => '008000'
				));
				$tmp->save();
			}
			
			break;
		case xPDOTransport::ACTION_UPGRADE:
			break;
	}
}
return true;