Ext.onReady(function() {
	MODx.load({ xtype: 'minipayment-page-home'});
});

miniPayment.page.Home = function(config) {
	config = config || {};
	Ext.applyIf(config,{
		components: [{
			xtype: 'minipayment-panel-home'
			,renderTo: 'minipayment-panel-home-div'
		}]
	}); 
	miniPayment.page.Home.superclass.constructor.call(this,config);
};
Ext.extend(miniPayment.page.Home,MODx.Component);
Ext.reg('minipayment-page-home',miniPayment.page.Home);