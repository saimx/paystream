function showResponse(msg,type='success'){
        if(type==='error'){
            $('.result-box').show('fast');
            $("#result").html(msg);
            $('.results-style, .result-box, .result').addClass('bg-red');
            $('.results-style, .result-box, .result').removeClass('bg-light-green');
            $('.result-text').text('Error');
            // $('.result-text').prepend('<i class="text-white fontello-cancel-circled"></i>');
            //
            
         }else{
            $('.result-box').show('fast');
            $("#result").html(msg);
            $('.results-style, .result-box, .result').removeClass('bg-red');
            $('.results-style, .result-box, .result').addClass('bg-light-green');
            $('.result-text').text('SUCCESS');
            // $('.result-text').prepend('<i class="text-white  icon-thumbs-up"></i>');
         }
    }