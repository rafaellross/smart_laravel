<div class="form-group alert alert-info" role="alert" >
                    <h4 style="text-align: center;">Special Requests</h4>
                    <br>
                        <div class="form-row" style="text-align: center;">
                            <div class="col-md-12 col-12 mb-3">
                                <label><strong>PLD</strong></label>
                                <select class="form-control form-control-lg custom-select " name="pld">
                                    @for ($i = 0; $i <= (40*60); $i += 60)        
                                        <option value="{{$i}}" {{isset($timesheet) && $timesheet->pld == $i ? 'selected' : ''}}>{{ date('i:s', $i)}}</option>
                                    @endfor                                                

                                </select>
                            </div>
                        </div>
                        <div class="form-row" style="text-align: center;">
                            <div class="col-md-12 col-12 mb-3">
                                <label><strong>RDO</strong></label>
                                <select class="form-control form-control-lg custom-select " name="rdo">
                                    @for ($i = 0; $i <= (40*60); $i += 60)        
                                        <option value="{{$i}}" {{isset($timesheet) && $timesheet->rdo == $i ? 'selected' : ''}}>{{ date('i:s', $i)}}</option>
                                    @endfor                                                
                                </select>
                            </div>
                        </div>
                        <div class="form-row" style="text-align: center;">
                            <div class="col-md-12 col-12 mb-3">
                                <label><strong>Annual Leave</strong></label>
                                <select class="form-control form-control-lg custom-select " name="anl">
                                    @for ($i = 0; $i <= (40*60); $i += 60)        
                                        <option value="{{$i}}" {{isset($timesheet) && $timesheet->anl == $i ? 'selected' : ''}}>{{ date('i:s', $i)}}</option>
                                    @endfor                                                
                                </select>
                            </div>
                        </div>

                </div>                