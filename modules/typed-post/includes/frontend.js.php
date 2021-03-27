(function( $ ){
    //typed js
    //declare an array
    if ($('.typed-content-<?php echo $id; ?> a')[0]){
        var data_post = new Array();
        //get all instances of the SPAN tag and iterate through each one
        $('.typed-content-<?php echo $id; ?> a').each(function(){

            //build an associative array that assigns the span's id as the array id
            //assign the inner value of the span to the array piece
            //the single quotes and plus symbols are important in data_post[''++'']
            data_post[''+$(this).attr('id')+''] = $(this).text();

            //this code assigns the values to a non-associative array
            //use either this code or the code above depending on your needs
            data_post.push($(this).text());

        });
        var typed = new Typed('.typed-post-<?php echo $id; ?> .typed-here', {
            strings: data_post,
            typeSpeed: 30
        });
    }
});