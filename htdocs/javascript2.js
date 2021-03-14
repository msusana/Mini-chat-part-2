setInterval('load_user()', 3000);

function load_user(){
      $('#user').load('/load/load_user.php', function () {
           $(this).find("#user").replaceWith($(this).text());
      });
   }
   