!function(t){var e={};function i(n){if(e[n])return e[n].exports;var a=e[n]={i:n,l:!1,exports:{}};return t[n].call(a.exports,a,a.exports,i),a.l=!0,a.exports}i.m=t,i.c=e,i.d=function(t,e,n){i.o(t,e)||Object.defineProperty(t,e,{configurable:!1,enumerable:!0,get:n})},i.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return i.d(e,"a",e),e},i.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},i.p="/",i(i.s=37)}({37:function(t,e,i){t.exports=i(38)},38:function(t,e){$(document).ready(function(){function t(t){var e=t.split(":");return e.length>1?60*e[0]+ +e[1]:0}function e(t){function e(t){return(t<10?"0":"")+t}return e(t/60|0)+":"+e(t%60)}$("form").not("#timesheet_form").submit(function(t){$("#modalLoading").modal({backdrop:"static",keyboard:!1})}),$("#flash-message").fadeOut(15e3),$(".date-picker").datepicker({format:"dd/mm/yyyy"}),showExtra=function(t,e){$(e).css("display","block"),$(t).fadeOut()},$(".hour-start").change(function(){var t=$(this).attr("id").split("_"),i=t[2],n=$("#"+t[0]+"_end_"+i);n.prop("disabled",!1).empty();n.append('<option value="">-</option>');for(var a=$("#group_"+t[0]+"_"+t[2]+"_night").is(":checked")?0:$(this).val(),o=Number(a);o<=1425;o+=15){var l='<option value="'+o+'">'+e(o)+"</option>";$(n).append(l)}}),$(".hour-end").change(function(){var i=arguments.length>0&&void 0!==arguments[0]&&arguments[0],n=$(this).attr("id").split("_"),a=Number(n[2]);if($("#group_"+n[0]+"_"+n[2]+"_night").is(":checked")&&!i)return!1;var o=a+1,l=$("#"+n[0]+"_start_"+o);if(l.length>0){l.prop("disabled",!1).empty(),$("#"+n[0]+"_hours_"+o).val(""),$("#"+n[0]+"_end_"+o).val("");l.append('<option value="">-</option>');for(var c=$(this).val(),s=Number(c);s<=1425;s+=15){var r='<option value="'+s+'">'+e(s)+"</option>";l.append(r)}}var d=$("#"+n[0]+"_hours_"+a),h=Number($("#"+n[0]+"_start_"+a).val()),u=Number($(this).val()),p=1===a&&"sat"!==n[0]&&"sun"!==n[0]?15:0;d.val(u-h-p>0?e(u-h-p):"");var _="00:00",v="00:00",m="00:00",f="00:00";$("#"+n[0]+"_hours_1").not(".night")&&(_=$("#"+n[0]+"_hours_1").val()),$("#"+n[0]+"_hours_2").not(".night")&&(v=$("#"+n[0]+"_hours_2").val()),$("#"+n[0]+"_hours_3").not(".night")&&(m=$("#"+n[0]+"_hours_3").val()),$("#"+n[0]+"_hours_4").not(".night")&&(f=$("#"+n[0]+"_hours_4").val()),_=t(_),v=t(v),m=t(m),f=t(f),$("#"+n[0]+"_15").val(""),$("#"+n[0]+"_20").val("");var g=_+v+m+f;$("#"+n[0]+"_total").val(e(g));var b,y=0,w=0,k=$("#job"+n[0].charAt(0).toUpperCase()+n[0].slice(1)+a).val();g>480&&"sat"!==n[0]&&"sun"!==n[0]&&(y=Math.min(120,g-480)),(g>600||"sat"==n[0]||"sun"==n[0])&&("sat"==n[0]||"sun"==n[0]?w=g:"pld"!==k&&(w=g-480-120)),b=g-y-w,$("#"+n[0]+"_15").val(e(y)),$("#"+n[0]+"_20").val(e(w)),$("#"+n[0]+"_nor").val(e(b)),calcTotal()}),$(".hour-end").change(function(){var i=arguments.length>0&&void 0!==arguments[0]&&arguments[0],n=$(this).attr("id").split("_"),a=Number(n[2]);if(!$("#group_"+n[0]+"_"+n[2]+"_night").is(":checked")&&!i)return!1;var o=$("#"+n[0]+"_hours_"+a),l=Number($("#"+n[0]+"_start_"+a).val()),c=Number($(this).val()),s=1===a&&"sat"!==n[0]&&"sun"!==n[0]?15:0;c>l&&c!==l?o.val(c-l-s>0?e(c-l-s):""):o.val(1440-l+(1440-(1440-c))-s>0&&c!==l?e(1440-l+(1440-(1440-c))-s):"");var r="00:00",d="00:00",h="00:00",u="00:00";$("#"+n[0]+"_hours_1").is(".night")&&(r=$("#"+n[0]+"_hours_1").val()),$("#"+n[0]+"_hours_2").is(".night")&&(d=$("#"+n[0]+"_hours_2").val()),$("#"+n[0]+"_hours_3").is(".night")&&(h=$("#"+n[0]+"_hours_3").val()),$("#"+n[0]+"_hours_4").is(".night")&&(u=$("#"+n[0]+"_hours_4").val()),r=t(r),d=t(d),h=t(h),u=t(u),$("#"+n[0]+"_15_night").val(""),$("#"+n[0]+"_20_night").val("");var p=r+d+h+u;$("#"+n[0]+"_total_night").val(e(p));var _,v=0,m=0,f=a-1,g=null,b=$("#"+n[0]+"_end_"+f);b.length>0&&(g=l-b.val()),p>480&&"sat"!==n[0]&&n[0],l>=1080&&l<1380&&(null==g||g>600)&&(v=Math.min(120,p)),_=p-v-(m=p-v),$("#"+n[0]+"_15_night").val(e(v)),$("#"+n[0]+"_20_night").val(e(m)),$("#"+n[0]+"_nor_night").val(e(_)),calcTotal()}),calcTotal=function(){var i=0;$(".horNormal").each(function(){i+=t($(this).val())}),$("#totalNormal").val(e(i));var n=0;$(".hours-total").each(function(){n+=t($(this).val())}),$("#totalWeek").val(e(n));var a=0;$(".hor15").each(function(){a+=t($(this).val())}),$("#total15").val(e(a));var o=0;$(".hor20").each(function(){o+=t($(this).val())}),$("#total20").val(e(o))},$("#btnPreFill").click(function(){$("input, select").not("#preStart, #preEnd, #output, #empDate, #preJob, #PreNormal, #Pre15, #Pre20, #preHours, #btnClearSign, #status, #output, #week_end, #empname, select[name=pld], select[name=rdo], select[name=anl], input[name=employee_id], .btnClear, input[type=hidden], .btn, #preJob_description, #job_description").val("");var t=$("#preEnd").val();$(".end-1").not("#sat_end_1, #sun_end_1").val(t);var e=$("#preStart").val();$(".start-1").not("#sat_start_1, #sun_start_1").val(e);var i=$("#preJob").val();$(".job-1").not("#sat_job_1, #sun_job_1").val(i);var n=$("#preJob_description").val();$(".job_description_1").not("#sat_job_1_description, #sun_job_1_description").val(n),$(".end-1").not("#sat_end_1, #sun_end_1").trigger("change")}),$(".job").change(function(){"sick"==$(this).val()&&alert("You have to attach a medical certificate at the end of this Time Sheet or this day won't be paid!")}),$(".job, #preJob").change(function(){"001"!=$(this).val()&&"002"!=$(this).val()||($("#modalDescription").modal({backdrop:"static",keyboard:!1}),$("#description_destination").val(this.id))}),$("#btnSaveDescription").click(function(){var t=$("#description_destination").val(),e=$("#job_description").val();$("#"+t+"_description").val(e),$("#modalDescription").modal("hide")}),$("#modalDescription").on("hidden.bs.modal",function(t){var e=$("#job_description").val(),i=$("#description_destination").val();""==e&&$("#"+i).val("")}),$(".btnClear").click(function(){$("."+this.id.replace("_night","")).val(""),$("."+this.id.replace("_night","")).trigger("change")});$(document).on("change","input[type=file]",function(){!function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:600,i=$(t).prop("name"),n=$("[id*='"+i+"_img']"),a=$("[id*='"+i+"_hidden']");if(t.files&&t.files[0]){var o=new FileReader;o.onload=function(t){var i=new Image;i.onload=function(){var t=document.createElement("canvas"),o=t.getContext("2d");for(t.width=i.width,t.height=i.height,o.drawImage(i,0,0);.5*t.width>e;)t.width*=.5,t.height*=.5,o.drawImage(t,0,0,t.width,t.height);t.width=e,t.height=t.width*i.height/i.width,o.drawImage(i,0,0,t.width,t.height),n.attr("src",t.toDataURL()).show(),a.val(t.toDataURL())},i.src=t.target.result},o.readAsDataURL(t.files[0])}}(this)}),$(document).on("click",".delCert",function(){var t=$(this).prop("id").split("-");if("medical_certificates[1]"==t[0]){var e=$("[id*='"+t[0]+"_img']"),n=$("[name*='"+t[0]+"']"),a=$("[id*='"+t[0]+"_hidden']");e.attr("src","").hide(),a.val(""),n.val("")}else i--,$("[id*='"+t[0]+"_row']").remove()});var i=1;$("#addCert").click(function(){var t='\n        <div class="alert alert-secondary" id="medical_certificates['+ ++i+']_row">\n            <h5 style="text-align: center;">Certificate '+i+'</h5>\n            <div class="input-group col-12 mb-3">\n              <div class="custom-file" id="medical_certificates_list">\n                <input type="file" class="custom-file-input medical_certificates" id="medical_certificates['+i+']" name="medical_certificates['+i+']"/>\n                <label class="custom-file-label" for="medical_certificates['+i+']">Choose files</label>\n              </div>\n            </div>\n            <div class="input-group col-12 mb-3">\n                <img id="medical_certificates['+i+']_img" class="img-fluid" style="">\n            </div>\n            <input id="medical_certificates['+i+']-delete" type="button" class="btn btn-danger btn-sm ml-2 delCert" value="Delete">\n            <input type="hidden" class="custom-file-input" id="medical_certificates['+i+']_hidden" name="medical_certificates['+i+']_hidden" value="">\n        </div>';$("#aditional_certificates").append(t)}),$("#timesheet_form").on("submit",function(t){var e=!0,i=[1,2,3,4];if(($.each([{description:"Monday",short:"mon"},{description:"Tuesday",short:"tue"},{description:"Wednesday",short:"wed"},{description:"Thursday",short:"thu"},{description:"Friday",short:"fri"},{description:"Saturday",short:"sat"},{description:"Sunday",short:"sun"}],function(n,a){$.each(i,function(i,n){var o=$("#"+a.short+"_start_"+n).val(),l=$("#"+a.short+"_end_"+n).val(),c=$("#"+a.short+"_job_"+n).val(),s=$("#"+a.short+"_hours_"+n).val();return""!==s&&(""===o&&""===l||""===c)||""!==o&&(""===l||""===c||""===s)||""!==l&&(""===o||""===c||""===s)?(e=!1,t.preventDefault(),alert("Select start, end time and job "+n+" for "+a.description),$("#"+a.short+"_job_"+n).focus(),!1):c.length>0&&(0===o.length||0===l.length||"0"===o&&"0"===l)?(e=!1,t.preventDefault(),alert("Select start, end time and job "+n+" for "+a.description),$("#"+a.short+"_job_"+n).focus(),!1):void 0})}),"00:00"==$("#totalWeek").val())&&0==confirm("The total of hours of this Time Sheet is 00:00, are you sure you want to continue ?"))return e=!1,t.preventDefault(),!1;e&&$("#modalLoading").modal({backdrop:"static",keyboard:!1})}),$("#chkRow").click(function(){var t=$("input[type=checkbox]").not(this);t.prop("checked",!t.prop("checked"))}),$("#btnPrint").click(function(){if($("input[type=checkbox]:checked").not("#chkRow").length>0){var t=Array();$("input[type=checkbox]:checked").not("#chkRow").each(function(){t.push(this.id.split("-")[1])});var e=window.location.href.split("/");"timesheets"==e[e.length-1]?window.open(window.location.href+"/action/"+t.join(",")+"/print","_blank"):window.open(window.location.href.replace(/\/[^\/]*$/,"/action/"+t.join(",")+"/print","_blank"))}}),$("#btnDelete").click(function(){if($("input[type=checkbox]:checked").not("#chkRow").length>0){var t=window.location.pathname+"/action/",e=Array();$("input[type=checkbox]:checked").not("#chkRow").each(function(){e.push(this.id.split("-")[1])}),1==confirm("Are you sure you want to delete following documents: "+e+"?")&&$(location).attr("href",t+e.join(",")+"/delete")}}),$(".delete").click(function(){1==confirm("Are you sure you want to delete this document (#"+$(this).attr("id")+")?")&&$(location).attr("href",window.location.pathname+"/action/"+$(this).attr("id")+"/delete")}),$("#btnStatus").click(function(){$("input[type=checkbox]:checked").not("#chkRow").length>0&&$("#modalChangeStatus").modal("show")}),$("#selectLocation").change(function(){window.location=window.location.href+="&type="+$(this).val()}),$("#selectCompany").change(function(){window.location=window.location.href+="&company="+$(this).val()}),$("#btnSaveStatus").click(function(){if($("input[type=checkbox]:checked").not("#chkRow").length>0){var t=Array(),e=$("select[name=changeStatus]").val();$("input[type=checkbox]:checked").not("#chkRow").each(function(){t.push(this.id.split("-")[1])});var i=window.location.href.split("/");"timesheets"==i[i.length-1]?window.location+="/action/"+t.join(",")+"/update/"+e:window.location=window.location.href.replace(/\/[^\/]*$/,"/action/"+t.join(",")+"/update/"+e)}});var n=[];$(document).on("click",".btn-select",function(){-1===n.indexOf(this.id.toString())&&(n.push(this.id),jQuery("#emp-"+this.id).detach().appendTo("#selecteds"),$(this).removeClass("btn-success btn-select").addClass("btn-danger btn-remove").text("Remove"),$("#countSelecteds").text("("+n.length+")")),console.log(n)}),$(document).on("click",".btn-remove",function(){1==confirm("Are you sure you want to unselect this employee?")&&(jQuery("#emp-"+this.id).remove(),n.splice(n.indexOf(this.id),1),$("#countSelecteds").text("("+n.length+")"))}),$("#btn-continue").click(function(){n.length>0&&(window.location="create/"+n.join(","))}),$("#btnSearch").click(function(){$("#employee").empty();var t=$("#search").val(),e=window.location.pathname.replace("timesheets/select","");$.ajax({url:e+"api/employees/"+t,type:"GET",dataType:"json"}).done(function(t){$.each(t,function(t,e){var i='\n\n                      <div id="emp-'+e.id+'" class="active select-employee card '+(null===e.last_timesheet||void 0===e.last_timesheet?"":"bg-warning")+'">\n                        <div class="select-employee card-header" role="tab" id="heading-undefined">\n                        <div class="row">\n                          <div class="'+(null===e.last_timesheet||void 0===e.last_timesheet?"col-md-11 col-lg-11":"col-md-9 col-lg-9")+'">\n                            <h6>\n                                <a href="'+(null===e.last_timesheet||void 0===e.last_timesheet?"create/"+e.id:"#")+'" style="'+(null===e.last_timesheet||void 0===e.last_timesheet?"":"color: white;")+'">\n                                  <span> '+e.name+'</span>\n                                </a>\n                            </h6>\n                            <i style="'+(null===e.last_timesheet||void 0===e.last_timesheet?"display: none":"display: block;")+'">This employee already has a Time Sheet for this week   &#32;</i>\n                          </div>\n                          <div class="col-md-2 col-lg-2" style="'+(null===e.last_timesheet||void 0===e.last_timesheet?"display: none":"display: block;")+'">\n                            <a href="action/'+(null===e.last_timesheet||void 0===e.last_timesheet?"":e.last_timesheet)+'/print" class="btnAdd btn btn-primary" style="color: white;display:'+(null===e.last_timesheet||void 0===e.last_timesheet?"none":"block")+';" target="_blank">View Time Sheet</a>\n                          </div>\n\n                          <div class="col-md-1 col-lg-1 float-right" style="padding-left: 0px; '+(null===e.last_timesheet||void 0===e.last_timesheet?"display: block":"display: none;")+'">\n                            <button id="'+e.id+'" class="btn btn-success btn-select" style="'+(-1===n.indexOf(e.id.toString())?"":"display:none;")+'">Select</button>\n                          </div>\n                        </div>\n                      </div>';$("#employee").append(i)})}).fail(function(){console.log("error")})}),$("#btnEntitlements").click(function(){$("#modalUpdateEntitlements").modal("show")}),$(".btnPrintEmployee").click(function(){if($("input[type=checkbox]:checked").not("#chkRow").length>0){var t=Array();$("input[type=checkbox]:checked").not("#chkRow").each(function(){t.push(this.id.split("-")[1])});window.location.href.split("/");window.open("employees/action/"+t.join(",")+"/"+this.id,"_blank")}}),$(".chk_night_work").click(function(){var t=$(this).attr("id").split("_"),e=Number(t[2]),i=t[1];$("#"+i+"_end_"+e).trigger("change",[!0]),$("#"+this.id.replace("_night","")).trigger("change"),$(this).is(":checked")?$("#"+i+"_hours_"+e).addClass("night"):$("#"+i+"_hours_"+e).removeClass("night"),$("#"+this.id.replace("_night","")).trigger("click")})})}});