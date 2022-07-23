
var arg = {
    resultFunction: function(result) {
        
        var redirect = 'index.php?pg=logine';

        $.redirectPost(redirect, {id: result.code});
    }
};

var decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
decoder.buildSelectMenu("select");
decoder.play();
  /*  Without visible select menu
      decoder.buildSelectMenu(document.createElement('select'), 'environment|back').init(arg).play();
  */
$('select').on('change', function(){
    decoder.stop().play();
});

// jquery extend function
$.extend(
{
    redirectPost: function(location, args)
    {
        var form = '';
        $.each( args, function( key, value ) {
            form += '<input type="hidden" name="'+key+'" value="'+value+'">';
        });
        $('<form action="'+location+'" method="POST">'+form+'</form>').appendTo('body').submit();
    }
});
