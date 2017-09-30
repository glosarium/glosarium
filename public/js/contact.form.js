/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 254);
/******/ })
/************************************************************************/
/******/ ({

/***/ 11:
/***/ (function(module, exports) {

$(function () {
    $('li.contact').addClass('active');
});

var forms = {
    email: null,
    subject: null,
    message: null
};

var contact = new Vue({
    el: '#content',
    data: {
        loading: false,
        errors: {
            subject: null,
            email: null,
            message: null
        },
        forms: forms,
        alerts: {
            type: null,
            title: null,
            message: null
        }
    },

    methods: {

        beforeSend: function beforeSend() {
            this.loading = true;

            this.alerts = {
                type: null,
                message: null
            };
        },

        afterSend: function afterSend() {
            this.forms = forms;
            this.errors = {
                email: null,
                subject: null,
                message: null
            };

            this.loading = false;
        },

        send: function send(e) {
            var _this = this;

            this.$Progress.start();
            this.beforeSend();

            axios.post(e.target.action, this.forms).then(function (response) {
                _this.alerts = {
                    type: 'success',
                    title: response.data.title,
                    message: response.data.message
                };

                _this.$Progress.finish();
                _this.afterSend();
            }).catch(function (error) {
                if (error.response.status == 422) {
                    _this.errors = error.response.data;
                } else {
                    _this.alerts = {
                        type: 'danger',
                        message: 'Kesalahan Internal Server'
                    };
                }

                _this.$Progress.fail();
                _this.loading = false;
            });
        }
    }
});

/***/ }),

/***/ 254:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(11);


/***/ })

/******/ });