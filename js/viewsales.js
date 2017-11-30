

    $(document).ready(function(){
    
    $('#submit').click(function(){
        var from;
        var to;
        $('.from').each(function(){
            from.push($(this).text());
        });
        $('.to').each(function(){
            to.push($(this).text());
        });

        $.ajax({
            url:"../business/viewsalesjs.php",
            method:"POST",
            data:{from:from, to:to},
            success:function(data){
                alert(data);
                fetch_item_data();
            }
        });
    });
    
    function fetch_item_data()
    {
        $.ajax({
         url:"../business/viewsalesjs.php",
         method:"POST",
         success:function(data)
         {
          $('#view_sold_items').html(data);
         }
        });
    }
    //fetch_item_data();
 
});
