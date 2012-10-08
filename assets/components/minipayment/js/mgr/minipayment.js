var miniPayment = function(config) {
	config = config || {};
	miniPayment.superclass.constructor.call(this,config);
};
Ext.extend(miniPayment,Ext.Component,{
	page:{},window:{},grid:{},tree:{},panel:{},combo:{},config: {},view: {}
});
Ext.reg('minipayment',miniPayment);

miniPayment = new miniPayment();