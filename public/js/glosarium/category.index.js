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
/******/ 	return __webpack_require__(__webpack_require__.s = 255);
/******/ })
/************************************************************************/
/******/ ({

/***/ 12:
/***/ (function(module, exports) {

$(function () {
    $('li.category').addClass('active');
});

var category = new Vue({
    el: '#app',
    data: {
        categories: [],
        loading: false,
        words: null,
        nextUrl: null,
        keyword: ''
    },

    mounted: function mounted() {
        this.getCategory(routes.glosariumCategoryPaginate);
        this.getWord(routes.glosariumWordLatest);
    },


    methods: {
        getWord: function getWord(url) {
            var _this = this;

            axios.post(url).then(function (response) {

                _this.words = response.data.words;

                _this.loading = false;
            }, function (response) {

                _this.loading = false;
            });
        },
        getCategory: function getCategory(url) {
            var _this2 = this;

            this.$Progress.start();

            axios.get(url).then(function (response) {

                _this2.categories = response.data;

                _this2.loading = false;

                _this2.$Progress.finish();
            }, function (response) {
                _this2.loading = false;

                _this2.$Progress.fail();
            });
        },
        loadMore: function loadMore(url) {
            var _this3 = this;

            this.loading = true;

            axios.get(url).then(function (response) {
                var body = response.data;

                _this3.categories = {
                    next_page_url: body.next_page_url,
                    prev_page_url: body.prev_page_url,
                    from: body.from,
                    to: body.to,
                    per_page: body.per_page,
                    current_page: body.current_page,
                    last_page: body.last_page,
                    total: body.total,
                    data: _this3.categories.data
                };

                var index = 0;
                for (index in response.data.data) {
                    _this3.categories.data.push(response.data.data[index]);
                }

                _this3.loading = false;
            });
        },
        search: function search(keyword) {
            var _this4 = this;

            this.keyword = keyword;

            this.$Progress.start();
            this.loading = true;

            var url = categories.index + '?keyword=' + keyword;

            axios.get(url).then(function (response) {
                _this4.categories = response.data;

                _this4.$Progress.finish();
                _this4.loading = false;
            }).catch(function (e) {
                _this4.$Progress.fail();
                _this4.loading = false;
            });
        }
    }
});

/***/ }),

/***/ 255:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(12);


/***/ })

/******/ });