import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import DatePicker from 'react-datepicker';
import moment from 'moment';
import Title from './Title';
import Autofill from './Autofill';
import Day from './Day';
import Job from './Job';
import Special from './Special';
import Total from './Total';
import Signature from './Signature';

import 'react-datepicker/dist/react-datepicker.css';

export default class TimeSheet extends Component {

    render() {
        return (
            
            <div className="container">
                <Title/>
                <Autofill/>
                <Day/>
                <Special/>
                <Total/>
                <Signature/>
                {/* Start Group Date*/}
                <div className="form-group alert alert-success" role="alert" id="groupDate">
                    <h4 style={{textAlign: 'center'}}>Date</h4>

                        <div className="form-row" style={{textAlign: 'center'}}>
                            <div className="col-md-12 mb-3">
                                <input type="text" className="form-control form-control-lg date-picker" name="empDate" id="empDate" required value=""/>
                            </div>
                        </div>
                </div>
                {/* Start Group Date*/}
                <div className="form-group alert alert-success" role="alert" id="groupStatus">
                    <h4 style={{textAlign: 'center'}}>Status</h4>
                        <div className="form-row" style={{textAlign: 'center'}}>
                            <div className="col-md-12 mb-3">
                                <div className="form-group">
                                  <label htmlFor="status">Status</label>
                                  <select className="form-control" name="status" id="status">
                                    <option defaultValue value="P">Pending</option>
                                    <option value="A">Approved</option>
                                    <option value="A">Finalised</option>
                                    <option value="C">Cancelled</option>
                                  </select>
                                </div>
                            </div>
                        </div>
                </div>
                {/*End Group Total */}
                <div className="form-row" style={{textAlign: 'center'}}>
                    <div className="col-md-6 mb-3">
                        <a href="view.php?type=TimeSheet.php" className="btn btn-secondary btn-lg btn-block">Cancel</a>
                    </div>
                    <div className="col-md-6 mb-3">
                        <button type="submit" className="btn btn-primary btn-lg btn-block">Submit</button>
                    </div>
                </div>                
            </div>
        );
    }
}

ReactDOM.render(<TimeSheet />, document.getElementById('timesheet'));

