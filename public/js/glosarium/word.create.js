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
/******/ 	return __webpack_require__(__webpack_require__.s = 273);
/******/ })
/************************************************************************/
/******/ ({

/***/ 17:
/***/ (function(module, exports) {

$(function () {
	$('#content').removeClass('bg-color2').addClass('bg-color1');

	$('li.create-glosarium').addClass('active');
});

new Vue({
	el: '#content',
	data: {
		auth: Laravel.auth,
		loading: false,
		categories: null,
		alerts: {
			type: null,
			title: null,
			message: null
		},
		errors: [],
		forms: {
			category: '',
			origin: null,
			locale: null,
			description: null
		}
	},

	mounted: function mounted() {
		if (this.auth) {
			this.getCategory(routes.glosariumCategoryAll);
		}
	},


	methods: {
		pre: function pre() {
			this.loading = true;

			this.alerts = {
				type: null,
				title: null,
				message: null
			};
		},
		post: function post() {
			this.loading = false;
		},
		error: function error() {
			this.alerts = {
				type: 'danger',
				title: 'Ups!',
				message: 'Terjadi kesalahan internal'
			};
		},
		getCategory: function getCategory(url) {
			var _this = this;

			axios.get(url).then(function (response) {
				_this.categories = response.data;
			});
		},
		create: function create(e) {
			var _this2 = this;

			this.pre();

			axios.post(e.target.action, this.forms).then(function (response) {

				_this2.alerts = response.data.alerts;

				_this2.forms = {
					category: '',
					origin: null,
					locale: null,
					description: null
				};

				_this2.errors = [];

				_this2.post();
			}).catch(function (error) {
				if (error.response.status == 422) {
					_this2.errors = error.response.data;
				} else {
					_this2.error();
				}

				_this2.post();
			});
		}
	}
});

/***/ }),

/***/ 273:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(17);


/***/ })

/******/ });