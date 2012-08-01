function ajaxRequest(){
 var activexmodes=["Msxml2.XMLHTTP", "Microsoft.XMLHTTP"] //activeX versions to check for in IE
 if (window.ActiveXObject){ //Test for support for ActiveXObject in IE first (as XMLHttpRequest in IE7 is broken)
  for (var i=0; i<activexmodes.length; i++){
   try{
    return new ActiveXObject(activexmodes[i])
   }
   catch(e){
    //suppress error
   }
  }
 }
 else if (window.XMLHttpRequest) // if Mozilla, Safari etc
  return new XMLHttpRequest()
 else
  return false
}

function IopenKelas(){
$('.jjgblm').remove();
$('#spanImapel').html('<select disabled="disabled" class="span6" id="Imapel" name="Imapel">');
var mygetrequest=new ajaxRequest()
mygetrequest.onreadystatechange=function(){
 if (mygetrequest.readyState==4){
  if (mygetrequest.status==200 || window.location.href.indexOf("http")==-1){
   document.getElementById("spanIkelas").innerHTML=mygetrequest.responseText;
  }
  else{
   alert("An error has occured making the request")
  }
 }
}
var jjg=encodeURIComponent(document.getElementById("Ijenjang").value)
mygetrequest.open("GET", "IopenKelas.php?jenjang="+jjg, true)
mygetrequest.send(null)
}

function IopenMapel(){
$('.klsblm').remove();
var mygetrequest=new ajaxRequest()
mygetrequest.onreadystatechange=function(){
 if (mygetrequest.readyState==4){
  if (mygetrequest.status==200 || window.location.href.indexOf("http")==-1){
   document.getElementById("spanImapel").innerHTML=mygetrequest.responseText;
  }
  else{
   alert("An error has occured making the request")
  }
 }
}
var kls=encodeURIComponent(document.getElementById("Ikelas").value)
mygetrequest.open("GET", "IopenMapel.php?kelas="+kls, true)
mygetrequest.send(null)
}

function Implblm(){
$('.mplblm').remove();
}

function ajaxmoveold(){
                $.ajax( {
                    type:"POST",
                    url: "./move.php",
                    success: function() {
                        $('#bekerja').html("work gan");                         
                        
                    }
                });
}

function ajaxmove(){
var mygetrequest=new ajaxRequest()
mygetrequest.onreadystatechange=function(){
 if (mygetrequest.readyState==4){
  if (mygetrequest.status==200 || window.location.href.indexOf("http")==-1){
   document.getElementById("bekerja").innerHTML=mygetrequest.responseText;
  }
  else{
   alert("An error has occured making the request")
  }
 }
}
mygetrequest.open("GET", "move.php", true)
mygetrequest.send(null)
}