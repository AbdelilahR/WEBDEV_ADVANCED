$(document).ready(function()
{
         function loadFirst()
        {
                   $("#fetchval").load('change',function()
                         {
            var keyword = $(this).val();
            
            $.ajax(
            {
                url:'fetch.php',
                type:'POST',
                data:'request='+keyword,
                
                beforeSend:function()
                {
                    $("#table-container").html('Working...');
                    
                },
                success:function(data)
                {
                    $("#table-container").html(data);
                },
            });
        });
        }
  
       
        loadFirst();
        $("#fetchval").on('change',function()
                         {
            var keyword = $(this).val();
            
            $.ajax(
            {
                url:'fetch.php',
                type:'POST',
                data:'request='+keyword,
                
                beforeSend:function()
                {
                    $("#table-container").html('Working...');
                    
                },
                success:function(data)
                {
                    $("#table-container").html(data);
                },
            });
        });
});
    