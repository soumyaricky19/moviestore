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
      if(orders.length < 3){
        count = orderLength;
      } else {
        count = 3;
      }
      var table = "<table class='table table-bordered'><thead><tr><th>Title</th><th>Quantity</th><th>Price</th><th>Order_id</th><th>Date/Time</th></tr></thead><tbody>";
      for(i = 0; i < count; i++){
        table = table + "<tr><td>"+orders[i].img+"</td><td>"+orders[i].qty+"</td><td>$"+orders[i].price+"</td><td>"+orders[i].orderId+"</td><td>"+orders[i].time+"</td></tr>";          
      }
      table = table + "</tbody></table>";
      setTimeout(function(){ 
        // Load new content
        $('div.orderContainer').removeClass('loader');
        $("div.orderContainer").html(table); 
        $('div.orderbutton').show();    
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
    var table = "<table class='table table-bordered'><thead><tr><th>Title</th><th>Quantity</th><th>Price</th><th>Order_id</th><th>Date/Time</th></tr></thead><tbody>";
    for(i = 3*this.value; i < (3*this.value+3); i++){
      if(i == orderLength){
        $("#nxtBtn").prop('disabled',true);
        break;
      }
      table = table + "<tr><td>"+orders[i].img+"</td><td>"+orders[i].qty+"</td><td>$"+orders[i].price+"</td><td>"+orders[i].orderId+"</td><td>"+orders[i].time+"</td></tr>";          
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
    var table = "<table class='table table-bordered'><thead><tr><th>Title</th><th>Quantity</th><th>Price</th><th>Order_id</th><th>Date/Time</th></tr></thead><tbody>";
    for(i = 3*this.value; i < (3*this.value+3); i++){
      table = table + "<tr><td>"+orders[i].img+"</td><td>"+orders[i].qty+"</td><td>$"+orders[i].price+"</td><td>"+orders[i].orderId+"</td><td>"+orders[i].time+"</td></tr>";          
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
});