
<div class="modal fade" id="modal-form" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Configuration:</h4>
            </div>
            <div class="modal-body">
                <form id="omega-form">
                    <div :class="['form-group', errors.ip ? ' has-error' : '']">
                        <label for="ip" class="control-label">IP</label>
                        <input id="ip" type="text" class="form-control  input-sm" name="ip" required v-model="selectedDevice.data.ip">
                        <span class="help-block" v-if="errors.ip">
                            <strong v-text="errors.ip[0]"></strong>
                        </span>
                    </div>

                    <div :class="['form-group', errors.location ? ' has-error' : '']">
                        <label for="location" class="control-label">Location</label>
                            <input id="location" type="text" class="form-control input-sm" name="location" required v-model="selectedDevice.data.location">
                            <span class="help-block" v-if="errors.location">
                                <strong v-text="errors.location[0]"></strong>
                            </span>
                    </div>
                    <hr>
                    <div class="col-xs-12">
                        <label class="row control-label">TEMPERATURE: </label>
                        <div class="row">
                            <div :class="['col-xs-5 form-group', errors.temp_min ? ' has-error' : '']">
                                <div class="input-group">
                                    <input id="temp_min"
                                           type="text"
                                           class="form-control input-sm"
                                           name="temp_min"
                                           required
                                           placeholder="min"
                                           v-model="selectedDevice.data.temp_min"
                                    >
                                    <span class="input-group-addon">&deg;C</span>
                                </div>
                                <span class="help-block" v-if="errors.temp_min">
                                    <strong v-text="errors.temp_min[0]"></strong>
                                </span>
                            </div>
                            <div class="col-xs-1"><strong>-</strong></div>
                            <div :class="['col-xs-5 form-group', errors.temp_max ? ' has-error' : '']">
                                <div class="input-group">
                                    <input id="temp_max"
                                           type="text"
                                           class="form-control input-sm"
                                           name="temp_max"
                                           required
                                           placeholder="max"
                                           v-model="selectedDevice.data.temp_max"
                                    >
                                    <span class="input-group-addon">&deg;C</span>
                                </div>
                                <span class="help-block" v-if="errors.temp_max">
                                    <strong v-text="errors.temp_max[0]"></strong>
                                </span>
                            </div>
                        </div>

                        <label class="row control-label">HUMIDITY: </label>
                        <div class="row">
                            <div :class="['col-xs-5 form-group', errors.temp_min ? ' has-error' : '']">
                                <div class="input-group">
                                    <input id="temp_min"
                                           type="text"
                                           class="form-control input-sm"
                                           name="rh_min"
                                           required
                                           placeholder="min"
                                           v-model="selectedDevice.data.rh_min"
                                    >
                                    <span class="input-group-addon">%</span>
                                </div>
                            <span class="help-block" v-if="errors.rh_min">
                                <strong v-text="errors.rh_min[0]"></strong>
                            </span>
                            </div>
                            <div class="col-xs-1"><strong>-</strong></div>
                            <div :class="['col-xs-5 form-group', errors.rh_max ? ' has-error' : '']">
                                <div class="input-group">
                                    <input id="rh_max"
                                           type="text"
                                           class="form-control input-sm"
                                           name="rh_max"
                                           required
                                           placeholder="max"
                                           v-model="selectedDevice.data.rh_max"
                                    >
                                    <span class="input-group-addon">%</span>
                                </div>
                                <span class="help-block" v-if="errors.rh_max">
                                    <strong v-text="errors.rh_max[0]"></strong>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" @click="readyModalForInsert">Cancel</button>
                <button type="button" class="btn btn-primary" @click="updateDevice" v-if="selectedDevice.index > -1">Save changes</button>
                <button type="button" class="btn btn-primary" @click="addDevice" v-else>Add</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="export-form" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Export to excel:</h4>
            </div>
            <div class="modal-body">
                <div class="col-xs-offset-2">
                    <datepicker col="4" name="from" label="date from"></datepicker>
                    <datepicker col="4" name="to" label="date to"></datepicker>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" :href="exportLink">Export <i class="fa fa-download"></i></a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="clock-form" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Configuration:</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid clearfix">
                    @if(Auth::user()->is_admin)
                        <div class="row">
                            <div class="form-group">
                                <label class="control-label">
                                    <input type="checkbox" v-model="configuration.fake_reading">
                                    DISPLAY FAKE READING
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="control-label">
                                    <input type="checkbox" v-model="configuration.hide_offline">
                                    HIDE OFFLINE
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="control-label">
                                    <input type="checkbox" v-model="configuration.hide_pl3">
                                    HIDE PL3
                                </label>
                            </div>
                        </div>
                    @endif
                <hr>
                <div class="row">
                    <div :class="['form-group', errors.refreshing_time ? ' has-error' : '']">
                        <label for="refreshing_time" class="control-label">Refresh Interval (per minute/s)</label>
                            <input id="refreshing_time"
                                   type="text"
                                   class="form-control input-sm"
                                   name="refreshing_time"
                                   v-model="configuration.refreshing_time"
                            >

                        <span class="help-block" v-if="errors.refreshing_time">
                            <strong v-text="errors.refreshing_time[0]"></strong>
                        </span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" @click="updateConfiguration()">Save <i class="fa fa-save"></i></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->