  $(function(){
  var navbar = $('#navbar #navbar-inner');
  $(window).scroll(function(){
      if($(window).scrollTop() <= 30){
          navbar.css('box-shadow', '0px 0px ' + $(window).scrollTop() + 'px rgba(0, 0, 0, 0.4)'); 
      } else {
          navbar.css('box-shadow', '0px 0px 30px rgba(0, 0, 0, 0.4)'); 
      }
  });  
  })

  $(document).ready(function(){
    $("#search-btn").on("click", function() {
      var value = $("#myInput").val().toLowerCase();
      $(".card-deck .card").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });