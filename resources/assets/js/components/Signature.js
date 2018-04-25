import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import moment from 'moment';


export default class Signature extends Component {

    render() {
        return (

                <div className="form-group alert alert-success" role="alert" id="groupFriday">
                     {/* Start Group Signature*/}
                    <h4 style={{textAlign: 'center'}}>Signature</h4>
                        <div className="form-row" style={{textAlign: 'center'}}>
                            <div className="col-md-12 mb-3">

                                <input type="hidden" name="emp_signature" id="output" value=""/>
                                <div id="signature"></div>

                                <input type="button" value="Clear" id="btnClearSign" className="btn btn-danger" />
                            </div>
                        </div>
                </div>

        );
    }
}


    

