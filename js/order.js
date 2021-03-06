$(document).ready(function() {
  
  var orders = "";
  var orderLength = 0;
  var count = 0;
  $.ajax({
    url: 'fetch_order_data.php',
    type: 'GET',
    beforeSend: function() {
      $('div.orderbutton').hide();
      $('div.orderContainer').addClass('loader');
    },
    success:function(data){
      var project = document.querySelector('div.orderContainer');
      project.style.opacity = 0;  
      orders = JSON.parse(data);
      orderLength = orders.length;
      
      var table = "<table class='table table-bordered'><thead><tr><th>Title</th><th>Quantity</th><th>Price</th><th>Order_id</th><th>Date/Time</th><th>Status</th></tr></thead><tbody>";
      for(i = 0; i < 3; i++){
        if(i == orderLength){
          $("#nxtBtn").prop('disabled',true);
          break;
        }
        if (orders[i].is_cancelled == "1"){
          table = table + "<tr><td>"+orders[i].img+"</td><td>"+orders[i].qty+"</td><td>$"+orders[i].price+"</td><td>"+orders[i].orderId+"</td><td>"+orders[i].time+"</td><td>Cancelled</td></tr>";
        }
        else {
          table = table + "<tr><td>"+orders[i].img+"</td><td>"+orders[i].qty+"</td><td>$"+orders[i].price+"</td><td>"+orders[i].orderId+"</td><td>"+orders[i].time+"</td><td><button type='button' id='btn"+orders[i].movieId+"."+orders[i].orderId+"' class='btn btn-default'>Cancel</button></td></tr>";
        }
      }
      table = table + "</tbody></table>";
      if(i == orderLength){
        $("#nxtBtn").prop('disabled',true);
      }
      $("#prBtn").prop('disabled',true);  
      setTimeout(function(){ 
        $('div.orderContainer').removeClass('loader');
        // Load new content
        if(orderLength == 0){
          $('div.orderContainer').html("<div id='noResults'>You dont have any order history.</div>");
        } else {
          $("div.orderContainer").html(table); 
          $('div.orderbutton').show();    
        }
        // Fade in
        project.style.opacity = 1;
      },500);
    }
  });	

  $("#nxtBtn").click(function(){
    
    var project = document.querySelector('div.orderContainer');
    project.style.opacity = 0;
    $("#prBtn").removeAttr('disabled');
    this.value = parseInt(this.value) + 1;
    $("#prBtn").val(this.value);
    var table = "<table class='table table-bordered'><thead><tr><th>Title</th><th>Quantity</th><th>Price</th><th>Order_id</th><th>Date/Time</th><th>Status</th></tr></thead><tbody>";
    for(i = 3*this.value; i < (3*this.value+3); i++){
      if(i == orderLength){
        $("#nxtBtn").prop('disabled',true);
        break;
      }
      //table = table + "<tr><td>"+orders[i].img+"</td><td>"+orders[i].qty+"</td><td>$"+orders[i].price+"</td><td>"+orders[i].orderId+"</td><td>"+orders[i].time+"</td></tr>";          
      if (orders[i].is_cancelled == "1"){
        table = table + "<tr><td>"+orders[i].img+"</td><td>"+orders[i].qty+"</td><td>$"+orders[i].price+"</td><td>"+orders[i].orderId+"</td><td>"+orders[i].time+"</td><td>Cancelled</td></tr>";
      }
      else {
        table = table + "<tr><td>"+orders[i].img+"</td><td>"+orders[i].qty+"</td><td>$"+orders[i].price+"</td><td>"+orders[i].orderId+"</td><td>"+orders[i].time+"</td><td><button type='button' id='btn"+orders[i].movieId+"."+orders[i].orderId+"' class='btn btn-default'>Cancel</button></td></tr>";
      }
    }
    if(i == orderLength){
      $("#nxtBtn").prop('disabled',true);
    }
    table = table + "</tbody></table>";  
    setTimeout(function(){ 
        // Load new content
        $("div.orderContainer").html(table);     
        // Fade in
        project.style.opacity = 1;
    },500);
  });

  $("#prBtn").click(function(){
    var project = document.querySelector('div.orderContainer');
    project.style.opacity = 0;
    
    $("#nxtBtn").removeAttr('disabled');
    this.value = parseInt(this.value) - 1;
    $("#nxtBtn").val(this.value);
    var table = "<table class='table table-bordered'><thead><tr><th>Title</th><th>Quantity</th><th>Price</th><th>Order_id</th><th>Date/Time</th><th>Status</th></tr></thead><tbody>";
    for(i = 3*this.value; i < (3*this.value+3); i++){
      //table = table + "<tr><td>"+orders[i].img+"</td><td>"+orders[i].qty+"</td><td>$"+orders[i].price+"</td><td>"+orders[i].orderId+"</td><td>"+orders[i].time+"</td></tr>";          
      if (orders[i].is_cancelled == "1"){
        table = table + "<tr><td>"+orders[i].img+"</td><td>"+orders[i].qty+"</td><td>$"+orders[i].price+"</td><td>"+orders[i].orderId+"</td><td>"+orders[i].time+"</td><td>Cancelled</td></tr>";
      }
      else {
        table = table + "<tr><td>"+orders[i].img+"</td><td>"+orders[i].qty+"</td><td>$"+orders[i].price+"</td><td>"+orders[i].orderId+"</td><td>"+orders[i].time+"</td><td><button type='button' id='btn"+orders[i].movieId+"."+orders[i].orderId+"' class='btn btn-default'>Cancel</button></td></tr>";
      }
    }
    if(this.value == 0){
      $("#prBtn").prop('disabled',true);
    }
    table = table + "</tbody></table>";
    setTimeout(function(){ 
      // Load new content
      $("div.orderContainer").html(table);     
      // Fade in
      project.style.opacity = 1;
    },500);
  });
  
  $(document).on("click", ".btn-default", function(){
    var btn=$(this).parent();
    var btnId = $(this).attr('id');
    var u_id = btnId.substring(3);
    var res = u_id.split(".");
    var hide=false;
    movieId = res[0];
    orderId = res[1];
    // alert(movieId);
    // alert(orderId);
    $.ajax({
          url: 'cancel.php',
          type: 'POST',
          data:  {movie_id: movieId, order_id: orderId},
          success:function(data){
            btn.empty();
            btn.append("Cancelled");
            for(i = 0; i < orderLength; i++){
              if (orders[i].orderId == orderId){
                orders[i].is_cancelled = 1; 
                break;
              }
            }
          },
          error:function(err){
            alert(err);
			    }
		});  
  });
});