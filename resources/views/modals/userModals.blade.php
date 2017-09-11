<div class="modal fade" id="modal-form" tabindex="-1" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Configuration:</h4>
            </div>
            <div class="modal-body">
                <form id="omega-form">
                    <div :class="['clearfix','form-group', errors.employee_id ? ' has-error' : '']">
                        <label for="employee_id" class="col-md-4 control-label">Employee ID</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control input-sm" name="employee_id" required v-model="selectedUser.data.employee_id">
                            <span class="help-block" v-if="errors.employee_id">
                                <strong v-text="errors.employee_id[0]"></strong>
                            </span>
                        </div>
                    </div>

                    <div :class="['clearfix','form-group', errors.name ? ' has-error' : '']">
                        <label for="name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control input-sm" name="name" required v-model="selectedUser.data.name">
                            <span class="help-block" v-if="errors.name">
                                <strong v-text="errors.name[0]"></strong>
                            </span>
                        </div>
                    </div>

                    <div :class="['clearfix','form-group', errors.email ? ' has-error' : '']">
                        <label for="email" class="col-md-4 control-label">Email address</label>

                        <div class="col-md-6">
                            <input type="email" class="form-control input-sm" name="email" required v-model="selectedUser.data.email">
                            <span class="help-block" v-if="errors.email">
                                <strong v-text="errors.email[0]"></strong>
                            </span>
                        </div>
                    </div>

                    <div :class="['clearfix','form-group', errors.is_admin ? ' has-error' : '']">

                        <label for="name" class="col-md-4 control-label">Is admin</label>
                        <div class="col-md-6">
                            <label class="switch">
                                <input type="checkbox" name="is_admin" v-model="selectedUser.data.is_admin">
                                <div class="slider round"></div>
                            </label>
                            <span class="help-block" v-if="errors.is_admin">
                                <strong v-text="errors.is_admin[0]"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-12 alert-info clearfix" v-show="selectedUser.index > -1">
                        <strong>Notice: </strong>fill out this portion only if you are planning to change password
                    </div>
                    <div :class="['clearfix','form-group', errors.old_password ? ' has-error' : '']" v-show="selectedUser.index > -1">
                        <label for="old_password" class="col-md-4 control-label">Current password</label>

                        <div class="col-md-6">
                            <input type="password" class="form-control input-sm" name="old_password" required v-model="password.old_password">
                            <span class="help-block" v-if="errors.old_password">
                                <strong v-text="errors.old_password[0]"></strong>
                            </span>
                        </div>
                    </div>

                    <div :class="['clearfix','form-group', errors.password ? ' has-error' : '']">
                        <label for="password" class="col-md-4 control-label" v-text="selectedUser.index > -1 ? 'New Password' : 'Password'"></label>

                        <div class="col-md-6">
                            <input type="password" class="form-control input-sm" name="password" required v-model="password.password">
                            <span class="help-block" v-if="errors.password">
                                <strong v-text="errors.password[0]"></strong>
                            </span>
                        </div>
                    </div>

                    <div :class="['clearfix','form-group', errors.password_confirmation ? ' has-error' : '']">
                        <label for="password_confirmation" class="col-md-4 control-label">Confirm Password</label>

                        <div class="col-md-6">
                            <input type="password" class="form-control input-sm" name="password_confirmation" required v-model="password.password_confirmation">
                            <span class="help-block" v-if="errors.password_confirmation">
                                <strong v-text="errors.password_confirmation[0]"></strong>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" v-on:click="readyModalForInsert">Cancel</button>
                <button type="button" class="btn btn-primary" v-on:click="updateUser" v-if="selectedUser.index > -1">Save changes</button>
                <button type="button" class="btn btn-primary" v-on:click="addUser" v-else>Add</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->