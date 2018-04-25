import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import moment from 'moment';


export default class Autofill extends Component {

    render() {
        return (	                
	                <div className="form-group alert alert-info" role="alert" id="groupPre">
	                { /* Start Group Prefill*/}
	                    <h4 style={{textAlign: 'center'}}>Autofill Time Sheet</h4>
	                        <div className="form-row" style={{textAlign: 'center'}}>
	                            <div className="col-md-6 col-12 mb-3">
	                                <label>Start</label>
	                                <select className="hour-start form-control form-control-lg custom-select " id="preStart">	                                    

	                                </select>
	                            </div>
	                            <div className="col-md-6 col-12 mb-3">
	                                <label>End</label>
	                                <select className="hour-start form-control form-control-lg custom-select " id="preEnd">	                                    

	                                </select>
	                            </div>
	                        </div>
	                        <div className="form-row" style={{textAlign: 'center'}}>
	                            <div className="col-md-12 mb-3">
	                                <label>Job</label>
	                                <select className="form-control form-control-lg custom-select " id="preJob">

	                                </select>
	                            </div>
	                        </div>
	                        <div className="form-row overtime" style={{textAlign: 'center', display: 'none'}}>
	                            <div className="col-md-6 mb-3">
	                                <label>Normal Hours</label>
	                                <input readOnly type="text" className="form-control form-control-lg time " id="PreNormal" maxLength="5"/>
	                            </div>
	                            <div className="col-md-6 mb-3">
	                                <label>Hours 1.5</label>
	                                <input readOnly type="text" className="form-control form-control-lg time " id="Pre15" maxLength="5"/>
	                            </div>
	                            <div className="col-md-6 mb-3">
	                                <label>Hours 2.0</label>
	                                <input readOnly type="text" className="form-control form-control-lg time" id="Pre20" value="" maxLength="5"/>
	                            </div>
	                            <div className="col-md-6 mb-3">
	                                <label>Total Hours</label>
	                                <input readOnly type="text" className="form-control form-control-lg time" id="preHours" value="" maxLength="5"/>
	                            </div>
	                        </div>
	                        <div className="col-md-12 mb-3">
                                <button type="button" className="btn btn-secondary btn-lg btn-block" id="btnPreFill">Autofill Time Sheet</button>
	                        </div>
	                </div>
            
        	);
    }
}


    

