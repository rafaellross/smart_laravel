(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://localhost/smart_laravel/public',
            routes : [{"host":null,"methods":["GET","HEAD"],"uri":"opcache-api\/clear","name":null,"action":"Appstract\Opcache\Http\Controllers\OpcacheController@clear"},{"host":null,"methods":["GET","HEAD"],"uri":"opcache-api\/config","name":null,"action":"Appstract\Opcache\Http\Controllers\OpcacheController@config"},{"host":null,"methods":["GET","HEAD"],"uri":"opcache-api\/status","name":null,"action":"Appstract\Opcache\Http\Controllers\OpcacheController@status"},{"host":null,"methods":["GET","HEAD"],"uri":"opcache-api\/optimize","name":null,"action":"Appstract\Opcache\Http\Controllers\OpcacheController@optimize"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/open","name":"debugbar.openhandler","action":"Barryvdh\Debugbar\Controllers\OpenHandlerController@handle"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/clockwork\/{id}","name":"debugbar.clockwork","action":"Barryvdh\Debugbar\Controllers\OpenHandlerController@clockwork"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/assets\/stylesheets","name":"debugbar.assets.css","action":"Barryvdh\Debugbar\Controllers\AssetController@css"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/assets\/javascript","name":"debugbar.assets.js","action":"Barryvdh\Debugbar\Controllers\AssetController@js"},{"host":null,"methods":["DELETE"],"uri":"_debugbar\/cache\/{key}\/{tags?}","name":"debugbar.cache.delete","action":"Barryvdh\Debugbar\Controllers\CacheController@delete"},{"host":null,"methods":["GET","HEAD"],"uri":"_dusk\/login\/{userId}\/{guard?}","name":null,"action":"Laravel\Dusk\Http\Controllers\UserController@login"},{"host":null,"methods":["GET","HEAD"],"uri":"_dusk\/logout\/{guard?}","name":null,"action":"Laravel\Dusk\Http\Controllers\UserController@logout"},{"host":null,"methods":["GET","HEAD"],"uri":"_dusk\/user\/{guard?}","name":null,"action":"Laravel\Dusk\Http\Controllers\UserController@user"},{"host":null,"methods":["GET","POST","HEAD"],"uri":"broadcasting\/auth","name":null,"action":"\Illuminate\Broadcasting\BroadcastController@authenticate"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/user","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/employees","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/employees\/{name}","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/penetration\/{id}","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/myob","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"login","name":"login","action":"App\Http\Controllers\Auth\LoginController@showLoginForm"},{"host":null,"methods":["POST"],"uri":"login","name":null,"action":"App\Http\Controllers\Auth\LoginController@login"},{"host":null,"methods":["POST"],"uri":"logout","name":"logout","action":"App\Http\Controllers\Auth\LoginController@logout"},{"host":null,"methods":["GET","HEAD"],"uri":"register","name":"register","action":"App\Http\Controllers\Auth\RegisterController@showRegistrationForm"},{"host":null,"methods":["POST"],"uri":"register","name":null,"action":"App\Http\Controllers\Auth\RegisterController@register"},{"host":null,"methods":["GET","HEAD"],"uri":"password\/reset","name":"password.request","action":"App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm"},{"host":null,"methods":["POST"],"uri":"password\/email","name":"password.email","action":"App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail"},{"host":null,"methods":["GET","HEAD"],"uri":"password\/reset\/{token}","name":"password.reset","action":"App\Http\Controllers\Auth\ResetPasswordController@showResetForm"},{"host":null,"methods":["POST"],"uri":"password\/reset","name":null,"action":"App\Http\Controllers\Auth\ResetPasswordController@reset"},{"host":null,"methods":["GET","HEAD"],"uri":"\/","name":"home","action":"App\Http\Controllers\HomeController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"home","name":"home","action":"App\Http\Controllers\HomeController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"mail\/send","name":null,"action":"App\Http\Controllers\MailController@send"},{"host":null,"methods":["GET","HEAD"],"uri":"qa_types\/action\/{id}\/{action}","name":null,"action":"App\Http\Controllers\QATypesController@action"},{"host":null,"methods":["GET","HEAD"],"uri":"qa_users\/action\/{id}\/{action}","name":null,"action":"App\Http\Controllers\QAUserController@action"},{"host":null,"methods":["GET","HEAD"],"uri":"qa_users\/create\/{type_id}","name":null,"action":"App\Http\Controllers\QAUserController@create"},{"host":null,"methods":["GET","HEAD"],"uri":"qa_types","name":"qa_types.index","action":"App\Http\Controllers\QATypesController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"qa_types\/create","name":"qa_types.create","action":"App\Http\Controllers\QATypesController@create"},{"host":null,"methods":["POST"],"uri":"qa_types","name":"qa_types.store","action":"App\Http\Controllers\QATypesController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"qa_types\/{qa_type}","name":"qa_types.show","action":"App\Http\Controllers\QATypesController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"qa_types\/{qa_type}\/edit","name":"qa_types.edit","action":"App\Http\Controllers\QATypesController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"qa_types\/{qa_type}","name":"qa_types.update","action":"App\Http\Controllers\QATypesController@update"},{"host":null,"methods":["DELETE"],"uri":"qa_types\/{qa_type}","name":"qa_types.destroy","action":"App\Http\Controllers\QATypesController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"qa_users","name":"qa_users.index","action":"App\Http\Controllers\QAUserController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"qa_users\/create","name":"qa_users.create","action":"App\Http\Controllers\QAUserController@create"},{"host":null,"methods":["POST"],"uri":"qa_users","name":"qa_users.store","action":"App\Http\Controllers\QAUserController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"qa_users\/{qa_user}","name":"qa_users.show","action":"App\Http\Controllers\QAUserController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"qa_users\/{qa_user}\/edit","name":"qa_users.edit","action":"App\Http\Controllers\QAUserController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"qa_users\/{qa_user}","name":"qa_users.update","action":"App\Http\Controllers\QAUserController@update"},{"host":null,"methods":["DELETE"],"uri":"qa_users\/{qa_user}","name":"qa_users.destroy","action":"App\Http\Controllers\QAUserController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"form_prestart","name":"form_prestart.index","action":"App\Http\Controllers\FormPreStartController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"form_prestart\/create","name":"form_prestart.create","action":"App\Http\Controllers\FormPreStartController@create"},{"host":null,"methods":["POST"],"uri":"form_prestart","name":"form_prestart.store","action":"App\Http\Controllers\FormPreStartController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"form_prestart\/{form_prestart}","name":"form_prestart.show","action":"App\Http\Controllers\FormPreStartController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"form_prestart\/{form_prestart}\/edit","name":"form_prestart.edit","action":"App\Http\Controllers\FormPreStartController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"form_prestart\/{form_prestart}","name":"form_prestart.update","action":"App\Http\Controllers\FormPreStartController@update"},{"host":null,"methods":["DELETE"],"uri":"form_prestart\/{form_prestart}","name":"form_prestart.destroy","action":"App\Http\Controllers\FormPreStartController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"form_prestart\/action\/{id}\/{action}","name":null,"action":"App\Http\Controllers\FormPreStartController@action"},{"host":null,"methods":["GET","HEAD"],"uri":"form_checklist","name":"form_checklist.index","action":"App\Http\Controllers\FormDailyCheckListController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"form_checklist\/create","name":"form_checklist.create","action":"App\Http\Controllers\FormDailyCheckListController@create"},{"host":null,"methods":["POST"],"uri":"form_checklist","name":"form_checklist.store","action":"App\Http\Controllers\FormDailyCheckListController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"form_checklist\/{form_checklist}","name":"form_checklist.show","action":"App\Http\Controllers\FormDailyCheckListController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"form_checklist\/{form_checklist}\/edit","name":"form_checklist.edit","action":"App\Http\Controllers\FormDailyCheckListController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"form_checklist\/{form_checklist}","name":"form_checklist.update","action":"App\Http\Controllers\FormDailyCheckListController@update"},{"host":null,"methods":["DELETE"],"uri":"form_checklist\/{form_checklist}","name":"form_checklist.destroy","action":"App\Http\Controllers\FormDailyCheckListController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"form_checklist\/action\/{id}\/{action}","name":null,"action":"App\Http\Controllers\FormDailyCheckListController@action"},{"host":null,"methods":["GET","HEAD"],"uri":"form_service_sheet","name":"form_service_sheet.index","action":"App\Http\Controllers\FormServiceSheetController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"form_service_sheet\/create","name":"form_service_sheet.create","action":"App\Http\Controllers\FormServiceSheetController@create"},{"host":null,"methods":["POST"],"uri":"form_service_sheet","name":"form_service_sheet.store","action":"App\Http\Controllers\FormServiceSheetController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"form_service_sheet\/{form_service_sheet}","name":"form_service_sheet.show","action":"App\Http\Controllers\FormServiceSheetController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"form_service_sheet\/{form_service_sheet}\/edit","name":"form_service_sheet.edit","action":"App\Http\Controllers\FormServiceSheetController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"form_service_sheet\/{form_service_sheet}","name":"form_service_sheet.update","action":"App\Http\Controllers\FormServiceSheetController@update"},{"host":null,"methods":["DELETE"],"uri":"form_service_sheet\/{form_service_sheet}","name":"form_service_sheet.destroy","action":"App\Http\Controllers\FormServiceSheetController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"form_service_sheet\/action\/{id}\/{action}","name":null,"action":"App\Http\Controllers\FormServiceSheetController@action"},{"host":null,"methods":["GET","HEAD"],"uri":"parameters","name":"parameters.index","action":"App\Http\Controllers\ParametersController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"parameters\/create","name":"parameters.create","action":"App\Http\Controllers\ParametersController@create"},{"host":null,"methods":["POST"],"uri":"parameters","name":"parameters.store","action":"App\Http\Controllers\ParametersController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"parameters\/{parameter}","name":"parameters.show","action":"App\Http\Controllers\ParametersController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"parameters\/{parameter}\/edit","name":"parameters.edit","action":"App\Http\Controllers\ParametersController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"parameters\/{parameter}","name":"parameters.update","action":"App\Http\Controllers\ParametersController@update"},{"host":null,"methods":["DELETE"],"uri":"parameters\/{parameter}","name":"parameters.destroy","action":"App\Http\Controllers\ParametersController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"employees\/{id}\/edit","name":null,"action":"App\Http\Controllers\EmployeeController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"employees\/create","name":"employees.create","action":"App\Http\Controllers\EmployeeController@create"},{"host":null,"methods":["GET","HEAD"],"uri":"employees","name":"employees.index","action":"App\Http\Controllers\EmployeeController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"employees\/action\/{id}\/{action}\/{param?}","name":null,"action":"App\Http\Controllers\EmployeeController@action"},{"host":null,"methods":["PATCH"],"uri":"employees\/entitlemens","name":null,"action":"App\Http\Controllers\EmployeeController@updateEntitlements"},{"host":null,"methods":["POST"],"uri":"employees","name":"employees.store","action":"App\Http\Controllers\EmployeeController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"employees\/{employee}","name":"employees.show","action":"App\Http\Controllers\EmployeeController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"employees\/{employee}\/edit","name":"employees.edit","action":"App\Http\Controllers\EmployeeController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"employees\/{employee}","name":"employees.update","action":"App\Http\Controllers\EmployeeController@update"},{"host":null,"methods":["DELETE"],"uri":"employees\/{employee}","name":"employees.destroy","action":"App\Http\Controllers\EmployeeController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"jobs\/action\/{id}\/{action}\/{status?}","name":null,"action":"App\Http\Controllers\JobController@action"},{"host":null,"methods":["GET","HEAD"],"uri":"jobs","name":"jobs.index","action":"App\Http\Controllers\JobController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"jobs\/create","name":"jobs.create","action":"App\Http\Controllers\JobController@create"},{"host":null,"methods":["POST"],"uri":"jobs","name":"jobs.store","action":"App\Http\Controllers\JobController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"jobs\/{job}","name":"jobs.show","action":"App\Http\Controllers\JobController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"jobs\/{job}\/edit","name":"jobs.edit","action":"App\Http\Controllers\JobController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"jobs\/{job}","name":"jobs.update","action":"App\Http\Controllers\JobController@update"},{"host":null,"methods":["DELETE"],"uri":"jobs\/{job}","name":"jobs.destroy","action":"App\Http\Controllers\JobController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"users\/action\/{id}\/{action}\/{status?}","name":null,"action":"App\Http\Controllers\UserController@action"},{"host":null,"methods":["GET","HEAD"],"uri":"users","name":"users.index","action":"App\Http\Controllers\UserController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"users\/create","name":"users.create","action":"App\Http\Controllers\UserController@create"},{"host":null,"methods":["POST"],"uri":"users","name":"users.store","action":"App\Http\Controllers\UserController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"users\/{user}","name":"users.show","action":"App\Http\Controllers\UserController@show"},{"host":null,"methods":["DELETE"],"uri":"users\/{user}","name":"users.destroy","action":"App\Http\Controllers\UserController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"timesheets\/select","name":null,"action":"App\Http\Controllers\TimeSheetController@select"},{"host":null,"methods":["GET","HEAD"],"uri":"timesheets\/create\/{id}","name":null,"action":"App\Http\Controllers\TimeSheetController@create"},{"host":null,"methods":["GET","HEAD"],"uri":"timesheets\/action\/{id}\/{action}\/{status?}","name":"action_timesheet","action":"App\Http\Controllers\TimeSheetController@action"},{"host":null,"methods":["GET","HEAD"],"uri":"timesheets","name":null,"action":"App\Http\Controllers\TimeSheetController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"timesheets\/approve\/{id}","name":null,"action":"App\Http\Controllers\TimeSheetController@approve"},{"host":null,"methods":["GET","HEAD"],"uri":"timesheets\/{status?}","name":null,"action":"App\Http\Controllers\TimeSheetController@index"},{"host":null,"methods":["PATCH"],"uri":"users\/{users}","name":null,"action":"App\Http\Controllers\UserController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"timesheets\/create","name":"timesheets.create","action":"App\Http\Controllers\TimeSheetController@create"},{"host":null,"methods":["POST"],"uri":"timesheets","name":"timesheets.store","action":"App\Http\Controllers\TimeSheetController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"timesheets\/{timesheet}","name":"timesheets.show","action":"App\Http\Controllers\TimeSheetController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"timesheets\/{timesheet}\/edit","name":"timesheets.edit","action":"App\Http\Controllers\TimeSheetController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"timesheets\/{timesheet}","name":"timesheets.update","action":"App\Http\Controllers\TimeSheetController@update"},{"host":null,"methods":["DELETE"],"uri":"timesheets\/{timesheet}","name":"timesheets.destroy","action":"App\Http\Controllers\TimeSheetController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"employee_application","name":null,"action":"App\Http\Controllers\EmployeeApplicationController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"employee_application\/create","name":null,"action":"App\Http\Controllers\EmployeeApplicationController@create"},{"host":null,"methods":["POST"],"uri":"employee_application","name":"employee_application.store","action":"App\Http\Controllers\EmployeeApplicationController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"employee_application\/{employee_application}","name":"employee_application.show","action":"App\Http\Controllers\EmployeeApplicationController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"employee_application\/{employee_application}\/edit","name":"employee_application.edit","action":"App\Http\Controllers\EmployeeApplicationController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"employee_application\/{employee_application}","name":"employee_application.update","action":"App\Http\Controllers\EmployeeApplicationController@update"},{"host":null,"methods":["DELETE"],"uri":"employee_application\/{employee_application}","name":"employee_application.destroy","action":"App\Http\Controllers\EmployeeApplicationController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"employee_entries\/create\/{id?}","name":null,"action":"App\Http\Controllers\EmployeeEntryController@create"},{"host":null,"methods":["GET","HEAD"],"uri":"employee_entries\/scan","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"employee_entries\/{id?}","name":null,"action":"App\Http\Controllers\EmployeeEntryController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"employee_entries","name":"employee_entries.index","action":"App\Http\Controllers\EmployeeEntryController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"employee_entries\/create","name":"employee_entries.create","action":"App\Http\Controllers\EmployeeEntryController@create"},{"host":null,"methods":["GET","HEAD"],"uri":"employee_entries\/generate\/{id}","name":null,"action":"App\Http\Controllers\EmployeeEntryController@generateTimeSheet"},{"host":null,"methods":["GET","HEAD"],"uri":"employee_entries\/action\/{id?}\/{action?}","name":null,"action":"App\Http\Controllers\EmployeeEntryController@action"},{"host":null,"methods":["POST"],"uri":"employee_entries","name":"employee_entries.store","action":"App\Http\Controllers\EmployeeEntryController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"employee_entries\/{employee_entry}","name":"employee_entries.show","action":"App\Http\Controllers\EmployeeEntryController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"employee_entries\/{employee_entry}\/edit","name":"employee_entries.edit","action":"App\Http\Controllers\EmployeeEntryController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"employee_entries\/{employee_entry}","name":"employee_entries.update","action":"App\Http\Controllers\EmployeeEntryController@update"},{"host":null,"methods":["DELETE"],"uri":"employee_entries\/{employee_entry}","name":"employee_entries.destroy","action":"App\Http\Controllers\EmployeeEntryController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"fire_identification\/scan","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"fire_identification\/{job}","name":null,"action":"App\Http\Controllers\FireIdentificationController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"fire_identification\/{job}\/action\/{id}\/{action}","name":null,"action":"App\Http\Controllers\FireIdentificationController@action"},{"host":null,"methods":["GET","HEAD"],"uri":"fire_identification\/create\/{job}","name":null,"action":"App\Http\Controllers\FireIdentificationController@create"},{"host":null,"methods":["GET","HEAD"],"uri":"fire_identification\/edit\/{id}","name":null,"action":"App\Http\Controllers\FireIdentificationController@edit"},{"host":null,"methods":["POST"],"uri":"fire_identification\/{job}","name":null,"action":"App\Http\Controllers\FireIdentificationController@multiple"},{"host":null,"methods":["PATCH"],"uri":"fire_identification\/{fire_seal}","name":null,"action":"App\Http\Controllers\FireIdentificationController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"employee_application\/tfn","name":null,"action":"App\Http\Controllers\EmployeeApplicationController@tfn"},{"host":null,"methods":["GET","HEAD"],"uri":"employee_application\/action\/{id}\/{action}","name":null,"action":"App\Http\Controllers\EmployeeApplicationController@action"},{"host":null,"methods":["GET","HEAD"],"uri":"employee_application\/{id}\/edit","name":null,"action":"App\Http\Controllers\EmployeeApplicationController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"employee_application\/{id}\/agreement","name":null,"action":"App\Http\Controllers\EmployeeApplicationController@agreement"},{"host":null,"methods":["GET","HEAD"],"uri":"users\/{id}\/edit","name":null,"action":"Closure"}],
            prefix: '',

            route : function (name, parameters, route) {
                route = route || this.getByName(name);

                if ( ! route ) {
                    return undefined;
                }

                return this.toRoute(route, parameters);
            },

            url: function (url, parameters) {
                parameters = parameters || [];

                var uri = url + '/' + parameters.join('/');

                return this.getCorrectUrl(uri);
            },

            toRoute : function (route, parameters) {
                var uri = this.replaceNamedParameters(route.uri, parameters);
                var qs  = this.getRouteQueryString(parameters);

                if (this.absolute && this.isOtherHost(route)){
                    return "//" + route.host + "/" + uri + qs;
                }

                return this.getCorrectUrl(uri + qs);
            },

            isOtherHost: function (route){
                return route.host && route.host != window.location.hostname;
            },

            replaceNamedParameters : function (uri, parameters) {
                uri = uri.replace(/\{(.*?)\??\}/g, function(match, key) {
                    if (parameters.hasOwnProperty(key)) {
                        var value = parameters[key];
                        delete parameters[key];
                        return value;
                    } else {
                        return match;
                    }
                });

                // Strip out any optional parameters that were not given
                uri = uri.replace(/\/\{.*?\?\}/g, '');

                return uri;
            },

            getRouteQueryString : function (parameters) {
                var qs = [];
                for (var key in parameters) {
                    if (parameters.hasOwnProperty(key)) {
                        qs.push(key + '=' + parameters[key]);
                    }
                }

                if (qs.length < 1) {
                    return '';
                }

                return '?' + qs.join('&');
            },

            getByName : function (name) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                        return this.routes[key];
                    }
                }
            },

            getByAction : function(action) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].action === action) {
                        return this.routes[key];
                    }
                }
            },

            getCorrectUrl: function (uri) {
                var url = this.prefix + '/' + uri.replace(/^\/?/, '');

                if ( ! this.absolute) {
                    return url;
                }

                return this.rootUrl.replace('/\/?$/', '') + url;
            }
        };

        var getLinkAttributes = function(attributes) {
            if ( ! attributes) {
                return '';
            }

            var attrs = [];
            for (var key in attributes) {
                if (attributes.hasOwnProperty(key)) {
                    attrs.push(key + '="' + attributes[key] + '"');
                }
            }

            return attrs.join(' ');
        };

        var getHtmlLink = function (url, title, attributes) {
            title      = title || url;
            attributes = getLinkAttributes(attributes);

            return '<a href="' + url + '" ' + attributes + '>' + title + '</a>';
        };

        return {
            // Generate a url for a given controller action.
            // laroute.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // laroute.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // laroute.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // laroute.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // laroute.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // laroute.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
            link_to_action : function(action, title, parameters, attributes) {
                var url = this.action(action, parameters);

                return getHtmlLink(url, title, attributes);
            }

        };

    }).call(this);

    /**
     * Expose the class either via AMD, CommonJS or the global object
     */
    if (typeof define === 'function' && define.amd) {
        define(function () {
            return laroute;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = laroute;
    }
    else {
        window.laroute = laroute;
    }

}).call(this);

