$(document).ready(function(){
    let div = $('#div_signature_business');
    let hidden = $('input[name=business_signature_hidden]');
    div.jSignature({
      'decor-color': 'transparent',
    });

    if (hidden.val() !== "") {
        div.jSignature("setData", hidden.val());
    }


    $('.btn-clear-sign').click(function(){
        var $sigdiv = $("#" + this.id.replace("clear", "div", 1));
        $sigdiv.jSignature("reset") // clears the canvas and rerenders the decor on it.
    });

    $('form').submit(function(){
        hidden.val(div.jSignature("getData"));
    });
});
