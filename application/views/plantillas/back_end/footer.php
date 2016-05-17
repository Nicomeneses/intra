<script type="text/javascript">
function toggleFullScreen() {
if ((document.fullScreenElement && document.fullScreenElement !== null) ||    
 (!document.mozFullScreen && !document.webkitIsFullScreen)) {
  if (document.documentElement.requestFullScreen) {  
    document.documentElement.requestFullScreen();  
  } else if (document.documentElement.mozRequestFullScreen) {  
    document.documentElement.mozRequestFullScreen();  
  } else if (document.documentElement.webkitRequestFullScreen) {  
    document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);  
  }  
} else {  
  if (document.cancelFullScreen) {  
    document.cancelFullScreen();  
  } else if (document.mozCancelFullScreen) {  
    document.mozCancelFullScreen();  
  } else if (document.webkitCancelFullScreen) {  
    document.webkitCancelFullScreen();  
  }  
}  
}

$(function(){
   $.simpleWeather({
    woeid: '2345029',
    location: '',
    unit: 'c',
    success: function(weather) {
      $("#weather").html("<img src='"+weather.image+"' style='margin:-4px -65px;position:absolute;' width='70px' height='50px'>"+ +weather.temp+'&deg; '+weather.units.temp);
       region=weather.city.split(" "); 
      $(".region").html(region[0]+" de "+ weather.country);
      if(weather.currently=="Cloudy"){  estado="Nublado";}
      else if(weather.currently=="Showers"){  estado="Llovisna";}
      else if(weather.currently=="Sunny"){  estado="Soleado";}
      else if(weather.currently=="Mostly Sunny"){  estado="Mayormente Soleado";}
      else if(weather.currently=="Partly Cloudy"){  estado="Parcialmente Nublado";}
      else if(weather.currently=="Mostly Cloudy"){  estado="Mayormente Nublado";}
      else{
         estado=weather.currently;
      }
      $(".estadotiempo").html(estado);
    },
    error: function(error) {
      $("#weather").html('<b>'+error+'</b>');
    }
  });


 $('.button-collapse').sideNav({
      menuWidth: 180, // Default is 240
      edge: 'left', // Choose the horizontal origin
      closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
    }
  );
  $('.collapsible').collapsible();      
  $('.modal-trigger').leanModal();
  $('select').material_select();

  $(window).load(function() {
       window.setTimeout(function(){
          $('#body').addClass('loaded');
        } , 500);
      
    });
});

</script>
</body>
</html>