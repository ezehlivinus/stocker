

    $(document).ready(function(){
    var count = 1;
    $('#add').click(function(){
        count = count + 1;
        var html_code = "<tr id='row"+count+"'>";
         //html_code += "<td  class='invoice_num' id='invoice"+count+"'></td>";
         html_code += "<td  class='good_num'><input type='text' name='good_num[]' onkeyup='amountt();' id='num"+count+"' class='form-control'/></td>";
         html_code += "<td  class='good_name'><input type='text' name='good_name[]' class='form-control' /></td>";
         html_code += "<td  class='good_model'><input type='text' name='good_model[]'  class='form-control' /></td>";
         html_code += "<td  class='good_cost'><input type='text' name='good_cost[]' onkeyup='amountt();' id='cost"+count+"' class='form-control'/></td>";
         html_code += "<td  class='good_amount' id='amount"+count+"'></td>";
         //html_code += "<td  class='good_date' ><input type='text' name='good_date[]' class='form-control' placeholder=''/></td>";
         html_code += "<td  class='good_comment'><input type='text' name='good_comment[]' class='form-control'/></td>";
         html_code += "<td><button type='button' name='remove' data-row='row"+count+"' class='btn btn-danger btn-xs remove'>-</button></td>";
         html_code += "</tr>";  
         $('#stock_table').append(html_code);
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
    */
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
    //fetch_item_data();
 
});
