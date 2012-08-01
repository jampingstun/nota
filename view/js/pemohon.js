var idpemohon;         // this will be our datastore
var idgrouppemohon;       // this will be our columnmodel
var tgldaftar;
var nama;
var alamat;
var tempat;
var tgllahir;
var agama;
 
Ext.onReady(function(){
  Ext.QuickTips.init();
var Checkbox = new Ext.grid.CheckboxSelectionModel();	
PemohonDataStore = new Ext.data.Store({
      id: 'PemohonDataStore',
      proxy: new Ext.data.HttpProxy({
                url: 'controller/pemohon.php',      // File to connect to
                method: 'POST'
            }),
            baseParams:{task: "LISTING"}, // this parameter asks for listing
      reader: new Ext.data.JsonReader({   
                  // we tell the datastore where to get his data from
        root: 'results',
        totalProperty: 'total'
      },[ 
          {name: 'idpemohon', type: 'int', mapping: 'idpemohon'},
        {name: 'idgrouppemohon', type: 'int', mapping: 'idgrouppemohon'},
        {name: 'tgldaftarpemohon', type: 'string', mapping: 'tgldaftarpemohon'},
        {name: 'nama', type: 'string', mapping: 'nama'},
        {name: 'alamat', type: 'string', mapping: 'alamat'},
        {name: 'tempat', type: 'string', mapping: 'tempat'},
        {name: 'tglahir', type: 'string', mapping: 'tglahir'},
        {name: 'agama', type: 'string', mapping: 'agama'},
        {name: 'pekerjaan', type: 'string', mapping: 'pekerjaan'},
        {name: 'notelp', type: 'string', mapping: 'notelp'},
        {name: 'pbpemohon', type: 'int', mapping: 'pbpemohon'}
      ]),
      sortInfo:{field: 'idpemohon', direction: "ASC"}
    });
    
    PemohonColumnModel = new Ext.grid.ColumnModel(
    [   Checkbox,
        {
        header: 'ID Pemohon',
        readOnly: true,
        dataIndex: 'idpemohon', // this is where the mapped name is important!
        width: 100,
        hidden: false
      }
      ,{
        header: 'ID Group Pemohon',
        dataIndex: 'idgrouppemohon',
        width: 100,
        editor: new Ext.form.TextField({  // rules about editing
            allowBlank: false,
            maxLength: 20,
            maskRe: /([a-zA-Z0-9\s]+)$/   // alphanumeric + spaces allowed
          })
      },{
        header: 'Tanggal Daftar',
        dataIndex: 'tgldaftarpemohon',
        width: 90,
        editor: new Ext.form.TextField({
          allowBlank: false,
          maxLength: 20,
          maskRe: /([a-zA-Z0-9\s]+)$/
          })
      },{
        header: 'Nama',
        dataIndex: 'nama',
        width: 150,
        readOnly: true                     // we don't necessarily want to see this...
      },{
        header: 'Alamat',
        dataIndex: 'alamat',
        width: 150,
        readOnly: true
      },{
        header: 'Tempat',
        dataIndex: 'tempat',
        width: 150,
        readOnly: true
      },{
        header: 'Tanggal Lahir',
        dataIndex: 'tglahir',
        width: 90,
        readOnly: true
      },{
        header: 'Agama',
        dataIndex: 'agama',
        width: 90,
        readOnly: true
      }
      ,
      {
        header: 'Pekerjaan',
        dataIndex: 'pekerjaan',
        width: 90,
        readOnly: true
      },{
        header: 'No Telp',
        dataIndex: 'notelp',
        width: 90,
        readOnly: true
      }
      ,
      {
        header: "PB Pemohon",
        dataIndex: 'pbpemohon',
        width: 90,
        readOnly: true
      }]
    );
    PemohonColumnModel.defaultSortable= true;


//==================================================//
	//                             FORM TAMBAH DATA                               //
	//==================================================//
	var tambah = new Ext.FormPanel({
		url:'controller/pemohon.php?act=add',
		baseParams:{
			act:"add"
		},
        width: 450,         		
	autoheight:true,
        bodyStyle:'padding:5px 5px 0',		                
        labelWidth: 130,		
        defaults: {allowBlank: false},
		
        items: [
		{
            xtype: 'textfield',
            fieldLabel: 'ID Pemohon',
			anchor: '80%',
			name: 'idpemohon'
        },
        {xtype: 'textfield',
            fieldLabel: 'ID Group Pemohon',
			anchor: '80%',
			name: 'f[grouppemohon]'
        },
		
		{
            xtype: 'datefield',
            fieldLabel: 'Tanggal Daftar',			
			anchor: '80%',
			name: 'f[tgldaftar]',
			format: 'Y-m-d'
        },
		{
            xtype: 'textfield',
            fieldLabel: 'Nama',			
			anchor: '80%',
			name: 'f[nama]'
        },
        {
            xtype: 'textfield',
            fieldLabel: 'Tempat',			
			anchor: '80%',
			name: 'f[tempat]'
        },
        {
            xtype: 'textfield',
            fieldLabel: 'Tanggal Lahir',			
			anchor: '80%',
			name: 'f[tglahir]'
        },
        {
            xtype: 'textfield',
            fieldLabel: 'Alamat',			
			anchor: '80%',
			name: 'f[alamat]'
        },
        {
            xtype: 'textfield',
            fieldLabel: 'Agama',			
			anchor: '80%',
			name: 'f[agama]'
        },
        {
            xtype: 'textfield',
            fieldLabel: 'No Telepon',			
			anchor: '80%',
			name: 'f[notelp]'
        },
        {
            xtype: 'textfield',
            fieldLabel: 'PB Pemohon',			
			anchor: '80%',
			name: 'pbpemohon'
        }
		
		
			
		],
        buttons: [{
            text: 'Save',
            handler: function(){
              
			  tambah.getForm().submit({
	                               
				success: function(tambah, o)
				{ 							 
					PemohonDataStore.reload();
					TambahForm.hide();	
				},
						
				failure: function(tambah, o)
				{							 
					Ext.MessageBox.alert('Warning','Failur');    
				}     
	            });
                
            }
        },{
            text: 'Reset',
            handler: function()
			{
                tambah.getForm().reset();
            }
        }]
    });
 
       
	var TambahForm = new Ext.Window({      
	    title: 'Tambah Data',	  
	    closable:true,
            closeAction:'hide',	 
	    width:500,
	    height:400,       
            layout: 'fit',		       
		    
		listeners : {
			show : function () {
				tambah.getForm().reset();
			}
		},
		modal: true,
		items: tambah
	    });
		
	function displayTambahForm(){
	    if(!TambahForm.isVisible())
		{      
	       TambahForm.show();
	    } 
		else 
		{
	       TambahForm.toFront();
	    }
	  }
		
	//===================================================
	//                              FORM EDIT DATA                                      //
	//===================================================
	var Edit = new Ext.form.FormPanel({
	    url:'controller/pemohon.php?act=edit',   
		baseParams:{
			act:"edit"
		},		
		 
                width: 450,         		
                autoheight:true,
                bodyStyle:'padding:5px 5px 0',		                
                labelWidth: 130,		
		frame:true,        
		reader: new Ext.data.JsonReader ({
			root: 'results',
			totalProperty: 'total',
			id: 'idpemohon',
			fields: [
				'idpemohon','idgrouppemohon','tgldaftarpemohon','nama','alamat','tempat','tglahir','agama','pekerjaan','notelp','pbpemohon'
			]
		}),
        items: 
		[
		{
           xtype: 'textfield',
            fieldLabel: 'ID Pemohon',			
			anchor: '80%',
                        readOnly: true,
			name: 'idpemohon',
                        id: 'idpemohon'
        },
        {xtype: 'textfield',
            fieldLabel: 'ID Group Pemohon',
			anchor: '80%',
			name: 'idgrouppemohon',
                        id: 'idgrouppemohon'
        },
		
		{
            xtype: 'datefield',
            fieldLabel: 'Tanggal Daftar',			
			anchor: '80%',
			name: 'tgldaftarpemohon',
			format: 'Y-m-d'
        },
		{
            xtype: 'textfield',
            fieldLabel: 'Nama',			
			anchor: '80%',
			name: 'f[nama]',
                        id: 'nama'
        },
        {
            xtype: 'textfield',
            fieldLabel: 'Tempat',			
			anchor: '80%',
			name: 'f[tempat]',
                        id: 'tempat'
        },
        {
            xtype: 'textfield',
            fieldLabel: 'Tanggal Lahir',			
			anchor: '80%',
			name: 'f[tglahir]',
                        id: 'tglahir'
        },
        {
            xtype: 'textfield',
            fieldLabel: 'Alamat',			
			anchor: '80%',
			name: 'f[alamat]',
                        id: 'alamat'
        },
        {
            xtype: 'textfield',
            fieldLabel: 'Agama',			
			anchor: '80%',
			name: 'f[agama]',
                        id: 'agama'
        },
        {
            xtype: 'textfield',
            fieldLabel: 'pekerjaan',			
			anchor: '80%',
			name: 'f[pekerjaan]',
                        id: 'pekerjaan'
        },
        {
            xtype: 'textfield',
            fieldLabel: 'No Telepon',			
			anchor: '80%',
			name: 'f[notelp]',
                        id: 'notelp'
        },
        {
            xtype: 'textfield',
            fieldLabel: 'PB Pemohon',			
			anchor: '80%',
			name: 'pbpemohon',
                        id: 'pbpemohon'
        }				
		],
		
		buttons: [{
            text: 'SAVE',
			handler:function()
			{
				Edit.getForm().submit
				({
					waitMsg:'Simpan Data...',
					
					success: function(form, action) 
					{
						Ext.MessageBox.alert('Succcess', 'Edit Data Berhasil');
						PemohonDataStore.load({params:{start:0,limit:11}});
						EditForm.hide();
						Edit.getForm().reset();
					},
															
					failure: function(form, action)
					{
						Ext.MessageBox.alert('Error', 'Edit Data Gagal');
						Edit.getForm().reset();
					}
					
				})
			}
        },
		{
            text: 'Cancel',
			handler: function()
			{
				EditForm.hide();
			}
        }]
	});
	var EditForm = new Ext.Window({
            title: 'Edit Input',
            closable:true,
            closeAction:'hide',	 
	    width:500,
	    height:400,       
            layout: 'fit',		
            modal: true,		
        items: [
			Edit
		]
    });
	
	function del(btn)
	{
		if(btn == 'yes')
		{
			var m = EditorGrid.getSelectionModel().getSelections();
			var store = EditorGrid.getStore();
			
			for(var i=0; i< m.length; i++){
				var rec = m[i];
				if(rec){
					PemohonDataStore.load({
						params:{del:rec.get("idpemohon"),start:0,limit:10},
						callback: function(){
							
						}
					});store.remove(rec);
				}
			}
			
		}
	}
        
      function startAdvancedSearch(){
      // local vars
      var GroupSearchForm;
      var GroupSearchWindow;
      var Searchdata1;
      var Searchisi1;
      var Searchdata2;
      var Searchisi2;
     Searchdata1 = new Ext.form.ComboBox({ 
                        fieldLabel: 'Cari Berdasarkan',
                        maxLength: 20,
                        anchor : '95%',
                        typeAhead: true,
                        mode: 'local',
                        triggerAction: 'all',
                        forceSelection: true,
                        selectOnFocus:true,
                        emptyText: 'Pilih Data...',
                        store: ['Nama', 'Alamat', 'Tempat', 'Agama', 'Pekerjaan', 'No Telp'] 
                    });
      Searchisi1= new Ext.form.TextField({
          fieldLabel: 'Tulis Data',
          maxLength: 20,
          anchor : '95%',
          maskRe: /([a-zA-Z0-9\s]+)$/
            });

           
      Searchisi2 = new Ext.form.TextField({
          fieldLabel: 'Tulis Data',
          maxLength: 20,
          anchor : '95%',    
          maskRe: /([a-zA-Z0-9\s]+)$/  
            });
          
      GroupSearchForm = new Ext.FormPanel({
       labelAlign: 'top',
       bodyStyle: 'padding: 5px',
       width: 300,
       items: [{
         layout: 'form',
         border: false,
         items: [ Searchdata1,Searchisi1],
         buttons: [{
               text: 'Search',
               handler: function listSearch(){
                            // render according to a SQL date format.

                            // change the store parameters
                                //PemohonDataStore.baseParams = ;
                            // Cause the datastore to do another query : 
                             PemohonDataStore.baseParams = {
                                act: 'cari',
                                tipedata1: Searchdata1.getValue(),
                                data1 : Searchisi1.getValue()
//                                tipedata2: Searchdata2.getValue(),
//                                data2 : Searchisi2.getValue()
                                    };
                            // Cause the datastore to do another query :
                            PemohonDataStore.reload();
                        }
             },{
               text: 'Reset',
               handler: function resetSearch(){
                        // reset the store parameters
                                PemohonDataStore.baseParams = {
                                        task: 'LISTING'
                                };
                        // Cause the datastore to do another query : 
                        PemohonDataStore.reload();
                        GroupSearchWindow.close();
                    }
             }]
         }]
     });
     
     GroupSearchWindow = new Ext.Window({
         title: 'Cari Data Group Pemohon',
         closable:true,
         width: 200,
         height: 200,
         plain:true,
         layout: 'fit',
         items: GroupSearchForm
     });
     
 
     // once all is done, show the search window
        GroupSearchWindow.show();

        }
	
		  
	var EditorGrid =  new Ext.grid.EditorGridPanel({	    
		store: PemohonDataStore,
                title:'Data Pemohon',
                iconCls:'icon-grid',
		closable: true,
                loadMask: true,
		layout:'fit',
		autoWidth : true,
                height:350,
                autoScroll:true,
                stripeRows: true,
	    cm: PemohonColumnModel,		
		sm: Checkbox,
 
	    tbar:[	
			{
			    text: 'Tambah',		 
			    iconCls:'add',
			    handler: displayTambahForm
			} ,'-', {
                            text: 'Cari',
                            tooltip: 'Pencarian Data',
                            handler: startAdvancedSearch,  // search function
                            iconCls:'search'               // we'll need to add this to our css
                        },'-', 
	    
     		{
				text:'Edit',
				iconCls:'edit',
				handler: function()
				{
					 var m = EditorGrid.getSelectionModel().getSelections();
					 if(m.length > 0)
					 {
					    Edit.getForm().load({url:'controller/pemohon.php?act=get&idpemohon='+ m[0].get('idpemohon'), waitMsg:'Loading'});
						EditForm.show();			 
					 }
					 else
					 {
						Ext.MessageBox.alert('Warning', 'Pilih Salah Satu Yang Mau Anda Edit');
					 }
				}
		 
			},'-', 
			
			{
				text:'Hapus',
				iconCls:'remove',
				handler: function()
				{
					var m = EditorGrid.getSelectionModel().getSelections();
					if(m.length > 0)
					{
						Ext.MessageBox.confirm('Konfirmasi', 'Apakah Anda Yakin Menghapus Field Ini?' , del);						
					}
					else
					{
						Ext.MessageBox.alert('Warning', 'Pilih Salah Satu Yang Mau Anda Hapus');
					}
				}
			
			}
		 
		],
//	    viewConfig: {
//            forceFit:true
//        },	    
        
	    collapsible: true,
        animCollapse: true,
        
	    
	  
	    bbar: new Ext.PagingToolbar({
            pageSize: 11,
            store: PemohonDataStore,
            displayInfo: true,
            displayMsg: 'Menampilkan data {0} - {1} dari {2}',
            emptyMsg: "Tidak ada data"
        })
	  
	    });
	 
  EditorGrid.render('dok');
  PemohonDataStore.load();      // Load the data
 
  });
