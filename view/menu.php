<!-- Navbar ================================================== -->
<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
            <div class="btn-group pull-right">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="icon-user"></i> Admin
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="?op=logout">Sign Out</a></li>
            </ul>
          </div>
            <ul class="nav pull-left">
<!--        menu kiri        -->
            </ul>
                <p class="brand" style="margin-left: 35%; margin-bottom: 0;"> NOTARIS & PPAT </p> 

                <ul class="nav pull-right">
<!--          menu kanan          -->
                </ul>
        </div>
      </div>
    </div>
    
    
<div class="container">
    <div class="row">
        <br /><br/><br/><br/>
    </div>
    <div class="row">
        <div class="span3">
            <div class="well mepet">
                <ul class="nav nav-tabs nav-stacked menu">
                    <li><a style="padding-right: 17px;" class="disabled menuhead"><center><b>MENU</b></center></a></li>
                    <li><a href="?"><i class="icon-home"></i>&nbsp;&nbsp;<b>Home</b></a></li>
                    <li><a href="#" data-toggle="collapse" data-target="#Mpemohon"><i class="icon-user"></i>&nbsp;&nbsp;<b>Data Pemohon</b> </a></li>
                    <div  style="background-color: #f5f5f5;   border: 1px solid #eee; border: 1px solid rgba(0, 0, 0, 0.05);" >
                        <ul id="Mpemohon" class="submenu collapse in">
                            <li><a href="?op=pemohon"><i class="icon-plus-sign"></i>&nbsp; input pemohon</a></li>
                            <li><a href="?op=tpemohon"><i class="icon-search"></i> &nbsp;lihat pemohon</a></li>     
                        </ul>
                    </div>
                    <li><a href="#" data-toggle="collapse" data-target="#Mtransaksi"><i class="icon-list-alt"></i>&nbsp;&nbsp;<b>Data Transaksi</b></a></li>
                    <div  style="background-color: #f5f5f5;   border: 1px solid #eee; border: 1px solid rgba(0, 0, 0, 0.05);" >    
                        <ul id="Mtransaksi" class="submenu collapse in">
                            <li ><a href="?op=transaksi&act=add"><i class="icon-plus-sign"></i>&nbsp; input transaksi</a></li>
                            <li ><a href="?op=ttransaksi"><i class="icon-search"></i> &nbsp;lihat transaksi</a></li>                    
                        </ul>
                    </div>
                    <li><a href="#" data-toggle="collapse" data-target="#Mtransaksi"><i class="icon-list-alt"></i>&nbsp;&nbsp;<b>Data Group</b></a></li>
                    <div  style="background-color: #f5f5f5;   border: 1px solid #eee; border: 1px solid rgba(0, 0, 0, 0.05);" >    
                        <ul id="Mtransaksi" class="submenu collapse in">
                            <li ><a href="?op=tgrouppemohon"><i class="icon-user"></i>&nbsp; Group Pemohon</a></li>
                            <li ><a href="?op=tgrouptransaksi"><i class="icon-user"></i> &nbsp;Group Transaksi</a></li>                    
                        </ul>
                    </div>
                </ul>
        </div>
        
    </div>
    

