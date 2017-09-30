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
/******/ 	return __webpack_require__(__webpack_require__.s = 261);
/******/ })
/************************************************************************/
/******/ ({

/***/ 18:
/***/ (function(module, exports) {

$(function () {
    $('#content').addClass('block-section bg-color4');
});

var register = new Vue({
    el: '#content',
    data: {
        loading: false,
        disabled: false,
        forms: {
            _token: Laravel.csrfToken,
            name: null,
            email: null,
            password: null,
            passwordConfirmation: null
        },
        errors: {}
    },

    methods: {

        beforeRegister: function beforeRegister() {
            this.loading = true;
            this.disabled = true;
        },

        afterRegister: function afterRegister() {
            this.disabled = false;
            this.loading = false;
        },

        register: function register(e) {
            var _this = this;

            this.$Progress.start();
            this.beforeRegister();

            axios.post(e.target.action, this.forms).then(function (response) {
                _this.$Progress.finish();

                window.location = response.data.url;
            }).catch(function (e) {
                if (e.response.status == 422) {
                    _this.errors = e.response.data;
                }

                _this.afterRegister();

                _this.$Progress.fail();
            });
        },

        checkEmail: function checkEmail() {
            var _this2 = this;

            if (this.forms.email.length > 3) {
                axios.post(routes.userEmail, { email: this.forms.email }).then(function (response) {}).catch(function (e) {
                    if (e.response.status == 422) {
                        _this2.errors = {
                            email: [e.response.data.message]
                        };
                    }
                });
            }
        }
    }
});

/***/ }),

/***/ 261:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(18);


/***/ })

/******/ });