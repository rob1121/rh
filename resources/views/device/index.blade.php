@extends('layouts.app')

@push("script")
<script src="{{URL::to("/js/device.js")}}"></script>
@endpush

@section('content')
    <div class="container" v-cloak>
        <div class="row">
            <div class="col-sm-offset-2 col-sm-8">
                <div class="row clearfix">
                    <div class="col-sm-12 text-center">
                        <a class="btn btn-xs btn-success" data-toggle="modal" href="#clock-form">
                            System Configuration <i class="fa fa-clock-o"></i>
                        </a>
                        <a class="btn btn-xs btn-warning" data-toggle="modal" href="#export-form">
                            Export Reading <i class="fa fa-calendar"></i>
                        </a>

                        <a class="btn btn-xs btn-primary" data-toggle="modal" href="#modal-form" @click="
                        readyModalForInsert">
                        Register new device <i class="fa fa-plus"></i>
                        </a>

                        <button :class="['btn btn-xs btn-default', disableSorting ? '':'disabled']" @click="
                        changeDevicePositions()">
                        <span>Change Device Positions</span>
                        <i class="fa fa-arrows"></i>
                        </button>
                    </div>
                </div>
                <br>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-sm-4"><h5>Omegas</h5></div>
                            <div class="col-sm-8">
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="row-fluid">
                            <input type="text" v-model="searchKey" placeholder="Look for..." class="col-sm-4">
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="radios pull-right">
                                        <div v-if="! disableSorting">
                                            <button :class="['btn btn-primary', {'disabled' : positionSortingLoadingState}]"
                                                    v-on:click="validationInputPositions()">
                                                <span>Save changes</span>
                                                <i :class="positionSortingLoadingState ? 'fa fa-spinner fa-spin' : 'fa fa-save' "></i>
                                            </button>

                                            <button class="btn btn-default" @click="revertDevicePositions()">
                                            <i class="fa fa-close"></i>
                                            <span>Cancel</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive" style="max-height:300px;overflow-y:scroll">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="text-right">Item No.</th>
                                <th>IP Address.</th>
                                <th>Location.</th>
                                <th>Actions.</th>
                            </tr>
                            </thead>
                            <tbody id="sortable">
                            <tr v-for='(device,$index) in filteredDevices' :key='device.position'
                                :class="disableSorting ?'': 'sortable-item'">
                                <td class="text-right" v-text="$index+1"></td>
                                <td v-text="device.ip"></td>
                                <td v-text="device.location"></td>
                                <td>
                                    <a class="btn btn-xs btn-primary" data-toggle="modal" href="#modal-form"
                                    @click="readyModalForUpdate(device)">edit</a>
                                    <button class="btn btn-xs btn-danger" @click="deleteDevice(device)">remove</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("modals.deviceModals")
@endsection
