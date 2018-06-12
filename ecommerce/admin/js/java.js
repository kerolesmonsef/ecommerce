var prevent=[false,false,false,false];
$('[placeholder]').focus(function(){
   //alert('kjl');
    $(this).attr('data-place',$(this).attr('placeholder'));
    $(this).attr('placeholder','');

}).blur(function(){
    $(this).attr('placeholder',$(this).attr('data-place'));
});
//$('#updatebtn').click(function(e){
//   e.preventDefault();
//});

$('.editform input').keyup(function(){
    checkvalidate($(this));
    if(prevent[0]==true||prevent[2]==true||prevent[3]==true||prevent[4]==true){
        $('#updatebtn').click(function(){
          $(this).unbind('click');
            $(this).click();
        });
    }
});

function checkvalidate(inp){
    var thename=inp.attr('name');
         if(thename=='username'){
        
        if(inp.val().search(/^(([a-zA-Z]){3,}[0-9]*)+$/,inp.val())>=0){
           inp.next().text('OK'),inp.next().removeClass('alert-danger'),inp.next().addClass('alert-success') ;
            prevent[0]=true;
        }
        else if(inp.val().search( /^[0-9]+$/, inp.val())>=0){
            inp.next().text('Name must star with charrecetrs'),inp.next().removeClass('alert-success'),inp.next().addClass('alert-danger');prevent[0]=false;
        }
         else if(inp.val().search( /^[a-zA-Z]{1,2}[0-9]*$/, inp.val())>=0){
            inp.next().text('Name must star at lest with 3 charrecetrs'),inp.next().removeClass('alert-success'),inp.next().addClass('alert-danger');prevent[0]=false;
        }
          else //(inp.val().search(/^(([0-9]*[a-z]){1,2})+$/,inp.val())>=0)
          {
            inp.next().text('Incorrect user name'),inp.next().removeClass('alert-success'),inp.next().addClass('alert-danger');prevent[0]=false;
        }
    }
    else if(thename=='password'){
        if(inp.val().search(/^(([A-Z]*[0-9]*[A-Z]*[a-z][A-Z]*[0-9]*[A-Z]*){3,})+$/)>=0 && inp.val().search(/[a-z0-9]*[A-Z][a-z0-9]*[A-Z][a-z0-9]*/)>=0){
           inp.next().text('OK'),inp.next().removeClass('alert-danger'),inp.next().addClass('alert-success');
            prevent[1]=true;
        }
        else if(inp.val().search(/^(([0-9]*))+$/)>=0){
            inp.next().text('It Must Contain at lest 3 chars'),inp.next().removeClass('alert-success'),inp.next().addClass('alert-danger');prevent[1]=false;
        }
        else if(inp.val().search(/[A-Z]*/)>=0 && inp.val().search(/([A-Z]*[0-9]*[A-Z]*[a-z][A-Z]*[0-9]*[A-Z]*){3,}/)>=0){
             inp.next().text('It Must Contain at lest 2 Capital chars'),inp.next().removeClass('alert-success'),inp.next().addClass('alert-danger');prevent[1]=false;
        }
          else //(inp.val().search(/^(([0-9]*[a-z]){1,2})+$/,inp.val())>=0)
          {
            inp.next().text('charecter are too many'),inp.next().removeClass('alert-success'),inp.next().addClass('alert-danger');prevent[1]=false;
        }

    }
    else if(thename=='email')   {
        
        if(inp.val().search(/^.+@.+\..+$/,inp.val())>=0){
           inp.next().text('OK'),inp.next().removeClass('alert-danger'),inp.next().addClass('alert-success') ;
            prevent[2]=true;
        }
        else if(inp.val().search( /@/, inp.val())<0){
            inp.next().text('your email must contain @'),inp.next().removeClass('alert-success'),inp.next().addClass('alert-danger');prevent[2]=false;
        }
         else if(inp.val().search( /^.+@\..+$/, inp.val())>=0){
            inp.next().text('email must has a domain like gmail,yahooo.....'),inp.next().removeClass('alert-success'),inp.next().addClass('alert-danger');prevent[2]=false;
       }
          else //(inp.val().search(/^(([0-9]*[a-z]){1,2})+$/,inp.val())>=0)
          {
            inp.next().text('Incorrect Email'),inp.next().removeClass('alert-success'),inp.next().addClass('alert-danger');prevent[2]=false;
        }
    }
    else if(thename=='fallname'){
        if(inp.val().search(/ /)>=0&&inp.val().search(/[a-zA-Z]{2,} [a-zA-Z]{2,}/)>=0){
           inp.next().text('OK'),inp.next().removeClass('alert-danger'),inp.next().addClass('alert-success') ;
            prevent[3]=true;
        }
        else{
            inp.next().text('at least 10 chars'),inp.next().removeClass('alert-success'),inp.next().addClass('alert-danger');
            prevent[3]=false;
        }
    } 
    console.log(inp);
}
checkvalidate($('.editform input').eq(0));
checkvalidate($('.editform input').eq(1));
checkvalidate($('.editform input').eq(2));
checkvalidate($('.editform input').eq(3));

if(prevent[0]==false||prevent[2]==false||prevent[3]==false||prevent[4]==false)
   {
   $('#updatebtn').click(function(e){
       e.preventDefault(false);
   })
   }
function showpass(){
    var show=true;
    $('.show-pass').click(function(){
        //alert();
        if(show)
        $('.editform input').eq(1).attr('type','text'),show=false,$(this).removeClass('fa-eye-slash'),$(this).addClass('fa-eye');
        else if(!show)
        $('.editform input').eq(1).attr('type','password'),show=true,$(this).removeClass('fa-eye'),$(this).addClass('fa-eye-slash');
    });
}
showpass();
$('.confirm').click(function(){
   return confirm('Are You Sure. ! ');
});

$('.cat').hover(function(){
   $(this).children(".edit-del-div").animate({
       right:"10"
   },"fast");
},function(){
   $(this).children(".edit-del-div").animate({
       right:"-125"
   },"fast");
}); 

$('.full-showing').click(function(){
   $('.under-btn-del-up').removeClass('dont-show'); 
});

$('.classic-showing').click(function(){
   $('.under-btn-del-up').addClass('dont-show'); 
});
$('.cat').click(function(){
   if($('.under-btn-del-up').hasClass('dont-show')) {
       $(this).children('.under-btn-del-up').toggleClass('dont-show');
   }
});