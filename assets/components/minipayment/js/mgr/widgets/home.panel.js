miniPayment.panel.Home = function(config) {
	config = config || {};
	Ext.apply(config,{
		border: false
		,baseCls: 'modx-formpanel'
		,items: [{
			html: '<h2>'+_('minipayment')+'</h2>'
			,border: false
			,cls: 'modx-page-header container'
		},{
			xtype: 'modx-tabs'
			,bodyStyle: 'padding: 10px'
			,defaults: { border: false ,autoHeight: true }
			,border: true
			,hideMode: 'offsets'
			,stateful: true
			,stateId: 'minipayment-tabpanel-home'
			,stateEvents: ['tabchange']
			,getState:function() {return { activeTab:this.items.indexOf(this.getActiveTab())};}
			,items: [{
				title: _('minipayment.operations')
				,items: [{
					html: _('minipayment.operation_intro_msg')
					,border: false
					,bodyCssClass: 'panel-desc'
					,bodyStyle: 'margin-bottom: 10px'
				},{
					xtype: 'minipayment-grid-operation'
					,preventRender: true
				}]
			},{
				title: _('minipayment.methods')
				,items: [{
					html: _('minipayment.method_intro_msg')
					,border: false
					,bodyCssClass: 'panel-desc'
					,bodyStyle: 'margin-bottom: 10px'
				},{
					xtype: 'minipayment-grid-method'
					,preventRender: true
				}]
			},{
				title: _('minipayment.statuses')
				,items: [{
					html: _('minipayment.status_intro_msg')
					,border: false
					,bodyCssClass: 'panel-desc'
					,bodyStyle: 'margin-bottom: 10px'
				},{
					xtype: 'minipayment-grid-status'
					,preventRender: true
				}]
			}]
		}]
	});
	miniPayment.panel.Home.superclass.constructor.call(this,config);
};
Ext.extend(miniPayment.panel.Home,MODx.Panel);
Ext.reg('minipayment-panel-home',miniPayment.panel.Home);






/**********************************/
MODx.combo.snippet = function(config) {
	config = config || {};
	Ext.applyIf(config,{
		name: 'snippet'
		,hiddenName: 'id'
		,displayField: 'name'
		,valueField: 'id'
		,editable: true
		,fields: ['name','id']
		,pageSize: 10
		,emptyText: _('minipayment.select_from_list')
		,url: miniPayment.config.connector_url
		,baseParams: {
			action: 'mgr/element/snippet/getlist'
		}
	});
	MODx.combo.snippet.superclass.constructor.call(this,config);
};
Ext.extend(MODx.combo.snippet,MODx.combo.ComboBox);
Ext.reg('minipayment-combo-snippet',MODx.combo.snippet);
