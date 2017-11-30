    $(document).ready(function(){
    var count = 1;
    $('#add').click(function(){
        count = count + 1;
        
        var html_code = "<div id='row"+count+"'>";
        html_code += "<div align='right' class='form-group divider col-sm-10'>";
        html_code += "</div>";
        html_code += "<div align='right' class='form-group col-sm-10'><span>Remove this good </span>";
         html_code += "<button type='button' name='remove' data-row='row"+count+"' class='btn btn-danger btn-xs remove'>-</button>";   
         html_code += "</div>";
        
        html_code += "<div class='form-group col-sm-10'>"; 
         html_code += "<input class='form-control' name='good_num[]' required onkeyup='amountt();' id='num"+count+"' type='text' placeholder='Total number of the goods'>";
         html_code += "</div>";
         
         html_code += "<div class='form-group col-sm-10'>"; 
         html_code += "<input class='form-control' name='good_name[]' required id='inumber' type='text' placeholder='Quantity of goods'>";
         html_code += "</div>";
         
         html_code += "<div class='form-group col-sm-10'>"; 
         html_code += "<input class='form-control' name='good_model[]' required id='inumber' type='text' placeholder='model'>";
         html_code += "</div>";
         
         html_code += "<div class='form-group col-sm-10'>"; 
         html_code += "<input class='form-control' name='good_cost[]' required onkeyup='amountt();' id='cost"+count+"' type='text' placeholder='cost'>";
         html_code += "</div>";
         
         html_code += "<div class='form-group col-sm-10'>"; 
         html_code += "<div class='form-control' disabled id='amount"+count+"' name='good_amount[]'>amount</div>";
         html_code += "</div>";
         
         html_code += "<div class='form-group col-sm-10'>"; 
         html_code += "<input class='form-control' name='good_comment[]' required id='inumber' type='text' placeholder='comment'>";
         html_code += "</div>";
         
         
         
         html_code += "</div>";
         $('#stock_div').append(html_code);
    });
    
    $(document).on('click', '.remove', function(){
        var delete_row = $(this).data("row");
        $('#' + delete_row).remove();
    });
    


          
    /*
    $('#save').click(function(){
        var invoice_num = [];
        var good_num = [];
        var good_name = [];
        var good_model = [];
        var good_cost = [];
        var good_amount = [];
        var good_date = [];
        var good_comment = [];
        $('.invoice_num').each(function(){
            invoice_num.push($(this).text());
        });
        $('.good_num').each(function(){
            good_num.push($(this).text());
        });
        $('.good_name').each(function(){
            good_name.push($(this).text());
        });
        $('.good_model').each(function(){
            good_model.push($(this).text());
        });
        $('.good_cost').each(function(){
            good_cost.push($(this).text());
        });
        $('.good_amount').each(function(){
            good_amount.push($(this).text());
        });
        $('.good_date').each(function(){
            good_date.push($(this).text());
        });
        $('.good_comment').each(function(){
            good_comment.push($(this).text());
        });
        $.ajax({
            url:"../business/insertstock2.php",
            method:"POST",
            data:{invoice_num:invoice_num,
                    good_num:good_num,
                    good_name:good_name,
                    good_model:good_model,
                    good_cost:good_cost,
                    good_amount:good_amount,
                    good_date:good_date,
                    good_comment:good_comment
                },
            success:function(data){
                alert(data);
                $("td[contentEditable='true']").text("");
                //$("td[contentEditable='false']").text("");
                for(var i=2; i<= count; i++)
                {
                    $('tr#'+i+'').remove();
                }
                fetch_item_data();
            }
        });
    });
    
    function fetch_item_data()
    {
        $.ajax({
         url:"../business/fetch.php",
         method:"POST",
         success:function(data)
         {
          $('#inserted_good_data').html(data);
         }
        });
    }
    fetch_item_data();
 */
});