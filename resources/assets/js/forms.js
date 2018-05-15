$(document).ready(function() {


    let signatures = {    
        "signature_1" : {
            "div": "#div_signature_1",
            "modal": "#modal_signature_1",
            "hidden": "#img_signature_1",
            "opened": false
        }
    };


    for (var i = 1; i <= 20; i++) {
        signatures["signature_" + i] = {
            "div": "#div_signature_" + i,
            "modal": "#modal_signature_" + i,
            "hidden": "#img_signature_" + i,
            "opened": false            
        }
    }
    

    $('.btn-signature').click(function(){                    

        let modal   = $(signatures[this.id].modal);
        let div     = $(signatures[this.id].div);
        let hidden  = $(signatures[this.id].hidden);
        let opened  = signatures[this.id].opened;
        modal.modal('show');

        if (!signatures[this.id].opened) {            
            signatures[this.id].opened = true;
            div.jSignature(); // inits the jSignature widget.            
            if (hidden.val() !== "") {
                div.jSignature("setData", hidden.val());    
            }
            
            
        }      
    }); 


    $('.btn-save-sign').click(function() {
        var signature = this.id.replace("save", "");
        var div = $("#div" + signature);
        var img = div.jSignature("getData");        
        $('#preview' + signature).attr('src', img);                 
        $('#img' + signature).val(img);                 
        
    }); 

    // after some doodling...
    $('.btn-clear-sign').click(function(){
        var $sigdiv = $("#" + this.id.replace("clear", "div", 1));
        $sigdiv.jSignature("reset") // clears the canvas and rerenders the decor on it.
    });                                


    $('#btnPrintPreStart').click(function(){
        let selecteds = $("input[type=checkbox]:checked").not('#chkRow').length;
        if (selecteds > 0) {                            
            let ids = Array();
            $("input[type=checkbox]:checked").not('#chkRow').each(function(){
                ids.push(this.id.split("-")[1]);                    
            });
          let urlArray = window.location.href.split("/");
          if (urlArray[urlArray.length - 1] == "form_prestart") {
            window.open(window.location.href + "/action/" + ids.join(",") + "/print", '_blank');          
          } else {
            window.open(window.location.href.replace(/\/[^\/]*$/, '/action/' + ids.join(",") + "/print", '_blank'));  
          }            
        }
    });


});