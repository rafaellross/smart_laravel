import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import moment from 'moment';


export default class Job extends Component {

	constructor(props) {
		super(props);
		this.state = {
			value: null,
		};
	}
	
    render() {
        return (
			<div className="alert alert-secondary" style={{textalign: 'center'}}>
			    <h4>Job $job_curr</h4>
			    <div className="form-row" style={{textalign: 'center'}}>
			        <div className="col-md-6 col-12 mb-3">
			            <label>Start</label>
			                <select className="hour-start form-control form-control-lg custom-select start" id="{{$day}}_start_{{$job_curr}}" name="days[{{$day}}][{{$job_curr}}][start]">
			            	</select>
			        </div>
			        <div className="col-md-6 col-12 mb-3">
			            <label>End</label>
			            <select className="hour-end end-{{$job_curr}} form-control form-control-lg custom-select end" id="{{$day}}_end_{{$job_curr}}" name="days[{{$day}}][{{$job_curr}}][end]">
			            </select>
			        </div>
			    </div>
			    {/* Job and Hours*/}
			    <div className="form-row" style={{textalign: 'center'}}>
			        <div className="col-md-6 mb-3">
			            <label>Job</label>
			                <select className="form-control form-control-lg custom-select job job-1" id="{{$day}}_job_{{$job_curr}}" name="days[{{$day}}][{{$job_curr}}][job]">
			                <option value="">Select Job</option>
			            </select>
			        </div>
			        <div className="col-md-6 mb-3">
			            <label>Hours</label>
			                <input readOnly type="text" className="form-control form-control-lg time job1 hours" id="{{$day}}_hours_{{$job_curr}}" value="" maxLength="5" name="days[{{$day}}][{{$job_curr}}][hours]"/>
			        </div>        
			            <button type="button" className="btn btn-secondary btn-sm" id="btnShowExtra" >Show More Jobs</button>
			        	<input type="button" className="btn btn-danger btn-sm ml-2 btnClear" value="Clear"/>
			    </div>
			</div>
        );
    }
}


    

