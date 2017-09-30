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
/******/ 	return __webpack_require__(__webpack_require__.s = 259);
/******/ })
/************************************************************************/
/******/ ({

/***/ 16:
/***/ (function(module, exports) {

$(function () {
  $('li.glosarium').addClass('active');
});

new Vue({
  el: '#content',
  data: {
    loginAlert: false,
    total: 0,
    words: words,
    word: word,
    categories: []
  },

  mounted: function mounted() {
    this.sameCategory(routes.glosariumWordSimilar);
  },


  computed: {
    totalVote: function totalVote() {
      if (!word.description) {
        return 0;
      }

      return this.word.description.vote_up - this.word.description.vote_down;
    }
  },

  methods: {
    sameCategory: function sameCategory(url) {
      var _this = this;

      axios.post(url, {
        origin: this.words.origin
      }).then(function (response) {
        _this.categories = response.data;
      });
    },
    vote: function vote() {
      var _this2 = this;

      var type = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'up';

      if (!Laravel.auth) {
        this.loginAlert = true;
      } else {
        var url = type == 'up' ? routes.glosariumDescriptionUp : routes.glosariumDescriptionDown;

        axios.post(url, { id: this.word.description.id }).then(function (response) {
          if (type == 'up') {
            _this2.word.description.vote_up = response.data.vote_up;
          } else {
            _this2.word.description.vote_down = response.data.vote_down;
          }
        }).catch(function (error) {});
      }
    },
    favorite: function favorite() {
      var _this3 = this;

      axios.post(routes.glosariumFavoritePost, { slug: this.word.slug }).then(function (response) {
        if (response.data.success == true) {
          _this3.word.favorites_count += 1;
        }
      }).catch(function (error) {
        if (error.response.status == 401) {
          _this3.loginAlert = true;
        }
      });
    }
  }
});

/***/ }),

/***/ 259:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(16);


/***/ })

/******/ });