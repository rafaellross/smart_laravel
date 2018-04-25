import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import DatePicker from 'react-datepicker';
import moment from 'moment';
import Day from './Day.js';

import 'react-datepicker/dist/react-datepicker.css';

export default class Title extends Component {

    render() {
        return (
			<div>
		        <div className="col-xs-12 col-sm-12 col-md-12" style={{textAlign: 'center'}}>
		            <img src="../img/logo.svg" alt="Smart Plumbing Solutions" className="img-fluid" style={{padding: 1 + 'em'}} />
		        </div>        
		        
		        <div className="col-xs-12 col-sm-12 col-md-12" style={{textAlign: 'center'}}>
		            <h2>Time Sheet</h2>
		        </div>
                <div className="form-group">
                    <label htmlFor="empname">
                        <h5>Name:</h5>
                    </label>
	                    <input readOnly type="text" className="form-control form-control-lg" id="empname" placeholder="Type employee name" value=""/>
	                </div>
                <div className="form-group">
		            <label htmlFor="week_end">
		                <h5>Week End:</h5>
		            </label>
		            <input type="text" className="form-control form-control-lg date-picker" name="week_end" data-date-days-of-week-disabled="1,2,3,4,5,6" id="week_end" required="" value=""/>	        
	            </div>    
			</div>        
        );
    }
}


    

