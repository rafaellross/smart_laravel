!function(e){var n={};function i(t){if(n[t])return n[t].exports;var r=n[t]={i:t,l:!1,exports:{}};return e[t].call(r.exports,r,r.exports,i),r.l=!0,r.exports}i.m=e,i.c=n,i.d=function(e,n,t){i.o(e,n)||Object.defineProperty(e,n,{configurable:!1,enumerable:!0,get:t})},i.n=function(e){var n=e&&e.__esModule?function(){return e.default}:function(){return e};return i.d(n,"a",n),n},i.o=function(e,n){return Object.prototype.hasOwnProperty.call(e,n)},i.p="/",i(i.s=8)}({8:function(e,n,i){e.exports=i(9)},9:function(e,n){$(document).ready(function(){$("#div_endorsed1_sig").jSignature(),""!==$("input[name=hidden_endorsed1_sig]").val()&&$("#div_endorsed1_sig").jSignature("setData",$("input[name=hidden_endorsed1_sig]").val()),$("#div_serviceman2_sig").jSignature(),""!==$("input[name=hidden_serviceman2_sig]").val()&&$("#div_serviceman2_sig").jSignature("setData",$("input[name=hidden_serviceman2_sig]").val()),$("#div_endorsed2_sig").jSignature(),""!==$("input[name=hidden_endorsed2_sig]").val()&&$("#div_endorsed2_sig").jSignature("setData",$("input[name=hidden_endorsed2_sig]").val()),$("form").submit(function(){$("input[name=hidden_serviceman2_sig]").val($("#div_serviceman2_sig").jSignature("getData")),$("input[name=hidden_endorsed1_sig]").val($("#div_endorsed1_sig").jSignature("getData")),$("input[name=hidden_endorsed2_sig]").val($("#div_endorsed2_sig").jSignature("getData"))}),$(".btn-clear-sign").click(function(){$("#"+this.id.replace("clear","div",1)).jSignature("reset")})})}});