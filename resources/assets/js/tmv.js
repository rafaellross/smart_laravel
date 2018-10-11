$(document).ready(function() {


  //Endorsed by 1
  $("#div_endorsed1_sig").jSignature();

  if ($("input[name=hidden_endorsed1_sig]").val() !== "") {

    $('#div_endorsed1_sig').jSignature("setData", $("input[name=hidden_endorsed1_sig]").val());

  }


  //Serviceman 2
  $("#div_serviceman2_sig").jSignature();

  if ($("input[name=hidden_serviceman2_sig]").val() !== "") {

    $('#div_serviceman2_sig').jSignature("setData", $("input[name=hidden_serviceman2_sig]").val());

  }

  //Endorsed by 1
  $("#div_endorsed2_sig").jSignature();

  if ($("input[name=hidden_endorsed2_sig]").val() !== "") {

    $('#div_endorsed2_sig').jSignature("setData", $("input[name=hidden_endorsed2_sig]").val());

  }


  $('form').submit(function(){

      $("input[name=hidden_serviceman2_sig]").val($('#div_serviceman2_sig').jSignature("getData"));

      $("input[name=hidden_endorsed1_sig]").val($('#div_endorsed1_sig').jSignature("getData"));
      $("input[name=hidden_endorsed2_sig]").val($('#div_endorsed2_sig').jSignature("getData"));


  });




  $('.btn-clear-sign').click(function(){
      var $sigdiv = $("#" + this.id.replace("clear", "div", 1));
      $sigdiv.jSignature("reset"); // clears the canvas and rerenders the decor on it.
  });


});
