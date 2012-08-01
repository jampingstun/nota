var nm_groppemohon;       // this will be our columnmodel
var id_grouppemohon;
var pb_grouppemohon;
 
Ext.onReady(function(){
  Ext.QuickTips.init();
var Checkbox = new Ext.grid.CheckboxSelectionModel();	
PemohonDataStore = new Ext.data.Store({
      id: 'PemohonDataStore',
      proxy: new Ext.data.HttpProxy({
                url: 'controller/grouppemohon.php',      // File to connect to
                method: 'POST'
            }),
            baseParams:
		{
		    orderby:'id_grouppemohon',
                    sort:'DESC'
	  
	    }, // this parameter asks for listing
      reader: new Ext.data.JsonReader({   
                  // we tell the datastore where to get his data from
        root: 'results',
        totalProperty: 'total',
        id: 'id'
      },[ 
        {name: 'id_grouppemohon', type: 'int', mapping: 'id_grouppemohon'},
        {name: 'nm_grouppemohon', type: 'string', mapping: 'nm_grouppemohon'},
        {name: 'pb_grouppemohon', type: 'int', mapping: 'pb_grouppemohon'}
      ]),
      sortInfo:{field: 'id_grouppemohon', direction: "ASC"}
    });
     PemohonDataStore.load();
    PemohonColumnModel = new Ext.grid.ColumnModel(
    [   Checkbox,
        {
        header: 'ID Group Pemohon',
        readOnly: true,
        dataIndex: 'id_grouppemohon', // this is where the mapped name is important!
        width: 150,
        hidden: false
      },
      {
        header: 'Nama Group Pemohon',
        dataIndex: 'nm_grouppemohon',
        width: 150,
        hidden: false
      },{
        header: 'PB Group Pemohon',
        dataIndex: 'pb_grouppemohon',
        width: 150,
        readOnly: true                     // we don't necessarily want to see this...
      }]
    );
    PemohonColumnModel.defaultSortable= true;
 
  //// Load the data
    // Display our window
 
//});

//======================form searching=======================//


//==================================================//
	//                             FORM TAMBAH DATA                               //
	//==================================================//
	var tambah = new Ext.FormPanel({
		url:'controller/grouppemohon.php?act=add',
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
            fieldLabel: 'ID Group Pemohon',
			anchor: '80%',
			name: 'id_grouppemohon'
        },
       	{
            xtype: 'textfield',
            fieldLabel: 'Nama Group Pemohon',			
			anchor: '80%',
			name: 'f[nm_grouppemohon]'
			
        },
	{
            xtype: 'textfield',
            fieldLabel: 'PB Group Pemohon',			
			anchor: '80%',
			name: 'f[pb_grouppemohon]'
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
	    url:'controller/grouppemohon.php?act=edit',   
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
			id: 'id_grouppemohon',
			fields: [
				'id_grouppemohon','nm_grouppemohon','pb_grouppemohon'
			]
		}),
        items: 
		[
		new Ext.form.Hidden 
		({
			//name: 'id_transaksi'					
		}),
		{
            xtype: 'textfield',
            fieldLabel: 'ID Group Pemohon',
			anchor: '80%',
                        readOnly: true,
			name: 'id_grouppemohon'
        },
		
	{
            xtype: 'textfield',
            fieldLabel: 'Nama Group Pemohon',			
			anchor: '80%',
			name: 'nm_grouppemohon',
                        id: 'nm_grouppemohon'
			
        },
	{
            xtype: 'textfield',
            fieldLabel: 'PB Group Pemohon',			
			anchor: '80%',
			name: 'pb_grouppemohon',
                        id: 'pb_grouppemohon'
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
	    height:500,       
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
						params:{del:rec.get("id_grouppemohon"),start:0,limit:10},
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
      var SearchIdGroup;
      var SearchNmGroup;
      var SearchPbGroup;
 
      SearchIdGroup= new Ext.form.TextField({
          fieldLabel: 'ID Group',
          maxLength: 20,
          anchor : '95%',
          maskRe: /([a-zA-Z0-9\s]+)$/
            });
 
      SearchNmGroup = new Ext.form.TextField({
          fieldLabel: 'Nama Group',
          maxLength: 20,
          anchor : '95%',    
          maskRe: /([a-zA-Z0-9\s]+)$/  
            });
            
      SearchPbGroup = new Ext.form.TextField({
          fieldLabel: 'PB Group',
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
         items: [ SearchIdGroup,SearchNmGroup,SearchPbGroup],
         buttons: [{
               text: 'Search',
               handler: function listSearch(){
                            // render according to a SQL date format.

                            // change the store parameters
                                //PemohonDataStore.baseParams = ;
                            // Cause the datastore to do another query : 
                             PemohonDataStore.baseParams = {
                                act: 'cari',
                                id_grouppemohon: SearchIdGroup.getValue(),
                                nm_grouppemohon : SearchNmGroup.getValue(),
                                pb_grouppemohon : SearchPbGroup.getValue()
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
         height: 300,
         plain:true,
         layout: 'fit',
         items: GroupSearchForm
     });
     
 
     // once all is done, show the search window
        GroupSearchWindow.show();

        }
		  
	var EditorGrid =  new Ext.grid.EditorGridPanel({	    
		store: PemohonDataStore,
                title:'Data Group Pemohon',
                iconCls:'icon-grid',
		closable: true,
                defaults:{autoScroll:true},
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
			}, '-', {
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
					    Edit.getForm().load({url:'controller/grouppemohon.php?act=get&id_grouppemohon='+ m[0].get('id_grouppemohon'), waitMsg:'Loading'});
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
	    viewConfig: {
            forceFit:true
        },	    
        
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
	 
  EditorGrid.render('dok');      // Load the data
 
  });
