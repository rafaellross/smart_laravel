import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import moment from 'moment';


export default class Total extends Component {

    render() {
        return (
			<div className="form-group alert alert-success" role="alert">
			    <h4 style={{textalign: 'center'}}>Total Week</h4>
			    <div className="form-row overtime" style={{textalign: 'center'}}>        
			        <div className="col-md-6 mb-3">
			            <label>Normal Hours</label>
			            <input readOnly type="text" className="form-control form-control-lg time " name="totals[normal]" id="totalNormal" value="00:00" maxLength="5"/>
			        </div>
			        <div className="col-md-6 mb-3">
			            <label>Hours 1.5</label>
			            <input readOnly type="text" className="form-control form-control-lg time " name="totals[1.5]" id="total15" value="00:00" maxLength="5"/>
			        </div>
			        <div className="col-md-6 mb-3">
			            <label>Hours 2.0</label>
			            <input readOnly type="text" className="form-control form-control-lg time" name="totals[2.0]" id="total20" value="00:00" maxLength="5"/>
			        </div>
			        <div className="col-md-6 mb-3">
			            <label>Total Week</label>
			            <input readOnly type="text" className="form-control form-control-lg time totalWeek" name="totals[total]" id="totalWeek" value="00:00" maxLength="5"/>
			        </div>
			    </div>
			</div>
        );
    }
}


    

