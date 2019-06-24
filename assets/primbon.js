$(document).ready(function() {
    $('form').submit(function(e){
        e.preventDefault();// to stop form submitting
    });

    $("#submit").click(function(){
        
        date1 = $('#date1').val();
        date2 = $('#date2').val();
        var dateArray1 = date1.split("-");
        var dateArray2 = date2.split("-");

        var data={
            'nama1':$('#nama1').val(),
            'tgl1':dateArray1[2],
            'bln1':dateArray1[1],
            'thn1':dateArray1[0],
            'nama2':$('#nama2').val(),
            'tgl2':dateArray2[2],
            'bln2':dateArray2[1],
            'thn2':dateArray2[0],
        };

        $.ajax({
            url: "primbonApi.php",
            method: "POST",
            data: data,
            beforeSend: function( xhr ) {
                $("#submit").attr("disabled", true);
                $( "#loadContainer" ).show();
                console.log("start ajax");
            }
        })
        .done(function(data, status ) {
            console.log(data);
            console.log(status);
            if(data.error == "false"){	
                $( ".fromAjax" ).append( "<p>"+data.data[0].text1+"</p>" );
                $( ".fromAjax" ).append( "<p>"+data.data[0].text2+"</p>" );
                $( ".fromAjax" ).append( "<p>"+data.data[0].text3+"</p>" );
                $( ".fromAjax" ).append( "<p>"+data.data[0].text4+"</p>" );
                $( ".fromAjax" ).append( "<p>"+data.data[0].text5+"</p>" );
                $( ".fromAjax" ).append( "<p>"+data.data[0].text6+"</p>" );
                $('#showModal').click();
            }else{
                alert(data.message);
            }
            $("#submit").attr("disabled", false);
            $( "#loadContainer" ).hide();
        });
    });

    $('#closeModal').click(function(){
        $('#nama1').val("");
        $('#nama2').val("");
        $( ".fromAjax" ).empty();
    });
});