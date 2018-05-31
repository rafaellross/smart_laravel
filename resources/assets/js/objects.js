$(document).ready(function() {

  class DOM {
    constructor(DOM){
      this.DOM = DOM.contents();
    }
  }

  class TimeSheet extends DOM {
    load() {
      //this.name       = this.DOM.find( "#empname" );
      this.week_end   = this.DOM.find( "#week_end" );
      this.autoFill   = this.DOM.find( ".days");
      this.DOM.find( ".days").each(function(index, el) {
        console.log(el);
      });
    }

    loadDays(days) {
      this.days = days;
    }
  }


  class Day extends DOM {
      load() {
        this.normal = this.DOM.find(".horNormal");
      }
  }

  class AutoFill extends DOM {
      load() {
        //this.normal = this.DOM.find(".horNormal");
      }
  }


  let test = new TimeSheet($('#timesheet_form'));


$('#btnTest').click(function(event) {
  /* Act on the event */
    test.load();
//  console.log(test);
});

});
