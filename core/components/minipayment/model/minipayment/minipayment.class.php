<?php
/**
 * The base class for miniPayment.
 *
 * @package minipayment
 */
class miniPayment {
	function __construct(modX &$modx,array $config = array()) {
		$this->modx =& $modx;

		$corePath = $this->modx->getOption('minipayment.core_path',$config,$this->modx->getOption('core_path').'components/minipayment/');
		$assetsUrl = $this->modx->getOption('minipayment.assets_url',$config,$this->modx->getOption('assets_url').'components/minipayment/');
		$connectorUrl = $assetsUrl.'connector.php';

		$this->config = array_merge(array(
			'assetsUrl' => $assetsUrl
			,'cssUrl' => $assetsUrl.'css/'
			,'jsUrl' => $assetsUrl.'js/'
			,'imagesUrl' => $assetsUrl.'images/'

			,'connectorUrl' => $connectorUrl

			,'corePath' => $corePath
			,'modelPath' => $corePath.'model/'
			,'chunksPath' => $corePath.'elements/chunks/'
			,'templatesPath' => $corePath.'elements/templates/'
			,'chunkSuffix' => '.chunk.tpl'
			,'snippetsPath' => $corePath.'elements/snippets/'
			,'processorsPath' => $corePath.'processors/'
			
			// default settings
			,'tplForm' => 'tpl.Payment.form'
			,'tplMethod' => 'tpl.Payment.method.row'
		),$config);

		$this->modx->addPackage('minipayment',$this->config['modelPath']);
		$this->modx->lexicon->load('minipayment:default');
	}

	/**
	 * Initializes miniPayment into different contexts.
	 *
	 * @access public
	 * @param string $ctx The context to load. Defaults to web.
	 */
	public function initialize($ctx = 'web') {
		switch ($ctx) {
			case 'mgr':
				if (!$this->modx->loadClass('minipayment.request.miniPaymentControllerRequest',$this->config['modelPath'],true,true)) {
					return 'Could not load controller request handler.';
				}
				$this->request = new miniPaymentControllerRequest($this);
				return $this->request->handleRequest();
			break;
			case 'connector':
				if (!$this->modx->loadClass('minipayment.request.miniPaymentConnectorRequest',$this->config['modelPath'],true,true)) {
					return 'Could not load connector request handler.';
				}
				$this->request = new miniPaymentConnectorRequest($this);
				return $this->request->handle();
			break;
			default:
				/* if you wanted to do any generic frontend stuff here.
				 * For example, if you have a lot of snippets but common code
				 * in them all at the beginning, you could put it here and just
				 * call $minipayment->initialize($modx->context->get('key'));
				 * which would run this.
				 */
			break;
		}
	}
	
	
	/**
	 * Shorthand for the call of processor
	 *
	 * @access public
	 * @param string $action Path to processor
	 * @param array $data Data to be transmitted to the processor
	*/
	public function runProcessor($action = '', $data = array()) {
		if (empty($action)) {return false;}
		
		return $this->modx->runProcessor($action, $data, array('processors_path' => $this->config['processorsPath']));
	}
	
	
	/**
	 * This method returns payment form
	 *
	 * @access public
	 * @param array $data Placeholders to be set in form.
	*/
	public function getForm($data = array()) {
		$tmp = $this->runProcessor('mgr/method/getlist', array('limit' => 0, 'active' => 1));
		$methods = '';
		if ($response = json_decode($tmp->response, 1)) {
			foreach ($response['results'] as $v) {
				if (!empty($_REQUEST['method']) && $_REQUEST['method'] == $v['id']) {$v['checked'] = 'checked';}
				else {$v['checked'] = '';}
				
				$methods .= $this->modx->getChunk($this->config['tplMethod'], $v);
			}
		}
		
		$arr = array_merge(array(
			'methods' => $methods
		), $data);
		$result = $this->modx->getChunk($this->config['tplForm'], $arr);
		
		return $result;
	}
	
	
	/**
	 * Checks the data and tries to call the snippet
	 *
	 * @access public
	 * @param array $data Submitted data
	*/
	public function createOperation($data = array()) {
		if (empty($data['method'])) {
			return $this->getForm(array(
				'error' => $this->modx->lexicon('minipayment.method_err_ns')
			));
		}
		if (!$method = $this->modx->getObject('mpMethod', $data['method'])) {
			return $this->getForm(array(
				'error' => $this->modx->lexicon('minipayment.method_err_nf')
			));
		}
		
		$send = $method->get('send');
		if (!$snippet = $this->modx->getObject('modSnippet', $send)) {
			return $this->getForm(array(
				'error' => $this->modx->lexicon('minipayment.method_err_snippet_nf')
			));
		}
		
		$data['action'] = 'create';
		
		$response = $this->runProcessor('mgr/operation/create', $data);
		if ($response->isError()) {
			return $this->modx->error->failure($response->getMessage());
		}
		
		return $this->modx->runSnippet($snippet->get('name'), $response->response);
	}
	
	
	/**
	 * Returns an operation by id
	 *
	 * @access public
	 * @param integer $id Id of operation
	*/
	public function getOperation($id = 0) {
		$response = $this->runProcessor('mgr/operation/get', array('id' => $id));
		if ($response->isError()) {
			return $this->modx->error->failure($response->getMessage());
		}
		
		return $response->response['object'];
	}
	
	
	/**
	 * Updates an operation
	 *
	 * @access public
	 * @param integer $id Id of operation
	 * @param integer $status New status of operation
	*/
	public function updateOperation($id = 0, $status = 0) {
		$response = $this->runProcessor('mgr/operation/update', array('id' => $id, 'status' => $status));
		if ($response->isError()) {
			return $this->modx->error->failure($response->getMessage());
		}
		
		return $response->response['object'];
	}
	
	

}