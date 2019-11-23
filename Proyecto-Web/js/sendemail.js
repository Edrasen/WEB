$(document).ready(function(){
    $('.sidenav').sidenav();
    $('.modal').modal();

    $('.dropdown-button').dropdown({
      inDuration: 300,
      outDuration: 225,
      belowOrigin: true, // Displays dropdown below the button
      alignment: 'right' // Displays dropdown with edge aligned to the left of button
    }
    );
    
    function sendemail(){
        //console.log('sending...');
        //var name = $('#name');   
        var id = $('#custId'); 
        var email = $('#email');
        var subject = $('#subject');
        var body = $('#body');
    
        if (isNotEmpty(email)){
            //console.log('passed condition...');
            
            $.ajax({
                url: './inc/sendEmail.php', 
                method: 'POST',
                data: {
                    id : id.val(),
                    //name: name.val(),
                    email: email.val(),
                    subject: subject.val(),
                    body: body.val(),
                },
                cache: false,
                success: function (response) {
                    var tipoAlerts = new Array("red", "green");
                    var AX = JSON.parse(response);
                    if(AX.val == 1)
                      //  $("#notification").html("<div class='container'><h5>Enviando mensaje</h5><div class='col l4 offset-l4 progress'><div class='indeterminate'></div></div></div>");
                    //else
                        $("#notification").html("<div style='display:none;'></div>");
                    $.alert({
                        title:"Estado del envio: ",
                        content:AX.msg,
                        icon:"fas fa-info fa-2x",
                        type:tipoAlerts[AX.val],
                        theme:"material",
                        boxWidth: '100px',
                        onDestroy:function(){
                            if(AX.val == 1){
                                window.location.reload();
                            }
                            else{
                                window.location.reload();
                            }
                        }
                    }); 
 
                    /*if(AX.val == 1){
                        //M.toast({html: AX.msg, classes: 'rounded green'});
                        //window.location.reload();
                        M.modal
                    }
                    else{
                        //M.toast({html: AX.msg , classes: 'rounded red'});
                    }*/
                }  
            });
        }
    }
    
    function isNotEmpty(caller){
        if (caller.val() == ''){
            caller.css('border', '1px solid red');
            return false;
        } else 
            caller.css('border', '');
        return true;
    }

    document.getElementById('sent').addEventListener("click", sendemail);
});