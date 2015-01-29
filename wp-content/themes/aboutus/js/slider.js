

$(document).ready(function () {

// automatic rotation of slides
   function loadthis() {
    var slider = $(".contain-offers ul");
    var left = slider.css('margin-left');
    var news = parseInt(left, 10);
    var slideContainer = $('.contain-offers ul').children('li'),
    imgsLen = slideContainer.length,
    imgWidth = slideContainer.width();
    totalImgsWidth = imgsLen * imgWidth;
    var numbs = imgWidth + news;
    console.log(imgWidth);
    
    if(news == 0){
    slider.animate( { 'margin-left': -numbs}); 
    } 

    else if(news < 0 && news > -totalImgsWidth+imgWidth) {
     // console.log(-imgWidth + news)
    slider.animate( { 'margin-left': -imgWidth + news}); 
    }  

    else {
         slider.animate( { 'margin-left': 0 }); 
    }

};

if(window.location.origin == document.URL){
   var timer = window.setInterval(loadthis, 8000);
}




});
