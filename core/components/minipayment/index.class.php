<?php
/**
 * The main manager controller for miniPayment.
 *
 * @package minipayment
 */

require_once dirname(__FILE__) . '/model/minipayment/minipayment.class.php';

abstract class miniPaymentMainController extends modExtraManagerController {
	/** @var miniPayment $minipayment */
	public $minipayment;

	public function initialize() {
		$this->miniPayment = new miniPayment($this->modx);
		
		$this->modx->regClientCSS($this->miniPayment->config['cssUrl'].'mgr.css');
		$this->modx->regClientStartupScript($this->miniPayment->config['jsUrl'].'mgr/minipayment.js');
		$this->modx->regClientStartupHTMLBlock('<script type="text/javascript">
		Ext.onReady(function() {
			miniPayment.config = '.$this->modx->toJSON($this->miniPayment->config).';
			miniPayment.config.connector_url = "'.$this->miniPayment->config['connectorUrl'].'";
		});
		</script>');
		
		return parent::initialize();
	}

	public function getLanguageTopics() {
		return array('minipayment:default');
	}

	public function checkPermissions() { return true;}
}

class IndexManagerController extends miniPaymentMainController {
	public static function getDefaultController() { return 'home'; }
}