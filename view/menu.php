<!-- Navbar ================================================== -->
<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
            <div class="btn-group pull-right">
           <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="icon-user icon-white"></i> Admin
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="?op=logout">Sign Out</a></li>
            </ul>
          </div>
            <ul class="nav pull-left">
<!--        menu kiri        -->
            </ul>
                <p class="brand" style="margin: 0; margin-left: 31%; margin-top: 3px; padding: 0;"><img src="assets/img/header.png"/></p>

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
                        <ul id="Mpemohon" class="submenu collapse in" style="list-style: none;">
                            <li><a href="?op=pemohon" style="text-decoration: none"><i class="icon-plus-sign"></i>&nbsp; input pemohon</a></li>
                            <li><a href="?op=tpemohon" style="text-decoration: none"><i class="icon-search"></i> &nbsp;lihat pemohon</a></li>     
                        </ul>
                    </div>
                    <li><a href="#" data-toggle="collapse" data-target="#Mtransaksi"><i class="icon-list-alt"></i>&nbsp;&nbsp;<b>Data Transaksi</b></a></li>
                    <div  style="background-color: #f5f5f5;   border: 1px solid #eee; border: 1px solid rgba(0, 0, 0, 0.05);" >    
                        <ul id="Mtransaksi" class="submenu collapse in" style="list-style: none;">
                            <li ><a href="?op=transaksi&act=add" style="text-decoration: none"><i class="icon-plus-sign"></i>&nbsp; input transaksi</a></li>
                            <li ><a href="?op=ttransaksi" style="text-decoration: none"><i class="icon-search"></i> &nbsp;lihat transaksi</a></li>                    
                        </ul>
                    </div>
                    <li><a href="#" data-toggle="collapse" data-target="#Mtransaksi"><i class="icon-list-alt"></i>&nbsp;&nbsp;<b>Data Group</b></a></li>
                    <div  style="background-color: #f5f5f5;   border: 1px solid #eee; border: 1px solid rgba(0, 0, 0, 0.05);" >    
                        <ul id="Mtransaksi" class="submenu collapse in" style="list-style: none;">
                            <li ><a href="?op=tgrouppemohon" style="text-decoration: none"><i class="icon-tags"></i>&nbsp; Group Pemohon</a></li>
                            <li ><a href="?op=tgrouptransaksi" style="text-decoration: none"><i class="icon-tags"></i> &nbsp;Group Transaksi</a></li>                    
                        </ul>
                    </div>
                </ul>
        </div>
        
    </div>
    

