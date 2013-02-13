function signed(message_id){
    $.ajax({
       'url':"ajax_signed.php",
       'type':"post",
       'data':"message_id="+message_id,
       'success':function(msg){
           console.log(msg.times);
          if(msg.times == "never"){
            alert('too quick!');
          }else{
            $('#'+message_id).text(msg.times);
            $('#table_signed').after(msg.signed);
          }

       }
    });
}
function del(message_id){
    $.ajax({
       'url':'ajax_signed.php',
       'type':'get',
       'data':'message_id='+message_id,
       'success':function(msg){
           if(msg == 'success'){
               $('#'+message_id+"1").hide();
           }
       }
    });
}