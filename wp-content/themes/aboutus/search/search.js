

//load ajax
function showUser(city){


//on user click 
   if (city=="") {
    document.getElementById("content-hold-this").innerHTML="";
    return;
  } 

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    theobject=new XMLHttpRequest();
  } else { // code for IE6, IE5
    theobject=new ActiveXObject("Microsoft.XMLHTTP");
  }
  theobject.onreadystatechange=function() {
    if (theobject.readyState==4 && theobject.status==200) {
      document.getElementById("custom-search-container").innerHTML=theobject.responseText;
    }
  }
  theobject.open("GET","/wp-content/themes/aboutus/search/page-query.php?b="+city,true);
  theobject.send();
}

function keywordSelection(keywordvalue){


//on user click 
   if (keywordvalue=="") {
    document.getElementById("content-hold-this").innerHTML="";
    return;
  } 

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("custom-search-container").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","/wp-content/themes/aboutus/search/page-keyword.php?q="+keywordvalue,true);
  xmlhttp.send();
}



   


function directoryImage(changed){


//on user click 
   if (changed=="") {
    document.getElementById("directory-image").css('background-image', '');
    return;
  } 

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
   document.getElementById("directory-image").style.backgroundImage="url('" + xmlhttp.responseText + "')";

   console.log(xmlhttp.responseText);

    }
  }
  xmlhttp.open("GET","/wp-content/themes/aboutus/image-load.php?q="+changed,true);
  xmlhttp.send();
}






function offerSelect(id){

if (id=="") {
    document.getElementById("the-offer").css('background-image', '');
    return;
  } 

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
   // document.getElementById('A1').innerHTML=xmlhttp.status;
   //document.getElementById("bki-offer").style.backgroundImage="url('" + xmlhttp.responseText + "')";

    document.getElementById("the-offer").innerHTML=xmlhttp.responseText;

    

    }
  }
  xmlhttp.open("GET","/wp-content/themes/aboutus/ajax/offers.php?q="+id,true);
  xmlhttp.send();
}

// function direction(id, dir){

//   if (id=="") {
//     document.getElementById("the-offer").css('background-image', '');
//     return;
//   } 

//   if (window.XMLHttpRequest) {
//     // code for IE7+, Firefox, Chrome, Opera, Safari
//     xmlhttp=new XMLHttpRequest();
//   } else { // code for IE6, IE5
//     xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
//   }
//   xmlhttp.onreadystatechange=function() {
//     if (xmlhttp.readyState==4 && xmlhttp.status==200) {
//    // document.getElementById('A1').innerHTML=xmlhttp.status;
//    //document.getElementById("bki-offer").style.backgroundImage="url('" + xmlhttp.responseText + "')";

//     document.getElementById("the-offer").innerHTML=xmlhttp.responseText;

    

//     }
//   }
//   xmlhttp.open("GET","/wp-content/themes/aboutus/ajax/pagnation.php?q="+id+"&dir="+dir,true);
//   xmlhttp.send();
// }



// retrieve data on click
// get data-dir id
// set up default action if requested attribute of selector is empty
// open window
// on status, retrieve html and put it in chosen selector
// retrieve from file 
// send to page





