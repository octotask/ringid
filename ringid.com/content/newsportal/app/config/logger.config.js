/*
 * © Ipvision
 */

(function() {
	'use strict';

    angular
        .module('ringid.config')
        .config(['$provide', function($provide) {

                var supplant =  function( template, values, pattern ) {
                    pattern = pattern || /\{([^\{\}]*)\}/g;

                    return template.replace(pattern, function(a, b) {
                        var p = b.split('.'),
                            r = values;

                        try {
                            for (var s in p) { r = r[p[s]];  }
                        } catch(e){
                            r = a;
                        }

                        return (typeof r === 'string' || typeof r === 'number') ? r : a;
                    });
                };

                var buildTimeString = function (date, format) {
                    date = date || new Date();
                    format = format || "%h:%m:%s:%z";

                    function pad(value, isMilliSeconds)
                    {
                        if(typeof (isMilliSeconds) === "undefined")
                        {
                            isMilliSeconds = false;
                        }
                        if(isMilliSeconds)
                        {
                            if(value < 10)
                            {
                                value = "00" + value;
                            }
                            else if(value < 100)
                            {
                                value = "0" + value;
                            }
                        }
                        return(value.toString().length < 2) ? "0" + value : value;
                    }

                    return format.replace(/%([a-zA-Z])/g, function (_, fmtCode)
                    {
                        switch(fmtCode)
                        {
                        case "Y":
                            return date.getFullYear();
                        case "M":
                            return pad(date.getMonth() + 1);
                        case "d":
                            return pad(date.getDate());
                        case "h":
                            return pad(date.getHours());
                        case "m":
                            return pad(date.getMinutes());
                        case "s":
                            return pad(date.getSeconds());
                        case "z":
                            return pad(date.getMilliseconds(), true);
                        default:
                            throw new Error("Unsupported format code: " + fmtCode);
                        }
                    });
                };


            var enhanceLogger = function ($log)
            {
                var separator = "::",

                    /**
                     * Capture the original $log functions; for use in enhancedLogFn()
                     */
                    _$log = (function ($log)
                    {
                        return {
                            log: $log.log,
                            info: $log.info,
                            warn: $log.warn,
                            debug: $log.debug,
                            error: $log.error
                        };
                    })($log),

                    /**
                     * Chrome Dev tools supports color logging
                     * @see https://developers.google.com/chrome-developer-tools/docs/console#styling_console_output_with_css
                     */
                    colorify = function (message, colorCSS)
                    {
                        //var isChrome = (BrowserDetect.browser == "Chrome") || (BrowserDetect.browser == "PhantomJS") ,
                            //canColorize = isChrome && (colorCSS !== undefined);

                        //return canColorize ? ["%c" + message, colorCSS] : [message];
                        return ["%c" + message, colorCSS];
                    },

                    /**
                     * Partial application to pre-capture a logger function
                     */
                    prepareLogFn = function (logFn, className, colorCSS)
                    {
                        /**
                         * Invoke the specified `logFn` with the supplant functionality...
                         */
                        var enhancedLogFn = function ()
                        {
                            try
                            {
                                var args = Array.prototype.slice.call(arguments),
                                    now = buildTimeString();

                                // prepend a timestamp and optional classname to the original output message
                                //args[0] = supplant("{0} - {1}{2}", [now, className, angular.toJson(args[0])]);
                                args[0] = now + ' - ' + className + ' ' + angular.toJson(args[0]) ;
                                args = colorify(supplant.apply(null, args), colorCSS);

                                logFn.apply(null, args);
                            }
                            catch(error)
                            {
                                $log.error("LogEnhancer ERROR: " + error);
                            }

                        };

                        // Only needed to support angular-mocks expectations
                        enhancedLogFn.logs = [];

                        return enhancedLogFn;
                    },

                    /**
                     * Support to generate class-specific logger instance with classname only
                     */
                    getInstance = function (className, colorCSS, customSeparator)
                    {
                        className = (className !== undefined) ? className + (customSeparator || separator) : "";

                        var instance = {
                            log: prepareLogFn(_$log.log, className),
                            info: prepareLogFn(_$log.info, className, 'color:blue'),
                            warn: prepareLogFn(_$log.warn, className, 'color:orange'),
                            debug: prepareLogFn(_$log.debug, className, 'color:green'),
                            error: prepareLogFn(_$log.error, className, 'color:red') // NO styling of ERROR messages
                        };

                        if(angular.isDefined(angular.makeTryCatch))
                        {
                            // Attach instance specific tryCatch() functionality...
                            instance.tryCatch = angular.makeTryCatch(instance.error, instance);
                        }

                        return instance;
                    };

                // Add special method to AngularJS $log
                $log.getInstance = getInstance;

                return $log;
            };

            // Register our $log decorator with AngularJS $provider
            $provide.decorator('$log', ["$delegate",
                function ($delegate)
                {
                    // NOTE: the LogEnhancer module returns a FUNCTION that we named `enhanceLogger`
                    //       All the details of how the `enchancement` works is encapsulated in LogEnhancer!

                    enhanceLogger($delegate);

                    return $delegate;
                }
            ]);
        }]);

})();
