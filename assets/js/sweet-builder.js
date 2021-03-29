jQuery(function ($) {
    // Clock
    clockUpdate();
    setInterval(clockUpdate, 1000);
  
    function clockUpdate() {
      var date = new Date();
      const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
      "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];
      function addZero(x) {
        if (x < 10) {
          return x = '0' + x;
        } else {
          return x;
        }
      }
    
      function twelveHour(x) {
        if (x > 12) {
          return x = x - 12;
        } else if (x == 0) {
          return x = 12;
        } else {
          return x;
        }
      }
    
      var d = addZero(date.getDate());
      var m = addZero(monthNames[date.getMonth()]);
      var y = addZero(date.getFullYear());
      var h = addZero(twelveHour(date.getHours()));
      var menit = addZero(date.getMinutes());
      var s = addZero(date.getSeconds());
    
      $('.digital-clock').html('<i class="fa fa-clock-o" aria-hidden="true"></i> ' + d + ' '  + m + ' '  + y + ' '  + h + ':' + menit + ':' + s)
    }
  
    $('.sweet-slider').flickity({
        // options
        cellAlign: 'center',
        wrapAround: true.valueOf,
        contain: true
    });


    //typed js
    //declare an array
    if ($('.typed-content span')[0]){
        var data_post = new Array();
        //get all instances of the SPAN tag and iterate through each one
        $('.typed-content span').each(function(){

            //build an associative array that assigns the span's id as the array id
            //assign the inner value of the span to the array piece
            //the single quotes and plus symbols are important in data_post[''++'']
            data_post[''+$(this).attr('id')+''] = $(this).html();

            //this code assigns the values to a non-associative array
            //use either this code or the code above depending on your needs
            data_post.push($(this).html());

        });
        var typed = new Typed('.typed-post .typed-here', {
            strings: data_post,
            typeSpeed: 30
        });
    }

    // hide me
    $(window).scroll(function() {
        if ($(this).scrollTop() > 50) {
          $('.hideme').hide();
        } else {
          $('.hideme').show();
        }
      });

});
  