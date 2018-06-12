var canweshow = false;// if you want to show thim after update or delete or no
var showoneuser = false;// if you want to show thim after update or delete or no
function getrequest(mywantedpage, select,oneuser) {
    if (select)canweshow=true;
    else canweshow=false;
    if(oneuser)showoneuser=true;
    else showoneuser=false;
        var myRequest = new XMLHttpRequest();
        myRequest.onreadystatechange=GetDataFromPHP;
        myRequest.open('GET','classes/'+mywantedpage,true);//get the request
        myRequest.send();//send the request
    }
    function GetDataFromPHP(){
    var myformbody = document.querySelector('.tbody');
    var myul = document.getElementById('wanted-ul');
        if(this.readyState==4 && this.status==200){
            myformbody.innerHTML=this.responseText;
            if(showoneuser){
                myul.innerHTML=this.responseText;
            }
            if(canweshow==true){
                getrequest('select_dp.php',false,false);
            }//after insert
        }
        else if(this.readyState < 4 && this.readyState > 0) {
        myformbody.innerHTML="<img src='img/loading_spinner.gif'>";
            console.log('wait');
        }// if it going to done the reuest
        else if(this.status==404) console.log('error 404');// if he doesn't find the file
        else console.log('bad request');// if theres an error
        console.log(this.readyState);
}// check and get the data from php file
//getrequest('select_dp.php',false,false);

$('#submitbtn').click(function(event){
    event.preventDefault();
    var mydata='name='+$('#name').val()+'&pass='+$('#pass').val()+'&email='+$('#email').val();
    getrequest('insert_dp.php?'+mydata,true,true);
});


$('#reload').click(function(e){
   // debugger;
    getrequest('get_only_users.php',true,false);//false mean that use only select
});
function delete_dp ( id ) {
    if(confirm('Would You Want To Delete This Column. ?!!!'))
        getrequest('delete_dp.php?theid='+id,true,false);//true mean that after delete make select from dp
}
function update_dp(tid){
    var id=document.getElementById(tid+'id');
    var name=document.getElementById(tid+'name');
    var pass=document.getElementById(tid+'pass');
    var email=document.getElementById(tid+'email');
    
    $('#the_id').val(id.innerHTML);
    $('#name').val(name.innerHTML);
    $('#email').val(email.innerHTML);
    $('#pass').val(pass.innerHTML);
    $('#update_btn').hide(200);
    $('#update_btn').show('fast');
    $('#update_btn').text('Update Data '+id.innerHTML);

}
$('#update_btn').click(function(){
   var id=  $('#the_id').val();
   var name=  $('#name').val();
   var email=  $('#email').val();
   var pass=  $('#pass').val();
   var data='id='+id+'&name='+name+'&email='+email+'&pass='+pass;
    getrequest('update_dp.php?'+data,true,false);
});
function lastfunc(name){
    getrequest('select_last_user.php?id='+name,false,false);
}
//select_one-user
getrequest('get_only_users.php',true,true);


$(window).click(function(e){
    e.preventDefault();
});
