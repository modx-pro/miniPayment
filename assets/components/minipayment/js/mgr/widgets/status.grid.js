miniPayment.grid.Status = function(config) {
	config = config || {};
	Ext.applyIf(config,{
		id: 'minipayment-grid-status'
		,url: miniPayment.config.connector_url
		,baseParams: {
			action: 'mgr/status/getlist'
		}
		,fields: ['id','name','description','color']
		,autoHeight: true
		,paging: true
		,remoteSort: true
		,columns: [
			{header: _('id'),dataIndex: 'id',width: 50}
			,{header: _('name'),dataIndex: 'name',width: 200}
			,{header: _('description'),dataIndex: 'description',width: 250}
			,{header: _('minipayment.color'),dataIndex: 'color',width: 50,renderer:this.renderColor}
		]
		,tbar: [{
			text: _('minipayment.status_create')
			,handler: this.createStatus
			,scope: this
		}]
		,listeners: {
			rowDblClick: function(grid, rowIndex, e) {
				var row = grid.store.getAt(rowIndex);
				this.updateStatus(grid, e, row);
			}
		}
	});
	miniPayment.grid.Status.superclass.constructor.call(this,config);
};
Ext.extend(miniPayment.grid.Status,MODx.grid.Grid,{
	windows: {}

	,getMenu: function() {
		var m = [];
		m.push({
			text: _('minipayment.status_update')
			,handler: this.updateStatus
		});
		m.push('-');
		m.push({
			text: _('minipayment.status_remove')
			,handler: this.removeStatus
		});
		this.addContextMenuItem(m);
	}
	
	,createStatus: function(btn,e) {
		if (!this.windows.createStatus) {
			this.windows.createStatus = MODx.load({
				xtype: 'minipayment-window-status-create'
				,listeners: {
					'success': {fn:function() { this.refresh(); },scope:this}
				}
			});
		}
		this.windows.createStatus.fp.getForm().reset();
		this.windows.createStatus.show(e.target);
	}
	,updateStatus: function(btn,e,row) {
		if (typeof(row) != 'undefined') {var record = row.data;}
		else {var record = this.menu.record;}

		if (!this.windows.updateStatus) {
			this.windows.updateStatus = MODx.load({
				xtype: 'minipayment-window-status-update'
				,record: record
				,listeners: {
					'success': {fn:function() { this.refresh(); },scope:this}
				}
			});
		}
		this.windows.updateStatus.fp.getForm().reset();
		this.windows.updateStatus.fp.getForm().setValues(record);
		this.windows.updateStatus.show(e.target);
	}
	
	,removeStatus: function(btn,e) {
		if (!this.menu.record) return false;
		
		MODx.msg.confirm({
			title: _('minipayment.status_remove')
			,text: _('minipayment.status_remove_confirm')
			,url: this.config.url
			,params: {
				action: 'mgr/status/remove'
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
});
Ext.reg('minipayment-grid-status',miniPayment.grid.Status);




miniPayment.window.CreateStatus = function(config) {
	config = config || {};
	this.ident = config.ident || 'mecitem'+Ext.id();
	Ext.applyIf(config,{
		title: _('minipayment.status_create')
		,id: this.ident
		,height: 150
		,width: 475
		,url: miniPayment.config.connector_url
		,action: 'mgr/status/create'
		,fields: [
			{xtype: 'textfield',fieldLabel: _('name'),name: 'name',id: 'minipayment-'+this.ident+'-name',anchor: "99%",allowBlank: false}
			,{xtype: 'textarea',fieldLabel: _('description'),name: 'description',id: 'minipayment-'+this.ident+'-description',anchor: "99%"}
			,{xtype: 'hidden',name: 'color',id: 'createstatus-color'}
			,{xtype: 'colorpalette',fieldLabel: _('minipayment.color'),width: 200
				,listeners: {
					select: function(palette, setColor) {
						Ext.getCmp('createstatus-color').setValue(setColor)
					}
				}
			}
		]
		,keys: [{
			key: Ext.EventObject.ENTER
			,shift: true
			,fn:  function() {this.submit() }
			,scope: this
		}]
	});
	miniPayment.window.CreateStatus.superclass.constructor.call(this,config);
};
Ext.extend(miniPayment.window.CreateStatus,MODx.Window);
Ext.reg('minipayment-window-status-create',miniPayment.window.CreateStatus);


miniPayment.window.UpdateStatus = function(config) {
	config = config || {};
	this.ident = config.ident || 'meuitem'+Ext.id();
	Ext.applyIf(config,{
		title: _('minipayment.status_update')
		,id: this.ident
		,height: 150
		,width: 475
		,url: miniPayment.config.connector_url
		,action: 'mgr/status/update'
		,fields: [
			{xtype: 'hidden',name: 'id',id: 'minipayment-'+this.ident+'-id'}
			,{xtype: 'textfield',fieldLabel: _('name'),name: 'name',id: 'minipayment-'+this.ident+'-name',anchor: "99%",allowBlank: false}
			,{xtype: 'textarea',fieldLabel: _('description'),name: 'description',id: 'minipayment-'+this.ident+'-description',anchor: "99%"}
			,{xtype: 'hidden',name: 'color',id: 'updatestatus-color'}
			,{xtype: 'colorpalette',fieldLabel: _('minipayment.color'),width: 200
				,listeners: {
					select: function(palette, setColor) {
						Ext.getCmp('updatestatus-color').setValue(setColor)
					}
					,beforerender: function(palette) {
						var color = Ext.getCmp('updatestatus-color').value;
						if (color != 'undefined') {
							palette.value = color;
						}
					}
				}
			}
		]
		,keys: [{
			key: Ext.EventObject.ENTER
			,shift: true
			,fn:  function() {this.submit() }
			,scope: this
		}]
	});
	miniPayment.window.UpdateStatus.superclass.constructor.call(this,config);
};
Ext.extend(miniPayment.window.UpdateStatus,MODx.Window);
Ext.reg('minipayment-window-status-update',miniPayment.window.UpdateStatus);