!function(t){var e={};function i(n){if(e[n])return e[n].exports;var o=e[n]={i:n,l:!1,exports:{}};return t[n].call(o.exports,o,o.exports,i),o.l=!0,o.exports}i.m=t,i.c=e,i.d=function(t,e,n){i.o(t,e)||Object.defineProperty(t,e,{configurable:!1,enumerable:!0,get:n})},i.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return i.d(e,"a",e),e},i.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},i.p="/",i(i.s=37)}({37:function(t,e,i){t.exports=i(38)},38:function(t,e){$(document).ready(function(){function t(t){var e=t.split(":");return e.length>1?60*e[0]+ +e[1]:0}function e(t){function e(t){return(t<10?"0":"")+t}return e(t/60|0)+":"+e(t%60)}$("form").not("#timesheet_form").submit(function(t){$("#modalLoading").modal({backdrop:"static",keyboard:!1})}),$("#flash-message").fadeOut(5e3),$(".date-picker").datepicker({format:"dd/mm/yyyy"});$(".hour-start").change(function(){var t=$(this).attr("id").split("_"),i=t[2],n=$("#"+t[0]+"_end_"+i);n.prop("disabled",!1).empty();n.append('<option value="">-</option>');for(var o=$(this).val(),a=Number(o)+15;a<=1425;a+=15){var c='<option value="'+a+'">'+e(a)+"</option>";$(n).append(c)}}),$(".hour-end").change(function(){var n=$(this).attr("id").split("_"),o=Number(n[2]),a=o+1,c=$("#"+n[0]+"_start_"+a);if(c.length>0){c.prop("disabled",!1).empty(),$("#"+n[0]+"_hours_"+a).val(""),$("#"+n[0]+"_end_"+a).val("");c.append('<option value="">-</option>');for(var l=$(this).val(),r=Number(l);r<=1425;r+=15){var s='<option value="'+r+'">'+e(r)+"</option>";c.append(s)}}var d=$("#"+n[0]+"_hours_"+o),h=Number($("#"+n[0]+"_start_"+o).val()),p=Number($(this).val()),u=1===o&&"sat"!==n[0]?15:0;d.val(p-h-u>0?e(p-h-u):"");var v=$("#"+n[0]+"_hours_1").val(),m=$("#"+n[0]+"_hours_2").val(),f=$("#"+n[0]+"_hours_3").val(),_=$("#"+n[0]+"_hours_4").val();v=t(v),m=t(m),f=t(f),_=t(_),$("#"+n[0]+"_15").val(""),$("#"+n[0]+"_20").val("");var b=v+m+f+_;$("#"+n[0]+"_total").val(e(b));var w,y=0,g=0,k=$("#job"+n[0].charAt(0).toUpperCase()+n[0].slice(1)+o).val();b>480&&"sat"!==n[0]&&(y=Math.min(120,b-480)),(b>600||"sat"==n[0])&&("sat"==n[0]?g=b:"pld"!==k&&(g=b-480-120)),w=b-y-g,$("#"+n[0]+"_15").val(e(y)),$("#"+n[0]+"_20").val(e(g)),$("#"+n[0]+"_nor").val(e(w)),i()});var i=function(){var i=0;$(".horNormal").each(function(){i+=t($(this).val())}),$("#totalNormal").val(e(i));var n=0;$(".hours-total").each(function(){n+=t($(this).val())}),$("#totalWeek").val(e(n));var o=0;$(".hor15").each(function(){o+=t($(this).val())}),$("#total15").val(e(o));var a=0;$(".hor20").each(function(){a+=t($(this).val())}),$("#total20").val(e(a))};$("#btnPreFill").click(function(){$("input, select").not("#preStart, #preEnd, #output, #empDate, #preJob, #PreNormal, #Pre15, #Pre20, #preHours, #btnClearSign, #status, #output, #week_end, #empname, select[name=pld], select[name=rdo], select[name=anl], input[name=employee_id], .btnClear, input[type=hidden], .btn, #preJob_description, #job_description").val("");var t=$("#preEnd").val();$(".end-1").not("#sat_end_1").val(t);var e=$("#preStart").val();$(".start-1").not("#sat_start_1").val(e);var i=$("#preJob").val();$(".job-1").not("#sat_job_1").val(i);var n=$("#preJob_description").val();$(".job_description_1").not("#sat_job_1_description").val(n),$(".end-1").not("#sat_end_1").trigger("change")}),$(".job").change(function(){"sick"==$(this).val()&&alert("You have to attach a medical certificate at the end of this Time Sheet or this day won't be paid!")}),$(".job, #preJob").change(function(){"001"!=$(this).val()&&"002"!=$(this).val()||($("#modalDescription").modal({backdrop:"static",keyboard:!1}),$("#description_destination").val(this.id))}),$("#btnSaveDescription").click(function(){var t=$("#description_destination").val(),e=$("#job_description").val();$("#"+t+"_description").val(e),$("#modalDescription").modal("hide")}),$("#modalDescription").on("hidden.bs.modal",function(t){var e=$("#job_description").val(),i=$("#description_destination").val();""==e&&$("#"+i).val("")}),$(".btnClear").click(function(){$("."+this.id).val(""),$("."+this.id).trigger("change")});$(document).on("change","input[type=file]",function(){!function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:600,i=$(t).prop("name"),n=$("[id*='"+i+"_img']"),o=$("[id*='"+i+"_hidden']");if(t.files&&t.files[0]){var a=new FileReader;a.onload=function(t){var i=new Image;i.onload=function(){var t=document.createElement("canvas"),a=t.getContext("2d");for(t.width=i.width,t.height=i.height,a.drawImage(i,0,0);.5*t.width>e;)t.width*=.5,t.height*=.5,a.drawImage(t,0,0,t.width,t.height);t.width=e,t.height=t.width*i.height/i.width,a.drawImage(i,0,0,t.width,t.height),n.attr("src",t.toDataURL()).show(),o.val(t.toDataURL())},i.src=t.target.result},a.readAsDataURL(t.files[0])}}(this)}),$(document).on("click",".delCert",function(){var t=$(this).prop("id").split("-");if("medical_certificates[1]"==t[0]){var e=$("[id*='"+t[0]+"_img']"),i=$("[name*='"+t[0]+"']"),o=$("[id*='"+t[0]+"_hidden']");e.attr("src","").hide(),o.val(""),i.val("")}else n--,$("[id*='"+t[0]+"_row']").remove()});var n=1;$("#addCert").click(function(){var t='\n        <div class="alert alert-secondary" id="medical_certificates['+ ++n+']_row">\n            <h5 style="text-align: center;">Certificate '+n+'</h5>\n            <div class="input-group col-12 mb-3">\n              <div class="custom-file" id="medical_certificates_list">\n                <input type="file" class="custom-file-input medical_certificates" id="medical_certificates['+n+']" name="medical_certificates['+n+']"/>\n                <label class="custom-file-label" for="medical_certificates['+n+']">Choose files</label>\n              </div>\n            </div>\n            <div class="input-group col-12 mb-3">\n                <img id="medical_certificates['+n+']_img" class="img-fluid" style="">\n            </div>\n            <input id="medical_certificates['+n+']-delete" type="button" class="btn btn-danger btn-sm ml-2 delCert" value="Delete">\n            <input type="hidden" class="custom-file-input" id="medical_certificates['+n+']_hidden" name="medical_certificates['+n+']_hidden" value="">\n        </div>';$("#aditional_certificates").append(t)}),$("#timesheet_form").on("submit",function(t){var e=!0,i=[1,2,3,4];if(($.each([{description:"Monday",short:"mon"},{description:"Tuesday",short:"tue"},{description:"Wednesday",short:"wed"},{description:"Thursday",short:"thu"},{description:"Friday",short:"fri"},{description:"Saturday",short:"sat"}],function(n,o){$.each(i,function(i,n){var a=$("#"+o.short+"_start_"+n).val(),c=$("#"+o.short+"_end_"+n).val(),l=$("#"+o.short+"_job_"+n).val(),r=$("#"+o.short+"_hours_"+n).val();return""!==r&&(""===a&&""===c||""===l)||""!==a&&(""===c||""===l||""===r)||""!==c&&(""===a||""===l||""===r)?(e=!1,t.preventDefault(),alert("Select start, end time and job "+n+" for "+o.description),$("#"+o.short+"_job_"+n).focus(),!1):l.length>0&&(0===a.length||0===c.length||"0"===a&&"0"===c)?(e=!1,t.preventDefault(),alert("Select start, end time and job "+n+" for "+o.description),$("#"+o.short+"_job_"+n).focus(),!1):void 0})}),"00:00"==$("#totalWeek").val())&&0==confirm("The total of hours of this Time Sheet is 00:00, are you sure you want to continue ?"))return e=!1,t.preventDefault(),!1;e&&$("#modalLoading").modal({backdrop:"static",keyboard:!1})}),$("#chkRow").click(function(){var t=$("input[type=checkbox]").not(this);t.prop("checked",!t.prop("checked"))}),$("#btnPrint").click(function(){if($("input[type=checkbox]:checked").not("#chkRow").length>0){var t=Array();$("input[type=checkbox]:checked").not("#chkRow").each(function(){t.push(this.id.split("-")[1])});var e=window.location.href.split("/");"timesheets"==e[e.length-1]?window.open(window.location.href+"/action/"+t.join(",")+"/print","_blank"):window.open(window.location.href.replace(/\/[^\/]*$/,"/action/"+t.join(",")+"/print","_blank"))}}),$("#btnDelete").click(function(){if($("input[type=checkbox]:checked").not("#chkRow").length>0){var t=window.location.pathname+"/action/",e=Array();$("input[type=checkbox]:checked").not("#chkRow").each(function(){e.push(this.id.split("-")[1])}),1==confirm("Are you sure you want to delete following documents: "+e+"?")&&$(location).attr("href",t+e.join(",")+"/delete")}}),$(".delete").click(function(){1==confirm("Are you sure you want to delete this document (#"+$(this).attr("id")+")?")&&$(location).attr("href",window.location.pathname+"/action/"+$(this).attr("id")+"/delete")}),$("#btnStatus").click(function(){$("input[type=checkbox]:checked").not("#chkRow").length>0&&$("#modalChangeStatus").modal("show")}),$("#selectStatus").change(function(){var t=window.location.href.split("/");"timesheets"==t[t.length-1]?window.location+="/"+$(this).val():window.location=window.location.href.replace(/\/[^\/]*$/,"/"+$(this).val())}),$("#btnSaveStatus").click(function(){if($("input[type=checkbox]:checked").not("#chkRow").length>0){var t=Array(),e=$("select[name=changeStatus]").val();$("input[type=checkbox]:checked").not("#chkRow").each(function(){t.push(this.id.split("-")[1])});var i=window.location.href.split("/");"timesheets"==i[i.length-1]?window.location+="/action/"+t.join(",")+"/update/"+e:window.location=window.location.href.replace(/\/[^\/]*$/,"/action/"+t.join(",")+"/update/"+e)}});var o=[];$(document).on("click",".btn-select",function(){-1===o.indexOf(this.id.toString())&&(o.push(this.id),jQuery("#emp-"+this.id).detach().appendTo("#selecteds"),$(this).removeClass("btn-success btn-select").addClass("btn-danger btn-remove").text("Remove"),$("#countSelecteds").text("("+o.length+")")),console.log(o)}),$(document).on("click",".btn-remove",function(){1==confirm("Are you sure you want to unselect this employee?")&&(jQuery("#emp-"+this.id).remove(),o.splice(o.indexOf(this.id),1),$("#countSelecteds").text("("+o.length+")"),console.log(o))}),$("#btn-continue").click(function(){o.length>0&&(window.location="create/"+o.join(","))}),$("#btnSearch").click(function(){$("#employee").empty();var t=$("#search").val(),e=window.location.pathname.replace("timesheets/select","");$.ajax({url:e+"api/employees/"+t,type:"GET",dataType:"json"}).done(function(t){$.each(t,function(t,e){var i='\n\n                      <div id="emp-'+e.id+'" class="active select-employee card '+(null===e.last_timesheet||void 0===e.last_timesheet?"":"bg-warning")+'">\n                        <div class="select-employee card-header" role="tab" id="heading-undefined">\n                        <div class="row">\n                          <div class="'+(null===e.last_timesheet||void 0===e.last_timesheet?"col-md-11 col-lg-11":"col-md-9 col-lg-9")+'">\n                            <h6>\n                                <a href="create/'+e.id+' " style="'+(null===e.last_timesheet||void 0===e.last_timesheet?"":"color: white;")+'">\n                                  <span> '+e.name+'</span>\n                                </a>\n                            </h6>\n                            <i style="'+(null===e.last_timesheet||void 0===e.last_timesheet?"display: none":"display: block;")+'">This employee already has a Time Sheet for this week   &#32;</i>\n                          </div>\n                          <div class="col-md-2 col-lg-2" style="'+(null===e.last_timesheet||void 0===e.last_timesheet?"display: none":"display: block;")+'">\n                            <a href="action/'+(null===e.last_timesheet||void 0===e.last_timesheet?"":e.last_timesheet)+'/print" class="btnAdd btn btn-primary" style="color: white;display:'+(null===e.last_timesheet||void 0===e.last_timesheet?"none":"block")+';" target="_blank">View Time Sheet</a>\n                          </div>\n\n                          <div class="col-md-1 col-lg-1 float-right" style="padding-left: 0px;">\n                            <button id="'+e.id+'" class="btn btn-success btn-select" style="'+(-1===o.indexOf(e.id.toString())?"":"display:none;")+'">Select</button>\n                          </div>\n                        </div>\n                      </div>';$("#employee").append(i)})}).fail(function(){console.log("error")})}),$("#btnEntitlements").click(function(){$("#modalUpdateEntitlements").modal("show")}),$(".btnPrintEmployee").click(function(){if($("input[type=checkbox]:checked").not("#chkRow").length>0){var t=Array();$("input[type=checkbox]:checked").not("#chkRow").each(function(){t.push(this.id.split("-")[1])});var e=window.location.href.split("/");"employees"==e[e.length-1]?window.open(window.location.href+"/action/"+t.join(",")+"/print/"+this.id,"_blank"):window.open(window.location.href.replace(/\/[^\/]*$/,"/action/"+t.join(",")+"/print/"+this.id,"_blank"))}})})}});