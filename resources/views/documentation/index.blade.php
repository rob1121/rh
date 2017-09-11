<!DOCTYPE html>
<html>
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{url('/css/app.css')}}">
    <script src="{{url("/js/app.js")}}"></script>
    <style>
        body {
            position: relative;
            background: #fff;
        }
        .col-md-9 div {
            min-height: 150px;
            margin-bottom: 120px;
        }
        ul.nav-pills {
            position: fixed;
            overflow-y: scroll;
            padding-top: 50px;
            padding-bottom: 50px;
            height: 100vh;

        }

        a {
            font-weight: bold;
        }

        video {
            box-shadow: 0 10px 6px -6px #777;
        }
        strong.label.label-default {
            border: 1px solid #aeb6ba;
            background: #fff;
            color: #636b6f;
        }

        h1,
        ul.nav.nav-pills > li {
            text-transform: uppercase;
        }
    </style>
</head>
<body data-spy="scroll" data-target="#myScrollspy" data-offset="80">

<div class="container">
    <div class="row">
        <nav class="col-md-3 hidden-sm hidden-xs" id="myScrollspy">
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="#what-is-rh-monitoring">Introduction</a></li>
                <li><strong><hr>Usage</strong></li>
                <li><a href="#view">Viewing Monitor</a></li>
                <li><a href="#page-setup">Viewing Page Setup</a></li>
                <li><a href="#register-new-device">registering new devices</a></li>
                <li><a href="#updating-device">updating list</a></li>
                <li><a href="#deleting-device">deleting device</a></li>
                <li><a href="#rearranging-devices">Arranging Devices</a></li>
                <li><a href="#exporting-to-excel">Export reading to excel</a></li>
                <li><a href="#system-configuration">System Configuration</a></li>
                <li><strong><hr>DEVELOPER</strong></li>
                <li><a href="#dev-requirements">DEV TOOLS</a></li>
                <li><hr><a href="{{url("/")}}">Back to Home Page</a></li>
            </ul>
        </nav>
        <div class="col-md-9">
            <h1 style="color:#800000;margin-bottom:164px"><strong>Relative Humidity and Temperature Monitoring System</strong></h1>
            <hr>
            <div id="what-is-rh-monitoring">
                <h1>Introduction</h1>
                <p>Its main purpose is to monitor the level of humidity and temperature within the production area.</p>
            </div>
            <hr>
            <div id="view">
                <h1>Viewing Monitor</h1>
                <ol>
                    <li>In your default browser visit <a target="_blank" href="http://tspi-db01/rh/public">http://tspi-db01/rh/public</a>.</li>
                    <li>Then click the <strong>monitoring</strong> from menu in the center under the title <strong>OmegaMonitoring</strong></li>
                    <li>This will open new tab, wait for the page to load completely;
                        This will take less than a minute for it needs to fetch all data from the devices in the production area.</li>
                </ol>

                <em class="help-block">
                    <strong>Note</strong>: I suggest make google chrome as you default browser,
                    for better user experience and for this is developed and fully tested in google chrome browser.
                </em>

                <video width="100%" controls>
                    <source src="{{url("img/viewing-monitoring-video.mp4")}}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <hr>
            <div id="page-setup">
                <h1>Viewing Page setup</h1>
                <ol>
                    <li>On landing page click <strong>setup</strong> from the menu under the title <strong>OmegaMonitoring</strong></li>
                    <li>login your account</li>
                    <li>now system will redirect you to page setup.</li>
                </ol>

                <video width="100%" controls>
                    <source src="{{url("img/visit-page-setup-video.mp4")}}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <hr>
            <div id="register-new-device">
                <h1>Registering new devices</h1>
                <legend>On page setup...</legend>
                <ol>
                    <li>this features is for authorized user only; To validate the credentials user must login. See: <a
                                href="#page-setup" class="label label-info"><em>Viewing Page Setup</em></a></li>
                    <li>Click <strong class="label label-primary">Register new device</strong></li>
                    <li>Fill out necessary fields</li>
                    <li>then click <strong class="label label-primary">add</strong></li>
                </ol>

                <video width="100%" controls>
                    <source src="{{url("img/register-new-device-video.mp4")}}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <hr>
            <div id="updating-device">
                <h1>Updating Device Info</h1>
                <legend>On page setup...</legend>
                <ol>
                    <li>Click <strong class="label label-primary">Edit</strong></li>
                    <li>modal will popup, update device data</li>
                    <li>then click <strong class="label label-primary">save changes</strong></li>
                </ol>
                <video width="100%" controls>
                    <source src="{{url("img/updating-device-video.mp4")}}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <hr>
            <div id="deleting-device">
                <h1>Deleting device</h1>
                <legend>On page setup...</legend>
                <p>On device list, click <strong class="label label-danger">remove</strong></p>
                <video width="100%" controls>
                    <source src="{{url("img/deleting-device-video.mp4")}}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <hr>
            <div id="rearranging-devices">
                <h1>Arranging Devices</h1>
                <legend>On page setup...</legend>
                <ol>
                    <li>Click <strong class="label label-default">Change Device Position</strong></li>
                    <li>start <strong>rearranging</strong> by <em>dragging & dropping the row</em></li>
                    <li>then click <strong class="label label-primary">save changes</strong></li>
                </ol>
                <video width="100%" controls>
                    <source src="{{url("img/rearranging-devices-video.mp4")}}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <hr>
            <div id="exporting-to-excel">
                <h1>Export reading to excel</h1>
                <legend>On page setup...</legend>
                <ol>
                    <li>Click <strong class="label label-warning">Export Reading</strong></li>
                    <li>modal will popup, update device data</li>
                    <li>set <em>date range</em></li>
                    <li>then click <strong class="label label-primary">Export</strong></li>
                </ol>
                <video width="100%" controls>
                    <source src="{{url("img/exporting-to-excel-video.mp4")}}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <hr>
            <div id="system-configuration">
                <h1>System Configuration</h1>
                <legend>On page setup...</legend>
                <ol>
                    <li>Click <strong class="label label-success">System Configuration</strong></li>
                    <li>modal will popup, update device data</li>
                    <li>set <em>date range</em></li>
                    <li>then click <strong class="label label-primary">Export</strong></li>
                </ol>

                <em class="help-block">
                    <strong>Note</strong>: Here, you set <strong class="text-success">Relative Humidity</strong>
                    and <strong class="text-success">Temperature</strong> parameter, hide offline devices, and so on.
                </em>
                <video width="100%" controls>
                    <source src="{{url("img/system-configuration-video.mp4")}}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <hr>
            <div id="dev-requirements">
                <h1>DEVELOPMENT TOOLS</h1>
                <ul>
                    <li>
                        <strong>Tools: </strong>
                        <ul>
                            <li>Laragon / XAMPP</li>
                            <li>NodeJS</li>
                            <li>Composer</li>
                            <li>Gulp</li>
                            <li>Sass</li>
                        </ul>
                    </li>
                    <li>
                        <strong>Languages: </strong>
                        <ul>
                            <li>PHP 5.6 and later</li>
                            <li>HMTL</li>
                            <li>CSS</li>
                            <li>Javascript EcmaScript 6</li>
                        </ul>
                    </li>
                    <li>
                        <strong>Frameworks:</strong>
                        <ul>
                            <li>PHP: Laravel 5.3</li>
                            <li>Javascript: Vuejs2, JQuery</li>
                            <li>CSS: bootstrap 3</li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

</body>
</html>

