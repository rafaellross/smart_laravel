import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import moment from 'moment';
import Job from './Job.js';

export default class Day extends Component {

    render() {
        return (
			<div className="form-group alert alert-success" role="alert" id="groupMonday">
			
			    <h4 style={{textAlign: 'center'}}>$weekDay->description</h4>    
			    {/* Start Job 1  */}        
			    	<Job/>
			        <div id="extraJobs{{$weekDay->short}}" style={{display: 'none'}}>
			        	<Job/>    
			        </div>     
			    {/* Total day */}
			    <div className="form-row overtime" style={{textAlign: 'center'}}>
			        <div className="col-md-6 mb-3">
			            <label>Normal Hours</label>
			            <input readOnly type="text" className="form-control form-control-lg time horNormal" id="{{$weekDay->short}}_nor" value="{{$day->normal}}" maxLength="5" name="days[$weekDay->short][total][normal]"/>
			        </div>
			        <div className="col-md-6 mb-3">
			            <label>Hours 1.5</label>
			            <input readOnly type="text" className="form-control form-control-lg time hor15" id="{{$weekDay->short}}_15" value="{{$day->total_15}}" maxLength="5" name="days[$weekDay->short][total][1.5]"/>
			        </div>
			    </div>
			    <div className="form-row overtime" style={{textAlign: 'center'}}>
			        <div className="col-md-6 mb-3">
			            <label>Hours 2.0</label>
			            <input readOnly type="text" className="form-control form-control-lg time hor20" value="{{$day->total_20}}" maxLength="5" id="{{$weekDay->short}}_20" name="days[{{$weekDay->short}}][total][2.0]"/>
			        </div>
			        <div className="col-md-6 mb-3">
			            <label>Total Hours</label>
			            <input readOnly type="text" className="form-control form-control-lg time hours-total" value="{{$day->total}}" maxLength="5" id="{{$weekDay->short}}_total" name="days[{{$weekDay->short}}][total][total]"/>
			        </div>
			    </div>
			    {/* End Total day */}
			</div>

        );
    }
}


    

