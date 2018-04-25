import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import moment from 'moment';


export default class Special extends Component {

    render() {
        return (
			<div className="form-group alert alert-info" role="alert" >
				<h4 style={{textAlign: 'center'}}>Special Requests</h4>
				<div className="form-row" style={{textalign: 'center'}}>
				    <div className="col-md-12 col-12 mb-3">
				        <label><strong>PLD</strong></label>
				        <select className="form-control form-control-lg custom-select " name="pld">
				        </select>
				    </div>
				</div>
				<div className="form-row" style={{textalign: 'center'}}>
				    <div className="col-md-12 col-12 mb-3">
				        <label><strong>RDO</strong></label>
				        <select className="form-control form-control-lg custom-select " name="rdo">
				        </select>
				    </div>
				</div>
				<div className="form-row" style={{textalign: 'center'}}>
				    <div className="col-md-12 col-12 mb-3">
				        <label><strong>Annual Leave</strong></label>
				        <select className="form-control form-control-lg custom-select " name="anl">
				        </select>
				    </div>
				</div>
			</div>                
        );
    }
}


    

