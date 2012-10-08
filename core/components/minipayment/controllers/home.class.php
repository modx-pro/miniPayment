<?php
/**
 * The home manager controller for miniPayment.
 *
 * @package minipayment
 */
class miniPaymentHomeManagerController extends miniPaymentMainController {
	public function process(array $scriptProperties = array()) {}
	
	public function getPageTitle() { return $this->modx->lexicon('minipayment'); }
	
	public function loadCustomCssJs() {
		$this->modx->regClientStartupScript($this->miniPayment->config['jsUrl'].'mgr/widgets/operation.grid.js');
		$this->modx->regClientStartupScript($this->miniPayment->config['jsUrl'].'mgr/widgets/method.grid.js');
		$this->modx->regClientStartupScript($this->miniPayment->config['jsUrl'].'mgr/widgets/status.grid.js');
		$this->modx->regClientStartupScript($this->miniPayment->config['jsUrl'].'mgr/widgets/home.panel.js');
		$this->modx->regClientStartupScript($this->miniPayment->config['jsUrl'].'mgr/sections/home.js');
	}
	
	public function getTemplateFile() {
		return $this->miniPayment->config['templatesPath'].'home.tpl';
	}
}