// Ajax Validation
var baseurl = "https://yellowapricots.com/";

$(document).ready(function () {
    $("#contact-form").submit(function (e)
    {
        e.preventDefault();	//STOP default action
        $("#thank_you_msg").html("<img src='" + baseurl + "img/loading.gif' height='20px''/>");
        $('.prettyprint').html('');
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        $.ajax({
            url: formURL,
            type: "POST",
            data: postData,
            dataType: 'json',
            success: function (data, textStatus, jqXHR)
            {
                
                if (data.error == true) { // error part
                    var errors=data.display_errors;
                    $.each(errors,function(key,message){
                        console.log(key+' '+message);
                        $('#'+key).html(message);
                    });                                
                } else { // success
                    $("#thank_you_msg").html(`Thank You! We'll contact you shortly!`);
                    $('#contact-form')[0].reset();
                }
                //$('#thank_you_msg').html('');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert(errorThrown)
                $("#thank_you_msg").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus=' + textStatus + ', errorThrown=' + errorThrown + '</code></pre>');
            }
        });


    });

})