miniPayment.grid.Method = function(config) {
	config = config || {};
	Ext.applyIf(config,{
		id: 'minipayment-grid-method'
		,url: miniPayment.config.connector_url
		,baseParams: {
			action: 'mgr/method/getlist'
		}
		,fields: ['id','name','description','active','send','receive','snippet_send','snippet_receive']
		,autoHeight: true
		,paging: true
		,remoteSort: true
		,columns: [
			{header: _('id'),dataIndex: 'id',width: 50}
			,{header: _('name'),dataIndex: 'name',width: 200}
			,{header: _('description'),dataIndex: 'description',width: 250}
			,{header: _('minipayment.active'),dataIndex: 'active',renderer: this.renderBoolean}
			,{header: _('minipayment.method_send'),dataIndex: 'snippet_send',width: 100}
			,{header: _('minipayment.method_receive'),dataIndex: 'snippet_receive',width: 100}
		]
		,tbar: [{
			text: _('minipayment.method_create')
			,handler: this.createMethod
			,scope: this
		}]
		,listeners: {
			rowDblClick: function(grid, rowIndex, e) {
				var row = grid.store.getAt(rowIndex);
				this.updateMethod(grid, e, row);
			}
		}
	});
	miniPayment.grid.Method.superclass.constructor.call(this,config);
};
Ext.extend(miniPayment.grid.Method,MODx.grid.Grid,{
	windows: {}

	,getMenu: function() {
		var m = [];
		m.push({
			text: _('minipayment.method_update')
			,handler: this.updateMethod
		});
		m.push('-');
		m.push({
			text: _('minipayment.method_remove')
			,handler: this.removeMethod
		});
		this.addContextMenuItem(m);
	}
	
	,createMethod: function(btn,e) {
		if (!this.windows.createMethod) {
			this.windows.createMethod = MODx.load({
				xtype: 'minipayment-window-method-create'
				,listeners: {
					'success': {fn:function() { this.refresh(); },scope:this}
				}
			});
		}
		this.windows.createMethod.fp.getForm().reset();
		this.windows.createMethod.show(e.target);
	}
	,updateMethod: function(btn,e,row) {
		if (typeof(row) != 'undefined') {var record = row.data;}
		else {var record = this.menu.record;}

		if (!this.windows.updateMethod) {
			this.windows.updateMethod = MODx.load({
				xtype: 'minipayment-window-method-update'
				,record: record
				,listeners: {
					'success': {fn:function() { this.refresh(); },scope:this}
				}
			});
		}
		this.windows.updateMethod.fp.getForm().reset();
		this.windows.updateMethod.fp.getForm().setValues(record);
		this.windows.updateMethod.show(e.target);
	}
	
	,removeMethod: function(btn,e) {
		if (!this.menu.record) return false;
		
		MODx.msg.confirm({
			title: _('minipayment.method_remove')
			,text: _('minipayment.method_remove_confirm')
			,url: this.config.url
			,params: {
				action: 'mgr/method/remove'
				,id: this.menu.record.id
			}
			,listeners: {
				'success': {fn:function(r) { this.refresh(); },scope:this}
			}
		});
	}
	
	,renderColor: function(value) {
		return '<div style="width: 30px; height: 20px; border-radius: 3px; background: #' + value + '">&nbsp;</div>'
	}
	,renderBoolean: function(value) {
		if (value == 1) {return '<span style="color:green;">'+_('yes')+'</span>';}
		else {return '<span style="color:red;">'+_('no')+'</span>';}
	}
});
Ext.reg('minipayment-grid-method',miniPayment.grid.Method);




miniPayment.window.CreateMethod = function(config) {
	config = config || {};
	this.ident = config.ident || 'mecitem'+Ext.id();
	Ext.applyIf(config,{
		title: _('minipayment.method_create')
		,id: this.ident
		,height: 150
		,width: 475
		,url: miniPayment.config.connector_url
		,action: 'mgr/method/create'
		,fields: [
			{xtype: 'textfield',fieldLabel: _('name'),name: 'name',id: 'minipayment-'+this.ident+'-name',anchor: "99%",allowBlank: false}
			,{xtype: 'textarea',fieldLabel: _('description'),name: 'description',id: 'minipayment-'+this.ident+'-description',anchor: "99%"}
			,{xtype: 'xcheckbox',fieldLabel: _('minipayment.active'),name: 'active',id: 'minipayment-'+this.ident+'-active'}
			,{xtype: 'minipayment-combo-snippet', fieldLabel: _('minipayment.method_send'), name: 'send',hiddenName: 'send',id: 'minipayment-'+this.ident+'-send',anchor: "99%",allowBlank: false}
			,{xtype: 'minipayment-combo-snippet', fieldLabel: _('minipayment.method_receive'), name: 'receive',hiddenName: 'receive',id: 'minipayment-'+this.ident+'-receive',anchor: "99%",allowBlank: false}
			,{xtype: 'textarea',fieldLabel: _('description'),name: 'description',id: 'minipayment-'+this.ident+'-description',anchor: "99%"}
		]
		,keys: [{
			key: Ext.EventObject.ENTER
			,shift: true
			,fn:  function() {this.submit() }
			,scope: this
		}]
	});
	miniPayment.window.CreateMethod.superclass.constructor.call(this,config);
};
Ext.extend(miniPayment.window.CreateMethod,MODx.Window);
Ext.reg('minipayment-window-method-create',miniPayment.window.CreateMethod);


miniPayment.window.UpdateMethod = function(config) {
	config = config || {};
	this.ident = config.ident || 'meuitem'+Ext.id();
	Ext.applyIf(config,{
		title: _('minipayment.method_update')
		,id: this.ident
		,height: 150
		,width: 475
		,url: miniPayment.config.connector_url
		,action: 'mgr/method/update'
		,fields: [
			{xtype: 'hidden',name: 'id',id: 'minipayment-'+this.ident+'-id'}
			,{xtype: 'textfield',fieldLabel: _('name'),name: 'name',id: 'minipayment-'+this.ident+'-name',anchor: "99%",allowBlank: false}
			,{xtype: 'textarea',fieldLabel: _('description'),name: 'description',id: 'minipayment-'+this.ident+'-description',anchor: "99%"}
			,{xtype: 'xcheckbox',fieldLabel: _('minipayment.active'),name: 'active',id: 'minipayment-'+this.ident+'-active'}
			,{xtype: 'minipayment-combo-snippet', fieldLabel: _('minipayment.method_send'), name: 'send',hiddenName: 'send',id: 'minipayment-'+this.ident+'-send',anchor: "99%",allowBlank: false}
			,{xtype: 'minipayment-combo-snippet', fieldLabel: _('minipayment.method_receive'), name: 'receive',hiddenName: 'receive',id: 'minipayment-'+this.ident+'-receive',anchor: "99%",allowBlank: false}
			,{xtype: 'textarea',fieldLabel: _('description'),name: 'description',id: 'minipayment-'+this.ident+'-description',anchor: "99%"}
		]
		,keys: [{
			key: Ext.EventObject.ENTER
			,shift: true
			,fn:  function() {this.submit() }
			,scope: this
		}]
	});
	miniPayment.window.UpdateMethod.superclass.constructor.call(this,config);
};
Ext.extend(miniPayment.window.UpdateMethod,MODx.Window);
Ext.reg('minipayment-window-method-update',miniPayment.window.UpdateMethod);