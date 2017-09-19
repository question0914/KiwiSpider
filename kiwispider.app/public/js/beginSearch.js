/**
 * Created by zijianli on 8/2/17.
 */
$('#switchLkedin').click(function(){
    // if($("#linkedin_switch").hide()){
    //     $("#linkedin_switch").show();
    // }else{
    //     $("#linkedin_switch").hide();
    // }
    $("#linkedin_switch").toggle();

});


$('#ref').click(function(){
    $.ajax({

        type:'GET',
        url:'./refresh.php',
        data:{},
        success:function($response){
            drawTable($response);



        }
    });
});

function del(id){
    // alert(id);
    $.ajax({
        type:'GET',
        url:'./delete.php',
        data:{id:decodeURI(id)},

        success:function($response){
            drawTable($response);

        }




    });

}


function subString(s){
    ss=s.substr(0,4);
    ss+="-";
    ss+=s.substr(4,2);
    ss+="-";
    ss+=s.substr(6,2);
    return ss;
}

function drawTable($response){

    var responseData=JSON.parse($response);
    var response = responseData[0];
    var people = responseData[1];
    var cellCount=response.length;

    var htmltext="<div class='row'><h4>Search Queue</h4></div><center><table border='1' width='800' style='border-color: black'><tbody><tr ><th width='800'>Date</th><th width='800'>Keyword</th><th width='800'>Location</th><th width='800'>From</th><th width='800'>Status</th><th width='800'>People</th><th width='800'>Result</th><th width='800'>Send to salesforce</th><th width='200'>Delete</th></tr>";

    for(var i=0;i<cellCount;i++){
        if(response[i][5]=='0'){

            htmltext+="<tr>";
            htmltext+="<td width='800'>";
            htmltext+=subString(response[i][0]);
            htmltext+="</td>";
            for(var j=1;j<5;j++){

                htmltext+="<td width='800'>";
                htmltext+=response[i][j];
                htmltext+="</td>";
            }
            htmltext+="<td width='800'>"
            htmltext+=people[i];
            htmltext+="</td>";
            var resultUrl= encodeURI("./result.html?id="+response[i][0]+"&status="+response[i][4]+"&from="+response[i][3]);

            htmltext+="<td width='800'><a target='_blank' href='"+resultUrl+"'>result</a></td>";
            htmltext+="<td><a href='https://na35.salesforce.com/home/home.jsp' target='_blank'>salesforce</a></td>";
            htmltext+="<td><button onclick=del('";
            htmltext+=encodeURI(response[i][0]);
            htmltext+="')>delete</button></td></tr>";
            // htmltext+="<td><button class='del'>delete</button></td></tr>";

        }


    }
    htmltext+="</tbody></table></center>";
    $('#appendArea').html(htmltext);

    // alert('draw');

}


$(document).ready(function() {
    $.ajax({

        type:'GET',
        url:'./refresh.php',
        data:{},
        success:function($response){
            drawTable($response);
        }
    });

});


$('#sub').click(function(){
    var title=$('#title').val();
    var city=$('#city').val();
    var count=$('#count').val();
    var searchFrom = $('#searchChoice').val();
    var linkedin_email = $('#linkedin_email').val();
    var linkedin_password = $('#linkedin_password').val();

    $.ajax({

        type:'GET',
        url:'./searchQ.php',
        data:{title:title,city:city,count:count,searchFrom:searchFrom,linkedin_email:linkedin_email,linkedin_password:linkedin_password},
        success:function($response){
            drawTable($response);
        }

    });

});



$(document).ready(function () {
    $('.registration-form fieldset:first-child').fadeIn('slow');

    $('.registration-form input[type="text"]').on('focus', function () {
        $(this).removeClass('input-error');
    });

    // next step
    $('.registration-form .btn-next').on('click', function () {
        var parent_fieldset = $(this).parents('fieldset');
        var next_step = true;

        parent_fieldset.find('input[type="text"],input[type="email"]').each(function () {
            if ($(this).val() == "") {
                $(this).addClass('input-error');
                next_step = false;
            } else {
                $(this).removeClass('input-error');
            }
        });

        if (next_step) {
            parent_fieldset.fadeOut(400, function () {
                $(this).next().fadeIn();
            });
        }

    });

    // previous step
    $('.registration-form .btn-previous').on('click', function () {
        $(this).parents('fieldset').fadeOut(400, function () {
            $(this).prev().fadeIn();
        });
    });

    // submit
    $('.registration-form').on('submit', function (e) {

        $(this).find('input[type="text"],input[type="email"]').each(function () {
            if ($(this).val() == "") {
                e.preventDefault();
                $(this).addClass('input-error');
            } else {
                $(this).removeClass('input-error');
            }
        });

    });


});










