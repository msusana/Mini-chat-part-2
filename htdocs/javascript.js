/*setInterval('load_message()', 3000);


function load_message(){
//    $var =  $('#message').load('load_message.php');
   $('#message').load('load_message.php', function () {
        $(this).find("#message").replaceWith($(this).text());
   });
}

function send() {
      var form = document.querySelector('#form');
      var send = form[0];
      if (send.value=="send") {
         window.location.href ="/recuperation_donnees/insert_sms.php"
    }
   }
   */

   function autoLoad(){
      $.ajax({
      url: '/load/load_message.php',
      success: function(data){
          $('#messages').html(data);
      }
      });
  }
  
  $(document).ready(function()
  {
      setInterval(autoLoad, 3000);
  });
  
  
  function sendMessage() {
      $.post('/recuperation_donnees/insert_sms.php',{
         message: $('#message'). val(),
         nickname: $('#nickname'). val(),
         color: $('#color'). val(),
      },function(){
         document.querySelector('#message').value=''
         document.querySelector('#nickname').value=''
         document.querySelector('#color').value='#ffffff'
         
          autoLoad()
      }
      )
  }
