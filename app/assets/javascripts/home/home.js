$(document).ready(function(){
    $('#btnRegistro').click(function(e){
       e.preventDefault();
        $.post($(this).parents('form').attr('action'),$(this).parents('form').serialize(),function(o){            
            if(o.login){
             window.location=o.url;   
            }else{
                $(".error").html(o.msg).removeClass('hidden');
                setTimeout(function(){
                $(".error").fadeOut(1000,function(){
                  $(".error").addClass('hidden');
                });
            },5000);
            }            
            
            //.delay(500).hide()
        },'json');
        
    });   
    
});