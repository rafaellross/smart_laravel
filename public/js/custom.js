!function(t){var e={};function i(n){if(e[n])return e[n].exports;var a=e[n]={i:n,l:!1,exports:{}};return t[n].call(a.exports,a,a.exports,i),a.l=!0,a.exports}i.m=t,i.c=e,i.d=function(t,e,n){i.o(t,e)||Object.defineProperty(t,e,{configurable:!1,enumerable:!0,get:n})},i.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return i.d(e,"a",e),e},i.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},i.p="/",i(i.s=37)}({37:function(t,e,i){t.exports=i(38)},38:function(t,e){$(document).ready(function(){function t(t){var e=t.split(":");return e.length>1?60*e[0]+ +e[1]:0}function e(t){function e(t){return(t<10?"0":"")+t}return e(t/60|0)+":"+e(t%60)}$("form").not("#timesheet_form").submit(function(t){$("#modalLoading").modal({backdrop:"static",keyboard:!1})}),$("#flash-message").fadeOut(5e3),$(".date-picker").datepicker({format:"dd/mm/yyyy"}),showExtra=function(t,e){$(e).css("display","block"),$(t).fadeOut()},$(".hour-start").change(function(){var t=$(this).attr("id").split("_"),i=t[2],n=$("#"+t[0]+"_end_"+i);n.prop("disabled",!1).empty();n.append('<option value="">-</option>');for(var a=$(this).val(),o=Number(a)+15;o<=1425;o+=15){var l='<option value="'+o+'">'+e(o)+"</option>";$(n).append(l)}}),$(".hour-end").change(function(){var i=$(this).attr("id").split("_"),n=Number(i[2]),a=n+1,o=$("#"+i[0]+"_start_"+a);if(o.length>0){o.prop("disabled",!1).empty(),$("#"+i[0]+"_hours_"+a).val(""),$("#"+i[0]+"_end_"+a).val("");o.append('<option value="">-</option>');for(var l=$(this).val(),c=Number(l);c<=1425;c+=15){var r='<option value="'+c+'">'+e(c)+"</option>";o.append(r)}}var s=$("#"+i[0]+"_hours_"+n),d=Number($("#"+i[0]+"_start_"+n).val()),h=Number($(this).val()),u=1===n&&"sat"!==i[0]?15:0;s.val(h-d-u>0?e(h-d-u):"");var p=$("#"+i[0]+"_hours_1").val(),m=$("#"+i[0]+"_hours_2").val(),v=$("#"+i[0]+"_hours_3").val(),f=$("#"+i[0]+"_hours_4").val();p=t(p),m=t(m),v=t(v),f=t(f),$("#"+i[0]+"_15").val(""),$("#"+i[0]+"_20").val("");var _=p+m+v+f;$("#"+i[0]+"_total").val(e(_));var b,w=0,g=0,y=$("#job"+i[0].charAt(0).toUpperCase()+i[0].slice(1)+n).val();_>480&&"sat"!==i[0]&&(w=Math.min(120,_-480)),(_>600||"sat"==i[0])&&("sat"==i[0]?g=_:"pld"!==y&&(g=_-480-120)),b=_-w-g,$("#"+i[0]+"_15").val(e(w)),$("#"+i[0]+"_20").val(e(g)),$("#"+i[0]+"_nor").val(e(b)),calcTotal()}),calcTotal=function(){var i=0;$(".horNormal").each(function(){i+=t($(this).val())}),$("#totalNormal").val(e(i));var n=0;$(".hours-total").each(function(){n+=t($(this).val())}),$("#totalWeek").val(e(n));var a=0;$(".hor15").each(function(){a+=t($(this).val())}),$("#total15").val(e(a));var o=0;$(".hor20").each(function(){o+=t($(this).val())}),$("#total20").val(e(o))},$("#btnPreFill").click(function(){$("input, select").not("#preStart, #preEnd, #output, #empDate, #preJob, #PreNormal, #Pre15, #Pre20, #preHours, #btnClearSign, #status, #output, #week_end, #empname, select[name=pld], select[name=rdo], select[name=anl], input[name=employee_id], .btnClear, input[type=hidden], .btn").val("");var t=$("#preEnd").val();$(".end-1").not("#sat_end_1").val(t);var e=$("#preStart").val();$(".start-1").not("#sat_start_1").val(e);var i=$("#preJob").val();$(".job-1").not("#sat_job_1").val(i),$(".end-1").not("#sat_end_1").trigger("change")}),$(".job").change(function(){"sick"==$(this).val()&&alert("You have to attach a medical certificate at the end of this Time Sheet or this day won't be paid!")}),$(".btnClear").click(function(){$("."+this.id).val(""),$("."+this.id).trigger("change")});$(document).on("change","input[type=file]",function(){!function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:600,i=$(t).prop("name"),n=$("[id*='"+i+"_img']"),a=$("[id*='"+i+"_hidden']");if(t.files&&t.files[0]){var o=new FileReader;o.onload=function(t){var i=new Image;i.onload=function(){var t=document.createElement("canvas"),o=t.getContext("2d");for(t.width=i.width,t.height=i.height,o.drawImage(i,0,0);.5*t.width>e;)t.width*=.5,t.height*=.5,o.drawImage(t,0,0,t.width,t.height);t.width=e,t.height=t.width*i.height/i.width,o.drawImage(i,0,0,t.width,t.height),n.attr("src",t.toDataURL()).show(),a.val(t.toDataURL())},i.src=t.target.result},o.readAsDataURL(t.files[0])}}(this)}),$(document).on("click",".delCert",function(){var t=$(this).prop("id").split("-");if("medical_certificates[1]"==t[0]){var e=$("[id*='"+t[0]+"_img']"),n=$("[name*='"+t[0]+"']"),a=$("[id*='"+t[0]+"_hidden']");e.attr("src","").hide(),a.val(""),n.val("")}else i--,$("[id*='"+t[0]+"_row']").remove()});var i=1;$("#addCert").click(function(){var t='\n        <div class="alert alert-secondary" id="medical_certificates['+ ++i+']_row">                          \n            <h5 style="text-align: center;">Certificate '+i+'</h5>          \n            <div class="input-group col-12 mb-3">\n              <div class="custom-file" id="medical_certificates_list">\n                <input type="file" class="custom-file-input medical_certificates" id="medical_certificates['+i+']" name="medical_certificates['+i+']"/>                        \n                <label class="custom-file-label" for="medical_certificates['+i+']">Choose files</label>\n              </div>\n            </div>\n            <div class="input-group col-12 mb-3">\n                <img id="medical_certificates['+i+']_img" class="img-fluid" style="">\n            </div>   \n            <input id="medical_certificates['+i+']-delete" type="button" class="btn btn-danger btn-sm ml-2 delCert" value="Delete">\n            <input type="hidden" class="custom-file-input" id="medical_certificates['+i+']_hidden" name="medical_certificates['+i+']_hidden" value="">                        \n        </div>';$("#aditional_certificates").append(t)}),$("#timesheet_form").on("submit",function(t){var e=!0,i=[1,2,3,4];$.each([{description:"Monday",short:"mon"},{description:"Tuesday",short:"tue"},{description:"Wednesday",short:"wed"},{description:"Thursday",short:"thu"},{description:"Friday",short:"fri"},{description:"Saturday",short:"sat"}],function(n,a){$.each(i,function(i,n){var o=$("#"+a.short+"_start_"+n).val(),l=$("#"+a.short+"_end_"+n).val(),c=$("#"+a.short+"_job_"+n).val(),r=$("#"+a.short+"_hours_"+n).val();return""!==r&&(""===o&&""===l||""===c)||""!==o&&(""===l||""===c||""===r)||""!==l&&(""===o||""===c||""===r)?(e=!1,t.preventDefault(),alert("Select start, end time and job "+n+" for "+a.description),$("#"+a.short+"_job_"+n).focus(),!1):c.length>0&&(0===o.length||0===l.length||"0"===o&&"0"===l)?(e=!1,t.preventDefault(),alert("Select start, end time and job "+n+" for "+a.description),$("#"+a.short+"_job_"+n).focus(),!1):void 0})}),e&&($("#modalLoading").modal({backdrop:"static",keyboard:!1}),$("#modalLoading").modal("show"))}),$("#chkRow").click(function(){var t=$("input[type=checkbox]").not(this);t.prop("checked",!t.prop("checked"))}),$("#btnPrint").click(function(){if($("input[type=checkbox]:checked").not("#chkRow").length>0){var t=Array();$("input[type=checkbox]:checked").not("#chkRow").each(function(){t.push(this.id.split("-")[1])});var e=window.location.href.split("/");"timesheets"==e[e.length-1]?window.open(window.location.href+"/action/"+t.join(",")+"/print","_blank"):window.open(window.location.href.replace(/\/[^\/]*$/,"/action/"+t.join(",")+"/print","_blank"))}}),$("#btnDelete").click(function(){if($("input[type=checkbox]:checked").not("#chkRow").length>0){var t=window.location.pathname+"/action/",e=Array();$("input[type=checkbox]:checked").not("#chkRow").each(function(){e.push(this.id.split("-")[1])}),1==confirm("Are you sure you want to delete following documents: "+e+"?")&&$(location).attr("href",t+e.join(",")+"/delete")}}),$(".delete").click(function(){1==confirm("Are you sure you want to delete this document (#"+$(this).attr("id")+")?")&&$(location).attr("href",window.location.pathname+"/action/"+$(this).attr("id")+"/delete")}),$("#btnStatus").click(function(){$("input[type=checkbox]:checked").not("#chkRow").length>0&&$("#modalChangeStatus").modal("show")}),$("#selectStatus").change(function(){var t=window.location.href.split("/");"timesheets"==t[t.length-1]?window.location+="/"+$(this).val():window.location=window.location.href.replace(/\/[^\/]*$/,"/"+$(this).val())}),$("#btnSaveStatus").click(function(){if($("input[type=checkbox]:checked").not("#chkRow").length>0){var t=Array(),e=$("select[name=changeStatus]").val();$("input[type=checkbox]:checked").not("#chkRow").each(function(){t.push(this.id.split("-")[1])});var i=window.location.href.split("/");"timesheets"==i[i.length-1]?window.location+="/action/"+t.join(",")+"/update/"+e:window.location=window.location.href.replace(/\/[^\/]*$/,"/action/"+t.join(",")+"/update/"+e)}});var n=[];$(document).on("click",".btn-select",function(){-1===n.indexOf(this.id.toString())&&(n.push(this.id),jQuery("#emp-"+this.id).detach().appendTo("#selecteds"),$(this).removeClass("btn-success btn-select").addClass("btn-danger btn-remove").text("Remove"),$("#countSelecteds").text("("+n.length+")")),console.log(n)}),$(document).on("click",".btn-remove",function(){1==confirm("Are you sure you want to unselect this employee?")&&(jQuery("#emp-"+this.id).remove(),n.splice(n.indexOf(this.id),1),$("#countSelecteds").text("("+n.length+")"),console.log(n))}),$("#btn-continue").click(function(){n.length>0&&(window.location="create/"+n.join(","))}),$("#btnSearch").click(function(){$("#employee").empty();var t=$("#search").val(),e=window.location.pathname.replace("timesheets/select","");$.ajax({url:e+"api/employees/"+t,type:"GET",dataType:"json"}).done(function(t){$.each(t,function(t,e){var i='\n\n                      <div id="emp-'+e.id+'" class="active select-employee card '+(null===e.last_timesheet||void 0===e.last_timesheet?"":"bg-warning")+'">\n                        <div class="select-employee card-header" role="tab" id="heading-undefined">\n                        <div class="row">\n                          <div class="'+(null===e.last_timesheet||void 0===e.last_timesheet?"col-md-11 col-lg-11":"col-md-9 col-lg-9")+'">\n                            <h6>                            \n                                <a href="create/'+e.id+' " style="'+(null===e.last_timesheet||void 0===e.last_timesheet?"":"color: white;")+'">\n                                  <span> '+e.name+'</span>\n                                </a>\n                            </h6>\n                            <i style="'+(null===e.last_timesheet||void 0===e.last_timesheet?"display: none":"display: block;")+'">This employee already have a Time Sheet for this week   &#32;</i>\n                          </div>\n                          <div class="col-md-2 col-lg-2" style="'+(null===e.last_timesheet||void 0===e.last_timesheet?"display: none":"display: block;")+'">                            \n                            <a href="action/'+(null===e.last_timesheet||void 0===e.last_timesheet?"":e.last_timesheet)+'/print" class="btnAdd btn btn-primary" style="color: white;display:'+(null===e.last_timesheet||void 0===e.last_timesheet?"none":"block")+';" target="_blank">View Time Sheet</a>\n                          </div>\n\n                          <div class="col-md-1 col-lg-1 float-right" style="padding-left: 0px;">                                                            \n                            <button id="'+e.id+'" class="btn btn-success btn-select" style="'+(-1===n.indexOf(e.id.toString())?"":"display:none;")+'">Select</button>                              \n                          </div>                        \n                        </div>\n                      </div>';$("#employee").append(i)})}).fail(function(){console.log("error")})})})}});