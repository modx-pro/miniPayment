miniPayment.grid.Operation = function(config) {
	config = config || {};
	Ext.applyIf(config,{
		id: 'minipayment-grid-operation'
		,url: miniPayment.config.connector_url
		,baseParams: {
			action: 'mgr/operation/getlist'
		}
		,fields: ['id','uid','username','sum','status','statusname','createdon','updatedon','description','data']
		,autoHeight: true
		,paging: true
		,remoteSort: true
		,columns: [
			{header: _('id'),dataIndex: 'id',width: 50}
			,{header: _('minipayment.uid'),dataIndex: 'uid',width: 50,hidden: true}
			,{header: _('user'),dataIndex: 'username',width: 100}
			,{header: _('minipayment.sum'),dataIndex: 'sum',width: 50}
			,{header: _('minipayment.status'),dataIndex: 'statusname',width: 50}
			,{header: _('minipayment.createdon'),dataIndex: 'createdon',width: 100}
			,{header: _('minipayment.updatedon'),dataIndex: 'updatedon',width: 100}
			,{header: _('description'),dataIndex: 'description',width: 100}
		]
		,tbar: []
		,listeners: {
			rowDblClick: function(grid, rowIndex, e) {
				var row = grid.store.getAt(rowIndex);
				this.updateOperation(grid, e, row);
			}
		}
	});
	miniPayment.grid.Operation.superclass.constructor.call(this,config);
};
Ext.extend(miniPayment.grid.Operation,MODx.grid.Grid,{
	windows: {}

	,getMenu: function() {
		var m = [];
		m.push({
			text: _('minipayment.operation_view')
			,handler: this.updateOperation
		});
		
		if (this.menu.record.id > 0) {
			m.push({
				text: _('minipayment.operation_view_user')
				,handler: this.viewUser
			});
		}
		
		m.push('-');
		m.push({
			text: _('minipayment.operation_remove')
			,handler: this.removeOperation
		});
		this.addContextMenuItem(m);
	}
	
	,updateOperation: function(btn,e,row) {
		if (typeof(row) != 'undefined') {var record = row.data;}
		else {var record = this.menu.record;}

		MODx.Ajax.request({
			url: miniPayment.config.connector_url
			,params: {
				action: 'mgr/operation/get'
				,id: record.id
			}
			,listeners: {
				'success': {fn:function(r) {
					var record = r.object;
					w = MODx.load({
						xtype: 'minipayment-window-operation-update'
						,listeners: {
							'success': {fn:this.refresh,scope:this}
							,'hide': {fn:function() {this.getEl().remove()}}
						}
					});
					w.fp.getForm().reset();
					w.fp.getForm().setValues(record);
					w.show(e.target);
				},scope:this}
			}
		});
	}
	
	,removeOperation: function(btn,e) {
		if (!this.menu.record) return false;
		
		MODx.msg.confirm({
			title: _('minipayment.operation_remove')
			,text: _('minipayment.operation_remove_confirm')
			,url: this.config.url
			,params: {
				action: 'mgr/operation/remove'
				,id: this.menu.record.id
			}
			,listeners: {
				'success': {fn:function(r) { this.refresh(); },scope:this}
			}
		});
	}
	
	,viewUser: function(btn,e) {
		window.open(MODx.config.manager_url + '?a=34&id=' + this.menu.record.uid)
	}
});
Ext.reg('minipayment-grid-operation',miniPayment.grid.Operation);




miniPayment.window.UpdateOperation = function(config) {
	config = config || {};
	this.ident = config.ident || 'meuitem'+Ext.id();
	Ext.applyIf(config,{
		title: _('minipayment.operation_view')
		,id: this.ident
		,height: 150
		,width: 475
		,labelAlign: 'left'
		,labelWidth: 150
		,url: miniPayment.config.connector_url
		,action: 'mgr/operation/update'
		,fields: [
			{xtype: 'hidden',name: 'id',id: 'minipayment-'+this.ident+'-id'}
			,{xtype: 'displayfield',fieldLabel: _('user'),name: 'username',id: 'minipayment-'+this.ident+'-user',anchor:'99%'}
			,{xtype: 'displayfield',fieldLabel: _('minipayment.method'),name: 'methodname',id: 'minipayment-'+this.ident+'-method',anchor:'99%'}
			,{xtype: 'displayfield',fieldLabel: _('minipayment.sum'),name: 'sum',id: 'minipayment-'+this.ident+'-sum',anchor:'99%'}
			,{xtype: 'displayfield',fieldLabel: _('minipayment.status'),name: 'statusname',id: 'minipayment-'+this.ident+'-status',anchor:'99%'}
			,{xtype: 'displayfield',fieldLabel: _('minipayment.createdon'),name: 'createdon',id: 'minipayment-'+this.ident+'-createdon',anchor:'99%'}
			,{xtype: 'displayfield',fieldLabel: _('minipayment.updatedon'),name: 'updatedon',id: 'minipayment-'+this.ident+'-updatedon',anchor:'99%'}
			,{xtype: 'displayfield',fieldLabel: _('description'),name: 'description',id: 'minipayment-'+this.ident+'-description',anchor:'99%'}
			,{xtype: 'displayfield',fieldLabel: _('minipayment.data'),name: 'data',id: 'minipayment-'+this.ident+'-data',anchor:'99%'}
		]
		,buttons: [{
			text: _('close')
			,scope: this
			,handler: function() {this.hide(); }
		}]
	});
	miniPayment.window.UpdateOperation.superclass.constructor.call(this,config);
};
Ext.extend(miniPayment.window.UpdateOperation,MODx.Window);
Ext.reg('minipayment-window-operation-update',miniPayment.window.UpdateOperation);