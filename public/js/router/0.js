webpackJsonp([0],{

/***/ 1:
/***/ (function(module, exports) {

// this module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle

module.exports = function normalizeComponent (
  rawScriptExports,
  compiledTemplate,
  scopeId,
  cssModules
) {
  var esModule
  var scriptExports = rawScriptExports = rawScriptExports || {}

  // ES6 modules interop
  var type = typeof rawScriptExports.default
  if (type === 'object' || type === 'function') {
    esModule = rawScriptExports
    scriptExports = rawScriptExports.default
  }

  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (compiledTemplate) {
    options.render = compiledTemplate.render
    options.staticRenderFns = compiledTemplate.staticRenderFns
  }

  // scopedId
  if (scopeId) {
    options._scopeId = scopeId
  }

  // inject cssModules
  if (cssModules) {
    var computed = Object.create(options.computed || null)
    Object.keys(cssModules).forEach(function (key) {
      var module = cssModules[key]
      computed[key] = function () { return module }
    })
    options.computed = computed
  }

  return {
    esModule: esModule,
    exports: scriptExports,
    options: options
  }
}


/***/ }),

/***/ 23:
/***/ (function(module, exports, __webpack_require__) {


/* styles */
__webpack_require__(36)

var Component = __webpack_require__(1)(
  /* script */
  __webpack_require__(27),
  /* template */
  __webpack_require__(32),
  /* scopeId */
  "data-v-1d24b542",
  /* cssModules */
  null
)
Component.options.__file = "/home/yugo/Documents/Web/PHP/glosarium/resources/assets/js/components/app/common/search.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] search.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-1d24b542", Component.options)
  } else {
    hotAPI.reload("data-v-1d24b542", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 24:
/***/ (function(module, exports, __webpack_require__) {

var Component = __webpack_require__(1)(
  /* script */
  __webpack_require__(28),
  /* template */
  __webpack_require__(34),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/home/yugo/Documents/Web/PHP/glosarium/resources/assets/js/components/app/common/title.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] title.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-aa5bb01e", Component.options)
  } else {
    hotAPI.reload("data-v-aa5bb01e", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 25:
/***/ (function(module, exports, __webpack_require__) {

var Component = __webpack_require__(1)(
  /* script */
  __webpack_require__(29),
  /* template */
  __webpack_require__(33),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/home/yugo/Documents/Web/PHP/glosarium/resources/assets/js/components/app/glosarium/category/all.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] all.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-2751c595", Component.options)
  } else {
    hotAPI.reload("data-v-2751c595", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 26:
/***/ (function(module, exports, __webpack_require__) {

var Component = __webpack_require__(1)(
  /* script */
  __webpack_require__(30),
  /* template */
  __webpack_require__(35),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/home/yugo/Documents/Web/PHP/glosarium/resources/assets/js/components/app/glosarium/word/latest.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] latest.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-f5c1c192", Component.options)
  } else {
    hotAPI.reload("data-v-f5c1c192", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 27:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
   name: 'AppSearch',
   props: {
      loading: false,
      placeholder: String
   },

   data: function data() {
      return {
         state: {
            keyword: null
         }
      };
   },


   methods: {
      search: function search() {
         this.$bus.$emit('search', this.state.keyword);
      }
   }
});

/***/ }),

/***/ 28:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
   name: 'AppTitle',
   props: {
      img: String,
      url: String
   }
});

/***/ }),

/***/ 281:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
   data: function data() {
      return {
         url: '/admin/bot/keyword/paginate',
         keywords: []
      };
   },
   mounted: function mounted() {
      this.paginate(this.url);
   },


   methods: {
      paginate: function paginate(url) {
         var _this = this;

         var params = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

         axios.get(url, { params: params }).then(function (response) {
            _this.keywords = response.data;
         });
      }
   }
});

/***/ }),

/***/ 282:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
	name: 'contactForm',

	props: {
		action: String
	},
	data: function data() {
		return {
			auth: false,
			loading: false,
			errors: [],
			state: {
				email: '',
				subject: '',
				message: ''
			},
			alerts: {
				type: null,
				title: null,
				message: null
			}
		};
	},
	mounted: function mounted() {
		// disabled search form
		this.$root.$data.app.search = false;

		this.auth = Laravel.auth;

		if (Laravel.auth) {
			this.state.email = Laravel.user.email;
		}
	},


	methods: {
		getError: function getError(object) {
			return _.head(object);
		},


		beforeSend: function beforeSend() {
			this.loading = true;

			this.alerts = {
				type: null,
				message: null
			};
		},

		afterSend: function afterSend() {
			this.state = forms;
			this.errors = [];

			this.loading = false;
		},

		send: function send(e) {
			var _this = this;

			this.$Progress.start();
			this.beforeSend();

			axios.post(e.target.action, this.state).then(function (response) {
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

/***/ 283:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
   data: function data() {
      return {
         loading: false,
         errors: [],
         categories: [],
         state: {
            category: '',
            lang: 'en',
            origin: '',
            locale: ''
         }
      };
   },
   mounted: function mounted() {
      var _this = this;

      axios.get('/user/glosarium/category/all').then(function (response) {
         _this.categories = response.data;
      });
   },


   methods: {
      store: function store(e) {
         var _this2 = this;

         this.loading = true;

         axios.post(e.target.action, this.state).then(function (response) {
            if (response.data.status == true) {
               _this2.errors = [];

               _this2.state = {
                  category: '',
                  lang: '',
                  origin: '',
                  locale: ''
               };
            }

            _this2.loading = false;
         }).catch(function (error) {
            if (!_.isEmpty(error)) {
               if (error.response.status == 422) {
                  _this2.errors = error.response.data;
               }
            }

            _this2.loading = false;
         });
      }
   }
});

/***/ }),

/***/ 284:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
   name: 'GlosariumCategoryIndex',

   props: {
      limit: {
         type: Number,
         default: 10
      }
   },

   data: function data() {
      return {
         loading: false,
         categories: [],
         keyword: ''
      };
   },
   mounted: function mounted() {
      var _this = this;

      // enable search form
      this.$root.$data.app.search = true;

      var params = {
         limit: this.limit
      };

      this.loading = true;
      axios.get('/glosarium/category/paginate', { params: params }).then(function (response) {
         _this.categories = response.data;

         _this.loading = false;
      });

      this.$bus.$on('search', function (keyword) {
         _this.getCategory(routes.glosariumCategoryPaginate, {
            keyword: keyword
         });
      });
   },


   methods: {
      getCategory: function getCategory(url) {
         var _this2 = this;

         var params = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

         this.$Progress.start();
         axios.get(url, { params: params }).then(function (response) {
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
      }
   },

   filters: {
      url: function url(category) {
         return {
            name: 'glosarium.category.show',
            params: {
               slug: category.slug
            }
         };
      }
   }
});

/***/ }),

/***/ 285:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
   name: 'CategoryShow',
   data: function data() {
      return {
         loading: false,
         keyword: '',
         url: '/glosarium/category/show',
         category: {},
         words: []
      };
   },
   mounted: function mounted() {
      var _this = this;

      // show search form
      this.$root.$data.app.search = true;

      // get category detail
      var slug = this.$route.params.slug;
      axios.get(this.url, { params: { slug: slug } }).then(function (response) {
         _this.category = response.data;

         // get words
         _this.paginate('/glosarium/word/paginate', {
            category: _this.category.slug
         });
      });
   },


   methods: {
      paginate: function paginate(url) {
         var _this2 = this;

         var params = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

         this.$Progress.start();

         axios.get(url, { params: params }).then(function (response) {
            _this2.words = response.data;
            _this2.$Progress.finish();
         }).catch(function (error) {
            _this2.$Progress.fail();
         });
      }
   },

   filters: {
      url: function url(word) {
         return {
            name: 'glosarium.word.show',
            params: {
               category: word.category.slug,
               word: word.slug
            }
         };
      }
   }
});

/***/ }),

/***/ 286:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
   data: function data() {
      return {
         loading: false,
         alert: {},
         url: '/admin/glosarium/category/paginate',
         categories: []
      };
   },
   mounted: function mounted() {
      this.paginate(this.url);
   },


   methods: {
      paginate: function paginate(url) {
         var _this = this;

         this.loading = true;

         axios.get(url).then(function (response) {
            _this.categories = response.data;

            _this.loading = false;
         });
      }
   }
});

/***/ }),

/***/ 287:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
   data: function data() {
      return {
         loading: false,
         errors: [],
         categories: [],
         state: {
            category: '',
            lang: 'en',
            origin: '',
            locale: ''
         }
      };
   },
   mounted: function mounted() {
      var _this = this;

      axios.get('/user/glosarium/category/all').then(function (response) {
         _this.categories = response.data;
      });
   },


   methods: {
      store: function store(e) {
         var _this2 = this;

         this.loading = true;

         axios.post(e.target.action, this.state).then(function (response) {
            if (response.data.status == true) {
               _this2.errors = [];

               _this2.state = {
                  category: '',
                  lang: '',
                  origin: '',
                  locale: ''
               };
            }

            _this2.loading = false;
         }).catch(function (error) {
            if (!_.isEmpty(error)) {
               if (error.response.status == 422) {
                  _this2.errors = error.response.data;
               }
            }

            _this2.loading = false;
         });
      }
   }
});

/***/ }),

/***/ 288:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
   data: function data() {
      return {
         alert: {},
         loading: false,
         errors: [],
         categories: [],
         state: {
            category: '',
            lang: 'en',
            origin: '',
            locale: ''
         }
      };
   },
   mounted: function mounted() {
      var _this = this;

      var url = '/user/glosarium/word/' + this.$route.params.slug;
      axios.get(url).then(function (response) {
         console.log(response.data);
         _this.state = response.data;

         // get category
         axios.get('/user/glosarium/category/all').then(function (response) {
            _this.categories = response.data;
         });
      });
   },


   methods: {
      update: function update(e) {
         var _this2 = this;

         this.loading = true;

         axios.put(e.target.action, this.state).then(function (response) {
            if (response.data.status == true) {
               _this2.alert = {
                  type: 'success',
                  message: response.data.message
               };

               _this2.errors = [];
            }

            _this2.loading = false;
         }).catch(function (error) {
            if (!_.isEmpty(error)) {
               if (error.response.status == 422) {
                  _this2.errors = error.response.data;
               }
            }

            _this2.loading = false;
         });
      }
   }
});

/***/ }),

/***/ 289:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
   name: 'GlosariumWordIndex',

   data: function data() {
      return {
         loading: false,
         url: '/glosarium/word/paginate/',
         keyword: '',
         words: []
      };
   },
   mounted: function mounted() {
      var _this = this;

      // enable search form
      this.$root.$data.app.search = true;
      this.paginate(this.url);

      // event on pagination clicked
      this.$bus.$on('pagination', function (url) {
         _this.paginate(url);
      });

      // event on searched
      this.$bus.$on('search', function (keyword) {
         var params = {
            keyword: keyword
         };
         _this.paginate(_this.url, params);
      });
   },


   methods: {
      paginate: function paginate(url) {
         var _this2 = this;

         var params = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

         this.$Progress.start();
         this.loading = true;

         axios.get(url, { params: params }).then(function (response) {
            _this2.words = response.data;

            _this2.$Progress.finish();
            _this2.loading = false;
         }).catch(function (error) {
            _this2.$Progress.fail();
            _this2.loading = false;
         });
      }
   },

   filters: {
      url: function url(word) {
         return {
            name: 'glosarium.word.show',
            params: {
               category: word.category.slug,
               word: word.slug
            }
         };
      }
   }
});

/***/ }),

/***/ 29:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
   name: 'GlosariumCategoryAll',

   data: function data() {
      return {
         loading: false,
         url: '/glosarium/category/all',
         categories: []
      };
   },
   mounted: function mounted() {
      var _this = this;

      axios.get(this.url).then(function (response) {
         _this.categories = response.data;
      }).catch(function (error) {
         console.error('Failed to get categories.');
      });
   },


   filters: {
      url: function url(slug) {
         return {
            name: 'glosarium.category.show',
            params: {
               slug: slug
            }
         };
      }
   }
});

/***/ }),

/***/ 290:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
   data: function data() {
      return {
         url: '/user/glosarium/word/moderation',
         words: []
      };
   },
   mounted: function mounted() {
      this.paginate(this.url);
   },


   methods: {
      paginate: function paginate(url) {
         var _this = this;

         var params = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

         this.$Progress.start();

         axios.get(url, params).then(function (response) {
            _this.words = response.data;

            _this.$Progress.finish();
         });
      }
   }
});

/***/ }),

/***/ 291:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
   name: 'GlosariumWordShow',

   data: function data() {
      return {
         url: '/word/show',
         loginAlert: false,
         totalVote: 0,
         word: {},
         words: []
      };
   },
   mounted: function mounted() {
      var _this = this;

      // disable search form
      this.$root.$data.app.search = false;

      // get word detail
      var params = {
         category: this.$route.params.category,
         word: this.$route.params.word
      };
      axios.post(this.url, params).then(function (response) {
         _this.word = response.data;

         // in same category
         var params = {
            origin: _this.word.origin
         };
         axios.post('/word/similar', params).then(function (response) {
            _this.words = response.data;
         });
      }).catch(function (error) {
         if (!_.isEmpty(error)) {
            if (error.response.status == 404) {
               console.error('URL ' + _this.url + ' not found on route.');
            }
         }
      });
   },


   methods: {
      favorite: function favorite() {},
      vote: function vote(type) {}
   },

   filters: {
      url: function url(word) {
         return {
            name: 'glosarium.word.show',
            params: {
               category: word.category.slug,
               word: word.slug
            }
         };
      }
   }
});

/***/ }),

/***/ 292:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
   data: function data() {
      return {
         loading: false,
         url: '/user/glosarium/word/paginate',
         words: []
      };
   },
   mounted: function mounted() {
      var _this = this;

      this.paginate(this.url);

      // on search
      this.$bus.$on('search', function (keyword) {
         var params = {
            keyword: keyword
         };
         _this.paginate(_this.url, params);
      });

      // on pagination
      this.$bus.$on('pagination', function (url) {
         _this.paginate(url);
      });
   },


   methods: {
      paginate: function paginate(url) {
         var _this2 = this;

         var params = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

         this.loading = true;
         axios.get(url, { params: params }).then(function (response) {
            _this2.words = response.data;
            _this2.loading = false;
         });
      }
   }
});

/***/ }),

/***/ 293:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
   props: {
      placeholder: String
   },

   data: function data() {
      return {
         state: {
            keyword: null
         }
      };
   },


   methods: {
      search: function search() {
         this.$bus.$emit('search', this.state.keyword);
      }
   }
});

/***/ }),

/***/ 294:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
   data: function data() {
      return {
         loading: false,
         errors: [],
         alerts: {
            type: 'info',
            message: ''
         },
         state: {
            currentPassword: '',
            password: '',
            confirmPassword: ''
         }
      };
   },


   methods: {
      update: function update(e) {
         var _this = this;

         this.errors = [];
         this.loading = true;

         axios.put(e.target.action, this.state).then(function (response) {
            if (response.data.status) {
               _this.state = {
                  currentPassword: '',
                  password: '',
                  confirmPassword: ''
               };
            }

            _this.loading = false;
         }).catch(function (error) {
            if (!_.isEmpty(error)) {
               if (error.response.status == 422) {
                  _this.errors = error.response.data;
               }
            } else {
               _this.alerts = {
                  type: 'danger',
                  'message': 'Kesalahan internal server.'
               };
            }

            _this.loading = false;
         });
      }
   }
});

/***/ }),

/***/ 295:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
	props: {
		action: String
	},

	data: function data() {
		return {
			state: {
				name: ''
			}
		};
	},
	mounted: function mounted() {}
});

/***/ }),

/***/ 296:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
   props: {
      limit: Number
   },

   data: function data() {
      return {
         loading: false,
         users: []
      };
   },
   mounted: function mounted() {
      var _this = this;

      var defaultParams = {
         limit: this.limit
      };

      axios.get(routes.adminUserPaginate, { defaultParams: defaultParams }).then(function (response) {
         _this.users = response.data;

         _this.$bus.$emit('pagination', _this.users);
      });

      this.$bus.$on('search', function (keyword) {
         var params = {
            keyword: keyword
         };

         _this.getUser(routes.adminUserPaginate, params);
      });

      this.$bus.$on('pagination-next', function (url) {
         _this.getUser(url);
      });

      this.$bus.$on('pagination-prev', function (url) {
         _this.getUser(url);
      });
   },


   methods: {
      getUser: function getUser(url) {
         var _this2 = this;

         var params = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

         axios.get(url, { params: params }).then(function (response) {
            _this2.users = response.data;

            _this2.$bus.$on('pagination', _this2.users);
         });
      }
   }
});

/***/ }),

/***/ 297:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
	mounted: function mounted() {}
});

/***/ }),

/***/ 298:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(4)();
exports.push([module.i, "\n.notification-list[data-v-299b2e7c], .n-user-list[data-v-299b2e7c] {\n    list-style: outside none none;\n    margin: 0;\n    padding: 0;\n}\n.notification-list > li[data-v-299b2e7c] {\n    border-bottom: 1px solid #eee;\n    margin-bottom: 5px;\n    padding: 5px 0;\n}\n.notification-list .cat-icon[data-v-299b2e7c] {\n    width: 20px;\n}\n.notification-list .avatar[data-v-299b2e7c] {\n    width: 30px;\n}\n.rounded[data-v-299b2e7c] {\n    border-radius: 0.25rem;\n}\n.n-user-list[data-v-299b2e7c]{margin-bottom:5px;\n}\n.n-user-list[data-v-299b2e7c]:after{clear:both; content:''; display:table;\n}\n.n-user-list li[data-v-299b2e7c]{float:left;\n}\n.n-user-list li + li[data-v-299b2e7c]{margin-left:3px;\n}\n.n-user-list li a[data-v-299b2e7c], .n-user-list li a[data-v-299b2e7c]:hober{text-decoration:none;\n}\n", ""]);

/***/ }),

/***/ 299:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(4)();
exports.push([module.i, "\n#custom-search-input[data-v-93d383b6]{\n   padding: 3px;\n   border: solid 1px #E4E4E4;\n   border-radius: 3px;\n   background-color: #fff;\n   margin-bottom: 20px;\n}\n#custom-search-input input[data-v-93d383b6]{\n   border: 0;\n   box-shadow: none;\n}\n#custom-search-input button[data-v-93d383b6]{\n   margin: 2px 0 0 0;\n   background: none;\n   box-shadow: none;\n   border: 0;\n   color: #666666;\n   padding: 0 8px 0 10px;\n   border-left: solid 1px #ccc;\n}\n#custom-search-input button[data-v-93d383b6]:hover{\n   border: 0;\n   box-shadow: none;\n   border-left: solid 1px #ccc;\n}\n#custom-search-input .glyphicon-search[data-v-93d383b6]{\n   font-size: 23px;\n}\n", ""]);

/***/ }),

/***/ 30:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
	props: {
		limit: {
			type: Number,
			default: 10
		}
	},

	data: function data() {
		return {
			loading: false,
			words: []
		};
	},
	mounted: function mounted() {
		var _this = this;

		var params = {
			limit: this.limit
		};
		axios.get('/glosarium/word/latest', { params: params }).then(function (response) {
			_this.words = response.data.words;
		});
	},


	filters: {
		url: function url(word) {
			return {
				name: 'glosarium.word.show',
				params: {
					category: word.category.slug,
					word: word.slug
				}
			};
		}
	}
});

/***/ }),

/***/ 300:
/***/ (function(module, exports, __webpack_require__) {

var Component = __webpack_require__(1)(
  /* script */
  __webpack_require__(281),
  /* template */
  __webpack_require__(327),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/home/yugo/Documents/Web/PHP/glosarium/resources/assets/js/components/app/bot/keyword/table.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] table.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-59717d73", Component.options)
  } else {
    hotAPI.reload("data-v-59717d73", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 301:
/***/ (function(module, exports, __webpack_require__) {

var Component = __webpack_require__(1)(
  /* script */
  __webpack_require__(282),
  /* template */
  __webpack_require__(322),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/home/yugo/Documents/Web/PHP/glosarium/resources/assets/js/components/app/contact/form.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] form.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-26c1cee0", Component.options)
  } else {
    hotAPI.reload("data-v-26c1cee0", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 302:
/***/ (function(module, exports, __webpack_require__) {

var Component = __webpack_require__(1)(
  /* script */
  __webpack_require__(283),
  /* template */
  __webpack_require__(332),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/home/yugo/Documents/Web/PHP/glosarium/resources/assets/js/components/app/glosarium/category/edit.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] edit.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-8c561574", Component.options)
  } else {
    hotAPI.reload("data-v-8c561574", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 303:
/***/ (function(module, exports, __webpack_require__) {

var Component = __webpack_require__(1)(
  /* script */
  __webpack_require__(284),
  /* template */
  __webpack_require__(329),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/home/yugo/Documents/Web/PHP/glosarium/resources/assets/js/components/app/glosarium/category/index.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] index.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-7afd2574", Component.options)
  } else {
    hotAPI.reload("data-v-7afd2574", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 304:
/***/ (function(module, exports, __webpack_require__) {

var Component = __webpack_require__(1)(
  /* script */
  __webpack_require__(285),
  /* template */
  __webpack_require__(326),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/home/yugo/Documents/Web/PHP/glosarium/resources/assets/js/components/app/glosarium/category/show.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] show.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-4625b0b9", Component.options)
  } else {
    hotAPI.reload("data-v-4625b0b9", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 305:
/***/ (function(module, exports, __webpack_require__) {

var Component = __webpack_require__(1)(
  /* script */
  __webpack_require__(286),
  /* template */
  __webpack_require__(330),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/home/yugo/Documents/Web/PHP/glosarium/resources/assets/js/components/app/glosarium/category/table.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] table.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-7c1ca242", Component.options)
  } else {
    hotAPI.reload("data-v-7c1ca242", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 306:
/***/ (function(module, exports, __webpack_require__) {

var Component = __webpack_require__(1)(
  /* script */
  __webpack_require__(287),
  /* template */
  __webpack_require__(325),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/home/yugo/Documents/Web/PHP/glosarium/resources/assets/js/components/app/glosarium/word/create.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] create.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-43a723a8", Component.options)
  } else {
    hotAPI.reload("data-v-43a723a8", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 307:
/***/ (function(module, exports, __webpack_require__) {

var Component = __webpack_require__(1)(
  /* script */
  __webpack_require__(288),
  /* template */
  __webpack_require__(328),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/home/yugo/Documents/Web/PHP/glosarium/resources/assets/js/components/app/glosarium/word/edit.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] edit.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-60a24a3a", Component.options)
  } else {
    hotAPI.reload("data-v-60a24a3a", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 308:
/***/ (function(module, exports, __webpack_require__) {

var Component = __webpack_require__(1)(
  /* script */
  __webpack_require__(289),
  /* template */
  __webpack_require__(318),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/home/yugo/Documents/Web/PHP/glosarium/resources/assets/js/components/app/glosarium/word/index.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] index.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-1542925c", Component.options)
  } else {
    hotAPI.reload("data-v-1542925c", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 309:
/***/ (function(module, exports, __webpack_require__) {

var Component = __webpack_require__(1)(
  /* script */
  __webpack_require__(290),
  /* template */
  __webpack_require__(331),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/home/yugo/Documents/Web/PHP/glosarium/resources/assets/js/components/app/glosarium/word/moderation.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] moderation.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-7f6efd54", Component.options)
  } else {
    hotAPI.reload("data-v-7f6efd54", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 31:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(4)();
exports.push([module.i, "\n#custom-search-input[data-v-1d24b542]{\n   padding: 3px;\n   border: solid 1px #E4E4E4;\n   border-radius: 3px;\n   background-color: #fff;\n   margin-bottom: 20px;\n}\n#custom-search-input input[data-v-1d24b542]{\n   border: 0;\n   box-shadow: none;\n}\n#custom-search-input button[data-v-1d24b542]{\n   margin: 2px 0 0 0;\n   background: none;\n   box-shadow: none;\n   border: 0;\n   color: #666666;\n   padding: 0 8px 0 10px;\n   border-left: solid 1px #ccc;\n}\n#custom-search-input button[data-v-1d24b542]:hover{\n   border: 0;\n   box-shadow: none;\n   border-left: solid 1px #ccc;\n}\n#custom-search-input .glyphicon-search[data-v-1d24b542]{\n   font-size: 23px;\n}\n", ""]);

/***/ }),

/***/ 310:
/***/ (function(module, exports, __webpack_require__) {

var Component = __webpack_require__(1)(
  /* script */
  __webpack_require__(291),
  /* template */
  __webpack_require__(320),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/home/yugo/Documents/Web/PHP/glosarium/resources/assets/js/components/app/glosarium/word/show.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] show.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-2619f4a6", Component.options)
  } else {
    hotAPI.reload("data-v-2619f4a6", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 311:
/***/ (function(module, exports, __webpack_require__) {

var Component = __webpack_require__(1)(
  /* script */
  __webpack_require__(292),
  /* template */
  __webpack_require__(334),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/home/yugo/Documents/Web/PHP/glosarium/resources/assets/js/components/app/glosarium/word/table.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] table.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-a20c2864", Component.options)
  } else {
    hotAPI.reload("data-v-a20c2864", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 312:
/***/ (function(module, exports, __webpack_require__) {


/* styles */
__webpack_require__(337)

var Component = __webpack_require__(1)(
  /* script */
  __webpack_require__(293),
  /* template */
  __webpack_require__(333),
  /* scopeId */
  "data-v-93d383b6",
  /* cssModules */
  null
)
Component.options.__file = "/home/yugo/Documents/Web/PHP/glosarium/resources/assets/js/components/app/search.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] search.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-93d383b6", Component.options)
  } else {
    hotAPI.reload("data-v-93d383b6", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 313:
/***/ (function(module, exports, __webpack_require__) {

var Component = __webpack_require__(1)(
  /* script */
  __webpack_require__(294),
  /* template */
  __webpack_require__(321),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/home/yugo/Documents/Web/PHP/glosarium/resources/assets/js/components/app/user/change-password.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] change-password.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-26c12f91", Component.options)
  } else {
    hotAPI.reload("data-v-26c12f91", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 314:
/***/ (function(module, exports, __webpack_require__) {

var Component = __webpack_require__(1)(
  /* script */
  __webpack_require__(295),
  /* template */
  __webpack_require__(319),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/home/yugo/Documents/Web/PHP/glosarium/resources/assets/js/components/app/user/create.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] create.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-1e8068da", Component.options)
  } else {
    hotAPI.reload("data-v-1e8068da", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 315:
/***/ (function(module, exports, __webpack_require__) {

var Component = __webpack_require__(1)(
  /* script */
  null,
  /* template */
  __webpack_require__(335),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/home/yugo/Documents/Web/PHP/glosarium/resources/assets/js/components/app/user/dashboard.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] dashboard.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-bcb4ae66", Component.options)
  } else {
    hotAPI.reload("data-v-bcb4ae66", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 316:
/***/ (function(module, exports, __webpack_require__) {

var Component = __webpack_require__(1)(
  /* script */
  __webpack_require__(296),
  /* template */
  __webpack_require__(324),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/home/yugo/Documents/Web/PHP/glosarium/resources/assets/js/components/app/user/index.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] index.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-2fc6908b", Component.options)
  } else {
    hotAPI.reload("data-v-2fc6908b", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 317:
/***/ (function(module, exports, __webpack_require__) {


/* styles */
__webpack_require__(336)

var Component = __webpack_require__(1)(
  /* script */
  __webpack_require__(297),
  /* template */
  __webpack_require__(323),
  /* scopeId */
  "data-v-299b2e7c",
  /* cssModules */
  null
)
Component.options.__file = "/home/yugo/Documents/Web/PHP/glosarium/resources/assets/js/components/app/user/notification.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] notification.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-299b2e7c", Component.options)
  } else {
    hotAPI.reload("data-v-299b2e7c", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 318:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "row"
  }, [_c('div', {
    staticClass: "col-md-9"
  }, [_c('div', {
    staticClass: "block-section-sm box-list-area"
  }, [_c('div', {
    staticClass: "row hidden-xs"
  }, [_c('div', {
    staticClass: "col-sm-6"
  }, [(_vm.keyword) ? _c('p', [_c('strong', {
    staticClass: "color-black"
  }, [_vm._v("Hasil pencarian untuk \"" + _vm._s(_vm.keyword) + "\"")])]) : _c('p', [_c('strong', {
    staticClass: "color-black"
  }, [_vm._v("Indeks Glosarium")])])]), _vm._v(" "), _c('div', {
    staticClass: "col-sm-6"
  }, [(_vm.words.data) ? _c('p', {
    staticClass: "text-right"
  }, [_vm._v("\n                  Menampilkan " + _vm._s(_vm.words.from) + " sampai " + _vm._s(_vm.words.to) + " dari total " + _vm._s(_vm.words.total) + " kata.\n               ")]) : _vm._e()])]), _vm._v(" "), (_vm.words.total <= 0) ? _c('div', {
    staticClass: "row"
  }, [_vm._m(0)]) : _vm._e(), _vm._v(" "), _c('pagination', {
    attrs: {
      "data": _vm.words
    }
  }), _vm._v(" "), _c('div', {
    staticClass: "box-list"
  }, _vm._l((_vm.words.data), function(word, index) {
    return _c('div', {
      staticClass: "item"
    }, [_c('div', {
      staticClass: "row"
    }, [_c('div', {
      staticClass: "col-md-1 hidden-xs hidden-sm"
    }, [(word.category.metadata.icon) ? _c('div', {
      staticClass: "img-item"
    }, [_c('h2', [_c('i', {
      class: word.category.metadata.icon
    })])]) : _vm._e()]), _vm._v(" "), _c('div', {
      staticClass: "col-md-11"
    }, [_c('h3', {
      staticClass: "no-margin-top"
    }, [_c('router-link', {
      attrs: {
        "to": _vm._f("url")(word)
      }
    }, [_vm._v("\n                           " + _vm._s(word.origin) + "\n                        ")]), _vm._v(" "), _c('small', [_c('a', {
      staticClass: "color-white-mute",
      attrs: {
        "href": word.short_url
      }
    }, [_c('i', {
      staticClass: "fa fa-link"
    })])])], 1), _vm._v(" "), _c('h5', [_c('span', {
      staticClass: "color-black"
    }, [_vm._v(_vm._s(word.locale))]), _vm._v(" - "), _c('span', [_c('a', {
      staticClass: "color-white-mute",
      attrs: {
        "href": word.category.url
      }
    }, [_vm._v(_vm._s(word.category.name))])])]), _vm._v(" "), (word.description) ? _c('p', {
      staticClass: "text-description"
    }, [_vm._v("\n                        " + _vm._s(word.description.description) + "\n                     ")]) : _vm._e(), _vm._v(" "), _c('div', [_c('span', {
      staticClass: "color-white-mute"
    }, [_vm._v(_vm._s(word.updated_diff))])])])])])
  })), _vm._v(" "), _c('pagination', {
    attrs: {
      "loading": _vm.loading,
      "data": _vm.words
    }
  })], 1)]), _vm._v(" "), _c('div', {
    staticClass: "col-md-3"
  }, [_c('div', {
    staticClass: "block-section-sm side-right"
  }, [_c('div', {
    staticClass: "result-filter"
  }, [_vm._m(1), _vm._v(" "), _c('glosarium-category-all')], 1)])])])
},staticRenderFns: [function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-md-12"
  }, [_c('div', {
    staticClass: "alert alert-info"
  }, [_vm._v("\n                  Kata tidak ditemukan dalam pencarian.\n               ")])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('h5', {
    staticClass: "no-margin-top font-bold margin-b-20 "
  }, [_c('a', {
    attrs: {
      "href": "#category",
      "data-toggle": "collapse"
    }
  }, [_vm._v("\n                  Semua Kategori\n                  "), _c('i', {
    staticClass: "fa ic-arrow-toogle fa-angle-right pull-right"
  })])])
}]}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-1542925c", module.exports)
  }
}

/***/ }),

/***/ 319:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', [_c('form', {
    attrs: {
      "action": _vm.action
    }
  }, [_vm._m(0)])])
},staticRenderFns: [function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('label', [_vm._v("Nama")]), _vm._v(" "), _c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "name"
    }
  })])
}]}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-1e8068da", module.exports)
  }
}

/***/ }),

/***/ 32:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('form', {
    staticClass: "form-search-list",
    on: {
      "submit": function($event) {
        $event.preventDefault();
        _vm.search($event)
      }
    }
  }, [_c('div', {
    staticClass: "row"
  }, [_c('div', {
    staticClass: "col-md-12"
  }, [_c('div', {
    attrs: {
      "id": "custom-search-input"
    }
  }, [_c('div', {
    staticClass: "input-group col-md-12"
  }, [_c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.state.keyword),
      expression: "state.keyword"
    }],
    staticClass: "form-control",
    attrs: {
      "disabled": _vm.loading,
      "type": "text",
      "placeholder": _vm.placeholder
    },
    domProps: {
      "value": (_vm.state.keyword)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.state.keyword = $event.target.value
      }
    }
  }), _vm._v(" "), _c('span', {
    staticClass: "input-group-btn"
  }, [_c('button', {
    staticClass: "btn btn-info btn-lg",
    attrs: {
      "disabled": _vm.loading,
      "type": "button"
    }
  }, [_c('i', {
    staticClass: "glyphicon glyphicon-search"
  })])])])])])])])
},staticRenderFns: []}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-1d24b542", module.exports)
  }
}

/***/ }),

/***/ 320:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "row"
  }, [_c('div', {
    staticClass: "col-md-9"
  }, [_c('div', {
    staticClass: "block-section box-item-details"
  }, [_c('div', {
    staticClass: "panel panel-default",
    staticStyle: {
      "margin-top": "-15px"
    }
  }, [_c('div', {
    staticClass: "panel-body"
  }, [_c('div', {
    staticClass: "col-md-6",
    staticStyle: {
      "border-right": "1px solid #ddd",
      "margin-top": "10px"
    }
  }, [_c('h3', {}, [_vm._v(_vm._s(_vm.word.origin))]), _vm._v(" "), _c('span', {
    staticClass: "label label-default"
  }, [_vm._v(_vm._s(_vm.word.lang))])]), _vm._v(" "), _c('div', {
    staticClass: "col-md-6",
    staticStyle: {
      "margin-top": "10px"
    }
  }, [_c('h3', [_vm._v(_vm._s(_vm.word.locale))]), _vm._v(" "), _c('span', {
    staticClass: "label label-default"
  }, [_vm._v("id")])]), _vm._v(" "), _c('div', {
    staticClass: "col-md-12"
  }, [_c('hr'), _vm._v(" "), _c('div', {
    staticClass: "btn-group",
    staticStyle: {
      "margin-bottom": "20px"
    }
  }, [_c('button', {
    staticClass: "btn btn-default btn-sm",
    on: {
      "click": _vm.favorite
    }
  }, [_c('i', {
    class: ['fa fa-heart', _vm.word.favorites_count >= 1 ? 'text-danger' : '']
  }), _vm._v("\n                        " + _vm._s(_vm.word.favorites_count) + "\n                     ")]), _vm._v(" "), (_vm.word.description) ? _c('button', {
    staticClass: "btn btn-default btn-sm",
    on: {
      "click": function($event) {
        _vm.vote('up')
      }
    }
  }, [_c('i', {
    class: ['fa fa-thumbs-up', _vm.word.description.vote_up >= 1 ? 'text-success' : '']
  }), _vm._v("\n                        " + _vm._s(_vm.word.description.vote_up) + "\n                     ")]) : _vm._e(), _vm._v(" "), (_vm.word.description) ? _c('button', {
    staticClass: "btn btn-default btn-sm",
    on: {
      "click": function($event) {
        _vm.vote('down')
      }
    }
  }, [_c('i', {
    class: ['fa fa-thumbs-down', _vm.word.description.vote_down >= 1 ? 'text-warning' : '']
  }), _vm._v("\n                        " + _vm._s(_vm.word.description.vote_down) + "\n                     ")]) : _vm._e()]), _vm._v(" "), _c('alert', {
    attrs: {
      "show": _vm.loginAlert,
      "type": "info",
      "title": "Halo, Orang Asing!"
    }
  }, [_c('p', [_vm._v("Anda harus masuk atau mendaftar terlebih dahulu untuk memberikan pilihan.")])]), _vm._v(" "), _c('alert', {
    attrs: {
      "show": _vm.totalVote < 0,
      "type": "warning",
      "title": "Pemberitahuan!"
    }
  }, [_c('p', [_vm._v("Sehubungan dengan banyaknya respon negatif, deskripsi di bawah bisa jadi tidak sesuai dengan arti kata \"@" + _vm._s(_vm.word.locale) + "\".")])]), _vm._v(" "), (_vm.word.description) ? _c('div', [_c('p', [_vm._v(_vm._s(_vm.word.description.description))]), _vm._v(" "), _c('a', {
    staticClass: "text-truncate",
    attrs: {
      "href": _vm.word.description.url,
      "target": "_blank"
    }
  }, [_vm._v("\n                        " + _vm._s(_vm.word.description.url) + "\n                     ")])]) : _c('div', [_c('p', [_vm._v("Deskripsi tidak ditemukan dalam Wikipedia.org.")])])], 1)])]), _vm._v(" "), _c('div', {
    staticClass: "job-meta"
  }, [_c('ul', {
    staticClass: "list-inline"
  }, [(_vm.word.category) ? _c('li', [_c('i', {
    class: ['fa fa-fw', _vm.word.category.metadata.icon]
  }), _vm._v(" "), _c('router-link', {
    attrs: {
      "to": {
        name: 'glosarium.category.show',
        params: {
          slug: _vm.word.category.slug
        }
      }
    }
  }, [_vm._v("\n                     " + _vm._s(_vm.word.category.name) + "\n                  ")])], 1) : _vm._e(), _vm._v(" "), _c('li', [_c('i', {
    staticClass: "fa fa-link"
  }), _vm._v(" "), _c('a', {
    attrs: {
      "href": _vm.word.short_url
    }
  }, [_vm._v("\n                     " + _vm._s(_vm.word.short_url) + "\n                  ")])])])])])]), _vm._v(" "), _c('div', {
    staticClass: "col-md-3"
  }, [_c('div', {
    staticClass: "block-section-sm side-right"
  }, [_vm._m(0), _vm._v(" "), _c('div', {
    staticClass: "result-filter"
  }, [_vm._m(1), _vm._v(" "), _c('ul', _vm._l((_vm.words), function(similar) {
    return _c('li', [_c('router-link', {
      attrs: {
        "to": _vm._f("url")(similar)
      }
    }, [_vm._v("\n                     " + _vm._s(similar.origin) + " (" + _vm._s(similar.category.name) + ")\n                  ")])], 1)
  })), _vm._v(" "), _c('hr'), _vm._v(" "), _c('h5', [_vm._v("Sebaran")]), _vm._v(" "), _vm._m(2)])])])])
},staticRenderFns: [function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "row text-center"
  }, [_c('a', {
    attrs: {
      "href": "https://line.me/R/ti/p/%40ola9657y"
    }
  }, [_c('img', {
    attrs: {
      "src": "/images/line.jpg"
    }
  })])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('h5', {
    staticClass: "no-margin-top font-bold margin-b-20 "
  }, [_c('a', {
    attrs: {
      "href": "#same-words",
      "data-toggle": "collapse"
    }
  }, [_vm._v("Dalam Kategori yang Sama"), _c('i', {
    staticClass: "fa ic-arrow-toogle fa-angle-right pull-right"
  })])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('p', {
    staticClass: "share-btns"
  }, [_c('a', {
    staticClass: "btn btn-primary",
    attrs: {
      "href": "https://www.facebook.com/sharer/sharer.php?u="
    }
  }, [_c('i', {
    staticClass: "fa fa-facebook"
  })]), _vm._v(" "), _c('a', {
    staticClass: "btn btn-info",
    attrs: {
      "href": "https://twitter.com/intent/tweet?url=&text=Padanan kata dalam  adalah.&hashtags=padanan,glosarium"
    }
  }, [_c('i', {
    staticClass: "fa fa-twitter"
  })]), _vm._v(" "), _c('a', {
    staticClass: "btn btn-danger",
    attrs: {
      "href": "https://plus.google.com/share?url="
    }
  }, [_c('i', {
    staticClass: "fa fa-google-plus"
  })])])
}]}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-2619f4a6", module.exports)
  }
}

/***/ }),

/***/ 321:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "panel panel-default"
  }, [_c('div', {
    staticClass: "panel-heading"
  }, [_vm._v("Ubah Sandi Lewat")]), _vm._v(" "), _c('div', {
    staticClass: "panel-body"
  }, [_c('form', {
    attrs: {
      "action": "/password/update",
      "method": "post"
    },
    on: {
      "submit": function($event) {
        $event.preventDefault();
        _vm.update($event)
      }
    }
  }, [(_vm.alerts.message) ? _c('div', {
    staticClass: "['alert', alert.type]"
  }, [_vm._v("\n            " + _vm._s(_vm.alert.message) + "\n         ")]) : _vm._e(), _vm._v(" "), _c('div', {
    class: ['form-group', _vm.errors.currentPassword ? 'has-error' : '']
  }, [_c('label', {
    staticClass: "control-label"
  }, [_vm._v("Sandi Lewat Lama")]), _vm._v(" "), _c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.state.currentPassword),
      expression: "state.currentPassword"
    }],
    staticClass: "form-control",
    attrs: {
      "disabled": _vm.loading,
      "type": "password"
    },
    domProps: {
      "value": (_vm.state.currentPassword)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.state.currentPassword = $event.target.value
      }
    }
  }), _vm._v(" "), (_vm.errors.currentPassword) ? _c('span', {
    staticClass: "label label-danger"
  }, [_vm._v(_vm._s(_vm.errors.currentPassword[0]))]) : _vm._e()]), _vm._v(" "), _c('div', {
    class: ['form-group', _vm.errors.password ? 'has-error' : '']
  }, [_c('label', {
    staticClass: "control-label"
  }, [_vm._v("Sandi Lewat")]), _vm._v(" "), _c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.state.password),
      expression: "state.password"
    }],
    staticClass: "form-control",
    attrs: {
      "disabled": _vm.loading,
      "type": "password"
    },
    domProps: {
      "value": (_vm.state.password)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.state.password = $event.target.value
      }
    }
  }), _vm._v(" "), (_vm.errors.password) ? _c('span', {
    staticClass: "label label-danger"
  }, [_vm._v(_vm._s(_vm.errors.password[0]))]) : _vm._e()]), _vm._v(" "), _c('div', {
    class: ['form-group', _vm.errors.confirmPassword ? 'has-error' : '']
  }, [_c('label', {
    staticClass: "control-label"
  }, [_vm._v("Konfirmasi Sandi Lewat")]), _vm._v(" "), _c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.state.confirmPassword),
      expression: "state.confirmPassword"
    }],
    staticClass: "form-control",
    attrs: {
      "disabled": _vm.loading,
      "type": "password"
    },
    domProps: {
      "value": (_vm.state.confirmPassword)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.state.confirmPassword = $event.target.value
      }
    }
  }), _vm._v(" "), (_vm.errors.confirmPassword) ? _c('span', {
    staticClass: "label label-danger"
  }, [_vm._v(_vm._s(_vm.errors.confirmPassword[0]))]) : _vm._e()]), _vm._v(" "), _c('button', {
    staticClass: "btn btn-theme btn-t-primary",
    attrs: {
      "disabled": _vm.loading,
      "type": "submit"
    }
  }, [_vm._v("\n            Ubah Sandi Lewat\n            "), _c('loader', {
    attrs: {
      "show": _vm.loading
    }
  })], 1)])])])
},staticRenderFns: []}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-26c12f91", module.exports)
  }
}

/***/ }),

/***/ 322:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "white-space-20"
  }, [_c('vue-progress-bar'), _vm._v(" "), _c('div', {
    staticClass: "row"
  }, [_c('div', {
    staticClass: "col-md-8 col-md-offset-2"
  }, [_vm._m(0), _vm._v(" "), _c('hr'), _vm._v(" "), _c('form', {
    attrs: {
      "action": "/contact",
      "method": "post"
    },
    on: {
      "submit": function($event) {
        $event.preventDefault();
        _vm.send($event)
      }
    }
  }, [_c('div', {
    class: ['form-group', _vm.errors.email ? 'has-error' : '']
  }, [_c('label', [_vm._v("Pos-El (Pos Elektronik)")]), _vm._v(" "), _c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.state.email),
      expression: "state.email"
    }],
    staticClass: "form-control",
    attrs: {
      "disabled": _vm.auth,
      "type": "text"
    },
    domProps: {
      "value": (_vm.state.email)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.state.email = $event.target.value
      }
    }
  }), _vm._v(" "), (_vm.errors.email) ? _c('span', {
    staticClass: "label label-danger"
  }, [_vm._v(_vm._s(_vm.getError(_vm.errors.email)))]) : _vm._e()]), _vm._v(" "), _c('div', {
    class: ['form-group', _vm.errors.subject ? 'has-error' : '']
  }, [_c('label', [_vm._v("Subjek")]), _vm._v(" "), _c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.state.subject),
      expression: "state.subject"
    }],
    staticClass: "form-control",
    attrs: {
      "disabled": _vm.loading,
      "type": "text"
    },
    domProps: {
      "value": (_vm.state.subject)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.state.subject = $event.target.value
      }
    }
  }), _vm._v(" "), (_vm.errors.subject) ? _c('span', {
    staticClass: "label label-danger"
  }, [_vm._v(_vm._s(_vm.getError(_vm.errors.subject)))]) : _vm._e()]), _vm._v(" "), _c('div', {
    class: ['form-group', _vm.errors.message ? 'has-error' : '']
  }, [_c('label', [_vm._v("Pesan")]), _vm._v(" "), _c('textarea', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.state.message),
      expression: "state.message"
    }],
    staticClass: "form-control",
    attrs: {
      "disabled": _vm.loading,
      "rows": "6"
    },
    domProps: {
      "value": (_vm.state.message)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.state.message = $event.target.value
      }
    }
  }), _vm._v(" "), (_vm.errors.message) ? _c('span', {
    staticClass: "label label-danger"
  }, [_vm._v(_vm._s(_vm.getError(_vm.errors.message)))]) : _vm._e()]), _vm._v(" "), _c('div', {
    staticClass: "form-group text-center"
  }, [_c('div', {
    staticClass: "white-space-10"
  }), _vm._v(" "), _c('button', {
    staticClass: "btn btn-theme btn-lg btn-long btn-t-primary btn-pill",
    attrs: {
      "disabled": _vm.loading,
      "type": "submit"
    }
  }, [_vm._v("Kirim Pesan "), _c('loader', {
    attrs: {
      "show": _vm.loading
    }
  })], 1)])])])])], 1)
},staticRenderFns: [function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('h2', {
    staticClass: "text-center"
  }, [_vm._v("\n               Kontak Kami "), _c('br'), _vm._v(" "), _c('small', [_vm._v("Sampaikan salam, saran, dan kritik demi kemajuan dan kenyamanan penggunaan aplikasi Glosarium")])])
}]}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-26c1cee0", module.exports)
  }
}

/***/ }),

/***/ 323:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _vm._m(0)
},staticRenderFns: [function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "panel panel-default"
  }, [_c('div', {
    staticClass: "panel-heading"
  }, [_vm._v("Notifikasi")]), _vm._v(" "), _c('div', {
    staticClass: "panel-body"
  }, [_c('div', {
    staticClass: "notifications"
  }, [_c('ul', {
    staticClass: "notification-list"
  }, [_c('li', [_c('div', {
    staticClass: "media"
  }, [_c('div', {
    staticClass: "media-left"
  }, [_c('a', {
    attrs: {
      "href": "#"
    }
  }, [_c('img', {
    staticClass: "media-object cat-icon rounded",
    attrs: {
      "src": "https://cdn4.iconfinder.com/data/icons/mayssam/512/user-128.png",
      "alt": "..."
    }
  })])]), _vm._v(" "), _c('div', {
    staticClass: "media-body"
  }, [_c('ul', {
    staticClass: "n-user-list"
  }, [_c('li', [_c('a', {
    attrs: {
      "href": "#"
    }
  }, [_c('img', {
    staticClass: "avatar rounded",
    attrs: {
      "src": "http://1plusx.com/app/mu-plugins/all-in-one-seo-pack-pro/images/default-user-image.png",
      "alt": "..."
    }
  })])]), _vm._v(" "), _c('li', [_c('a', {
    attrs: {
      "href": "#"
    }
  }, [_c('img', {
    staticClass: "avatar rounded",
    attrs: {
      "src": "http://1plusx.com/app/mu-plugins/all-in-one-seo-pack-pro/images/default-user-image.png",
      "alt": "..."
    }
  })])])]), _vm._v(" "), _c('p', {
    staticClass: "media-heading"
  }, [_c('b', [_vm._v("Ranjeet Rajput")]), _vm._v(" and "), _c('b', [_vm._v("Abhishek Rajput")]), _vm._v(" followed you.")])])])]), _vm._v(" "), _c('li', [_c('div', {
    staticClass: "media"
  }, [_c('div', {
    staticClass: "media-left"
  }, [_c('a', {
    attrs: {
      "href": "#"
    }
  }, [_c('img', {
    staticClass: "media-object cat-icon rounded-circle",
    attrs: {
      "src": "https://cdn4.iconfinder.com/data/icons/mayssam/512/heart-128.png",
      "alt": "..."
    }
  })])]), _vm._v(" "), _c('div', {
    staticClass: "media-body"
  }, [_c('ul', {
    staticClass: "n-user-list"
  }, [_c('li', [_c('a', {
    attrs: {
      "href": "#"
    }
  }, [_c('img', {
    staticClass: "avatar rounded",
    attrs: {
      "src": "http://1plusx.com/app/mu-plugins/all-in-one-seo-pack-pro/images/default-user-image.png",
      "alt": "..."
    }
  })])]), _vm._v(" "), _c('li', [_c('a', {
    attrs: {
      "href": "#"
    }
  }, [_c('img', {
    staticClass: "avatar rounded",
    attrs: {
      "src": "http://1plusx.com/app/mu-plugins/all-in-one-seo-pack-pro/images/default-user-image.png",
      "alt": "..."
    }
  })])]), _vm._v(" "), _c('li', [_c('a', {
    attrs: {
      "href": "#"
    }
  }, [_c('img', {
    staticClass: "avatar rounded",
    attrs: {
      "src": "http://1plusx.com/app/mu-plugins/all-in-one-seo-pack-pro/images/default-user-image.png",
      "alt": "..."
    }
  })])]), _vm._v(" "), _c('li', [_c('a', {
    attrs: {
      "href": "#"
    }
  }, [_c('img', {
    staticClass: "avatar rounded",
    attrs: {
      "src": "http://1plusx.com/app/mu-plugins/all-in-one-seo-pack-pro/images/default-user-image.png",
      "alt": "..."
    }
  })])]), _vm._v(" "), _c('li', [_c('a', {
    attrs: {
      "href": "#"
    }
  }, [_c('img', {
    staticClass: "avatar rounded",
    attrs: {
      "src": "http://1plusx.com/app/mu-plugins/all-in-one-seo-pack-pro/images/default-user-image.png",
      "alt": "..."
    }
  })])])]), _vm._v(" "), _c('p', {
    staticClass: "media-heading"
  }, [_c('b', [_vm._v("Ranjeet Rajput")]), _vm._v(" and 4 others Like your Post.")])])])])])])])])
}]}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-299b2e7c", module.exports)
  }
}

/***/ }),

/***/ 324:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "panel panel-default"
  }, [_c('div', {
    staticClass: "panel-heading"
  }, [_vm._v("Kontributor")]), _vm._v(" "), _c('div', {
    staticClass: "panel-body"
  }, [_c('div', {
    staticClass: "table-responsive"
  }, [(_vm.users.total <= 0) ? _c('div', {
    staticClass: "alert alert-info"
  }, [_vm._v("\n            Kontributor tidak ditemukan.\n         ")]) : _c('table', {
    staticClass: "table table-bordered"
  }, [_c('thead', [_c('tr', [_c('th', [_vm._v("#")]), _vm._v(" "), _c('th', [_vm._v("Name")]), _vm._v(" "), _c('th', [_vm._v("Email")]), _vm._v(" "), _c('th', [_vm._v("Created")]), _vm._v(" "), _c('th', [_vm._v("#")])])]), _vm._v(" "), _c('tbody', _vm._l((_vm.users.data), function(user, index) {
    return _c('tr', [_c('td', [_vm._v(_vm._s(_vm.users.from + index))]), _vm._v(" "), _c('td', [_vm._v(_vm._s(user.name))]), _vm._v(" "), _c('td', [_vm._v(_vm._s(user.email))]), _vm._v(" "), _c('td', [_vm._v(_vm._s(user.created_diff))]), _vm._v(" "), _c('td', [_c('button-edit', {
      attrs: {
        "url": "#"
      }
    }), _vm._v(" "), _c('button-delete', {
      attrs: {
        "url": "#"
      }
    })], 1)])
  }))])])])])
},staticRenderFns: []}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-2fc6908b", module.exports)
  }
}

/***/ }),

/***/ 325:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "panel panel-default"
  }, [_c('div', {
    staticClass: "panel-heading"
  }, [_vm._v("\n      Tambah Kata\n      "), _c('span', {
    staticClass: "pull-right"
  }, [_c('router-link', {
    staticClass: "btn btn-default btn-sm",
    attrs: {
      "to": {
        name: 'glosarium.word'
      }
    }
  }, [_c('i', {
    staticClass: "fa fa-list fa-fw"
  })])], 1)]), _vm._v(" "), _c('div', {
    staticClass: "panel-body"
  }, [_c('form', {
    attrs: {
      "action": "/user/glosarium/word/store",
      "method": "post"
    },
    on: {
      "submit": function($event) {
        $event.preventDefault();
        _vm.store($event)
      }
    }
  }, [_c('div', {
    staticClass: "row"
  }, [_c('div', {
    class: ['form-group col-md-6', _vm.errors.category ? 'has-error' : '']
  }, [_c('label', {
    staticClass: "control-label"
  }, [_vm._v("Kategori")]), _vm._v(" "), _c('select', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.state.category),
      expression: "state.category"
    }],
    staticClass: "form-control",
    on: {
      "change": function($event) {
        var $$selectedVal = Array.prototype.filter.call($event.target.options, function(o) {
          return o.selected
        }).map(function(o) {
          var val = "_value" in o ? o._value : o.value;
          return val
        });
        _vm.state.category = $event.target.multiple ? $$selectedVal : $$selectedVal[0]
      }
    }
  }, [_c('option', {
    attrs: {
      "value": ""
    }
  }, [_vm._v("Pilih Kategori")]), _vm._v(" "), _vm._l((_vm.categories), function(category) {
    return _c('option', {
      domProps: {
        "value": category.id
      }
    }, [_vm._v("\n                     " + _vm._s(category.name) + "\n                  ")])
  })], 2), _vm._v(" "), (_vm.errors.category) ? _c('span', {
    staticClass: "label label-danger"
  }, [_vm._v(_vm._s(_vm.errors.category[0]))]) : _vm._e()])]), _vm._v(" "), _c('div', {
    staticClass: "row"
  }, [_c('div', {
    class: ['form-group col-md-3', _vm.errors.lang ? 'has-error' : '']
  }, [_c('label', {
    staticClass: "control-label"
  }, [_vm._v("Bahasa Asal")]), _vm._v(" "), _c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.state.lang),
      expression: "state.lang"
    }],
    staticClass: "form-control",
    attrs: {
      "disabled": _vm.loading,
      "type": "text"
    },
    domProps: {
      "value": (_vm.state.lang)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.state.lang = $event.target.value
      }
    }
  }), _vm._v(" "), (_vm.errors.lang) ? _c('span', {
    staticClass: "label label-danger"
  }, [_vm._v(_vm._s(_vm.errors.lang[0]))]) : _vm._e()])]), _vm._v(" "), _c('div', {
    staticClass: "row"
  }, [_c('div', {
    class: ['form-group col-md-8', _vm.errors.origin ? 'has-error' : '']
  }, [_c('label', {
    staticClass: "control-label"
  }, [_vm._v("Kata Asing")]), _vm._v(" "), _c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.state.origin),
      expression: "state.origin"
    }],
    staticClass: "form-control",
    attrs: {
      "disabled": _vm.loading,
      "type": "text"
    },
    domProps: {
      "value": (_vm.state.origin)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.state.origin = $event.target.value
      }
    }
  }), _vm._v(" "), (_vm.errors.origin) ? _c('span', {
    staticClass: "label label-danger"
  }, [_vm._v(_vm._s(_vm.errors.origin[0]))]) : _vm._e()])]), _vm._v(" "), _c('div', {
    staticClass: "row"
  }, [_c('div', {
    class: ['form-group col-md-8', _vm.errors.locale ? 'has-error' : '']
  }, [_c('label', {
    staticClass: "control-label"
  }, [_vm._v("Kata Lokal")]), _vm._v(" "), _c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.state.locale),
      expression: "state.locale"
    }],
    staticClass: "form-control",
    attrs: {
      "disabled": _vm.loading,
      "type": "text"
    },
    domProps: {
      "value": (_vm.state.locale)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.state.locale = $event.target.value
      }
    }
  }), _vm._v(" "), (_vm.errors.locale) ? _c('span', {
    staticClass: "label label-danger"
  }, [_vm._v(_vm._s(_vm.errors.locale[0]))]) : _vm._e()])]), _vm._v(" "), _c('div', {
    staticClass: "row"
  }, [_c('div', {
    staticClass: "col-md-12"
  }, [_c('button', {
    staticClass: "btn btn-theme btn-t-primary",
    attrs: {
      "disabled": _vm.loading,
      "type": "submit"
    }
  }, [_vm._v("\n                  Simpan Kata\n                  "), _c('loader', {
    attrs: {
      "show": _vm.loading
    }
  })], 1), _vm._v(" "), _c('router-link', {
    staticClass: "btn btn-default btn-theme",
    attrs: {
      "to": {
        name: 'glosarium.word'
      },
      "tag": "button"
    }
  }, [_vm._v("\n                  Kembali\n               ")])], 1)])])])])
},staticRenderFns: []}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-43a723a8", module.exports)
  }
}

/***/ }),

/***/ 326:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "row"
  }, [_c('vue-progress-bar'), _vm._v(" "), _c('div', {
    staticClass: "col-md-9"
  }, [_c('div', {
    staticClass: "block-section-sm box-list-area"
  }, [_c('div', {
    staticClass: "row hidden-xs"
  }, [_c('div', {
    staticClass: "col-sm-6  "
  }, [(_vm.keyword) ? _c('p', [_c('strong', {
    staticClass: "color-black"
  }, [_vm._v("Hasil pencarian untuk \"" + _vm._s(_vm.keyword) + "\"")])]) : _vm._e()]), _vm._v(" "), _c('div', {
    staticClass: "col-sm-6"
  }, [(_vm.words.data) ? _c('p', {
    staticClass: "text-right"
  }, [_vm._v("\n                  Menampilkan " + _vm._s(_vm.words.from) + " sampai " + _vm._s(_vm.words.to) + " dari total " + _vm._s(_vm.words.total) + " kata.\n               ")]) : _vm._e()])]), _vm._v(" "), _c('div', {
    staticClass: "panel panel-default"
  }, [_c('div', {
    staticClass: "panel-heading"
  }, [_c('h2', [_vm._v(_vm._s(_vm.category.name))])]), _vm._v(" "), _c('div', {
    staticClass: "panel-body"
  }, [(_vm.category.description) ? _c('p', [_vm._v("\n                  " + _vm._s(_vm.category.description) + "\n               ")]) : _vm._e()])]), _vm._v(" "), _c('alert', {
    attrs: {
      "show": !_vm.words.data,
      "type": "info"
    }
  }, [_vm._v("\n            Kata tidak ditemukan dalam kategori " + _vm._s(_vm.category.name) + ".\n         ")]), _vm._v(" "), _c('pagination', {
    attrs: {
      "data": _vm.words
    }
  }), _vm._v(" "), _c('div', {
    staticClass: "box-list"
  }, _vm._l((_vm.words.data), function(word, index) {
    return _c('div', {
      staticClass: "item"
    }, [_c('div', {
      staticClass: "row"
    }, [_c('div', {
      staticClass: "col-md-1 hidden-xs hidden-sm"
    }, [(word.category.metadata.icon) ? _c('div', {
      staticClass: "img-item"
    }, [_c('h2', [_c('i', {
      class: word.category.metadata.icon
    })])]) : _vm._e()]), _vm._v(" "), _c('div', {
      staticClass: "col-md-11"
    }, [_c('h3', {
      staticClass: "no-margin-top"
    }, [_c('a', {
      attrs: {
        "href": word.url
      }
    }, [_vm._v(_vm._s(word.origin))]), _vm._v(" "), _c('small', [_c('a', {
      staticClass: "color-white-mute",
      attrs: {
        "href": word.short_url
      }
    }, [_c('i', {
      staticClass: "fa fa-link"
    })])])]), _vm._v(" "), _c('h5', [_c('span', {
      staticClass: "color-black"
    }, [_vm._v(_vm._s(word.locale))]), _vm._v(" - "), _c('span', [_c('a', {
      staticClass: "color-white-mute",
      attrs: {
        "href": word.category.url
      }
    }, [_vm._v(_vm._s(word.category.name))])])]), _vm._v(" "), (word.description) ? _c('p', {
      staticClass: "text-description"
    }, [_vm._v("\n                        " + _vm._s(word.description.description) + "\n                     ")]) : _vm._e(), _vm._v(" "), _c('div', [_c('span', {
      staticClass: "color-white-mute"
    }, [_vm._v(_vm._s(word.updated_diff))])])])])])
  })), _vm._v(" "), _c('pagination', {
    attrs: {
      "data": _vm.words
    }
  })], 1)]), _vm._v(" "), _c('div', {
    staticClass: "col-md-3"
  }, [_c('div', {
    staticClass: "block-section-sm side-right"
  }, [_c('div', {
    staticClass: "result-filter"
  }, [_c('h5', {
    staticClass: "no-margin-top font-bold margin-b-20 "
  }, [_c('a', {
    attrs: {
      "href": "#category",
      "data-toggle": "collapse"
    }
  }, [_vm._v("\n                  Kategori\n                  "), _c('loader', {
    attrs: {
      "show": _vm.loading
    }
  }), _vm._v(" "), _c('i', {
    staticClass: "fa ic-arrow-toogle fa-angle-right pull-right"
  })], 1)]), _vm._v(" "), _c('glosarium-category-all')], 1)])])], 1)
},staticRenderFns: []}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-4625b0b9", module.exports)
  }
}

/***/ }),

/***/ 327:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "panel panel-default"
  }, [_c('div', {
    staticClass: "panel-heading"
  }, [_vm._v("Katakunci Bot")]), _vm._v(" "), _c('div', {
    staticClass: "panel-body"
  }, [_c('div', {
    staticClass: "table-responsive"
  }, [_c('table', {
    staticClass: "table table-bordered"
  }, [_vm._m(0), _vm._v(" "), _c('tbody', _vm._l((_vm.keywords.data), function(keyword, index) {
    return _c('tr', [_c('td', [_vm._v(_vm._s(_vm.keywords.from + index))]), _vm._v(" "), _c('td', [_vm._v(_vm._s(keyword.keyword))]), _vm._v(" "), _c('td', {
      attrs: {
        "width": "500"
      }
    }, [_vm._v(_vm._s(keyword.message))]), _vm._v(" "), _c('td', [_vm._v(_vm._s(keyword.description))])])
  }))])])])])
},staticRenderFns: [function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('thead', [_c('tr', [_c('th', [_vm._v("No.")]), _vm._v(" "), _c('th', [_vm._v("Katakunci")]), _vm._v(" "), _c('th', [_vm._v("Pesan")]), _vm._v(" "), _c('th', [_vm._v("Deskripsi")])])])
}]}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-59717d73", module.exports)
  }
}

/***/ }),

/***/ 328:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "panel panel-default"
  }, [_c('div', {
    staticClass: "panel-heading"
  }, [_vm._v("\n      Tambah Kata\n      "), _c('span', {
    staticClass: "pull-right"
  }, [_c('router-link', {
    staticClass: "btn btn-default btn-sm",
    attrs: {
      "to": {
        name: 'glosarium.word'
      }
    }
  }, [_c('i', {
    staticClass: "fa fa-list fa-fw"
  })])], 1)]), _vm._v(" "), _c('div', {
    staticClass: "panel-body"
  }, [_c('alert', {
    attrs: {
      "show": _vm.alert.message,
      "type": _vm.alert.type
    }
  }, [_vm._v("\n         " + _vm._s(_vm.alert.message) + "\n      ")]), _vm._v(" "), _c('form', {
    attrs: {
      "action": "/user/glosarium/word/update",
      "method": "post"
    },
    on: {
      "submit": function($event) {
        $event.preventDefault();
        _vm.update($event)
      }
    }
  }, [_c('div', {
    staticClass: "row"
  }, [_c('div', {
    class: ['form-group col-md-6', _vm.errors.category ? 'has-error' : '']
  }, [_c('label', {
    staticClass: "control-label"
  }, [_vm._v("Kategori")]), _vm._v(" "), _c('select', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.state.category),
      expression: "state.category"
    }],
    staticClass: "form-control",
    on: {
      "change": function($event) {
        var $$selectedVal = Array.prototype.filter.call($event.target.options, function(o) {
          return o.selected
        }).map(function(o) {
          var val = "_value" in o ? o._value : o.value;
          return val
        });
        _vm.state.category = $event.target.multiple ? $$selectedVal : $$selectedVal[0]
      }
    }
  }, [_c('option', {
    attrs: {
      "value": ""
    }
  }, [_vm._v("Pilih Kategori")]), _vm._v(" "), _vm._l((_vm.categories), function(category) {
    return _c('option', {
      domProps: {
        "value": category.id
      }
    }, [_vm._v("\n                     " + _vm._s(category.name) + "\n                  ")])
  })], 2), _vm._v(" "), (_vm.errors.category) ? _c('span', {
    staticClass: "label label-danger"
  }, [_vm._v(_vm._s(_vm.errors.category[0]))]) : _vm._e()])]), _vm._v(" "), _c('div', {
    staticClass: "row"
  }, [_c('div', {
    class: ['form-group col-md-3', _vm.errors.lang ? 'has-error' : '']
  }, [_c('label', {
    staticClass: "control-label"
  }, [_vm._v("Bahasa Asal")]), _vm._v(" "), _c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.state.lang),
      expression: "state.lang"
    }],
    staticClass: "form-control",
    attrs: {
      "disabled": _vm.loading,
      "type": "text"
    },
    domProps: {
      "value": (_vm.state.lang)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.state.lang = $event.target.value
      }
    }
  }), _vm._v(" "), (_vm.errors.lang) ? _c('span', {
    staticClass: "label label-danger"
  }, [_vm._v(_vm._s(_vm.errors.lang[0]))]) : _vm._e()])]), _vm._v(" "), _c('div', {
    staticClass: "row"
  }, [_c('div', {
    class: ['form-group col-md-8', _vm.errors.origin ? 'has-error' : '']
  }, [_c('label', {
    staticClass: "control-label"
  }, [_vm._v("Kata Asing")]), _vm._v(" "), _c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.state.origin),
      expression: "state.origin"
    }],
    staticClass: "form-control",
    attrs: {
      "disabled": _vm.loading,
      "type": "text"
    },
    domProps: {
      "value": (_vm.state.origin)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.state.origin = $event.target.value
      }
    }
  }), _vm._v(" "), (_vm.errors.origin) ? _c('span', {
    staticClass: "label label-danger"
  }, [_vm._v(_vm._s(_vm.errors.origin[0]))]) : _vm._e()])]), _vm._v(" "), _c('div', {
    staticClass: "row"
  }, [_c('div', {
    class: ['form-group col-md-8', _vm.errors.locale ? 'has-error' : '']
  }, [_c('label', {
    staticClass: "control-label"
  }, [_vm._v("Kata Lokal")]), _vm._v(" "), _c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.state.locale),
      expression: "state.locale"
    }],
    staticClass: "form-control",
    attrs: {
      "disabled": _vm.loading,
      "type": "text"
    },
    domProps: {
      "value": (_vm.state.locale)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.state.locale = $event.target.value
      }
    }
  }), _vm._v(" "), (_vm.errors.locale) ? _c('span', {
    staticClass: "label label-danger"
  }, [_vm._v(_vm._s(_vm.errors.locale[0]))]) : _vm._e()])]), _vm._v(" "), _c('div', {
    staticClass: "row"
  }, [_c('div', {
    staticClass: "col-md-12"
  }, [_c('button', {
    staticClass: "btn btn-theme btn-t-primary",
    attrs: {
      "disabled": _vm.loading,
      "type": "submit"
    }
  }, [_vm._v("\n                  Perbarui Kata\n                  "), _c('loader', {
    attrs: {
      "show": _vm.loading
    }
  })], 1), _vm._v(" "), _c('router-link', {
    staticClass: "btn btn-default btn-theme",
    attrs: {
      "to": {
        name: 'glosarium.word'
      },
      "tag": "button"
    }
  }, [_vm._v("\n                  Kembali\n               ")])], 1)])])], 1)])
},staticRenderFns: []}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-60a24a3a", module.exports)
  }
}

/***/ }),

/***/ 329:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "row"
  }, [_c('div', {
    staticClass: "col-md-9"
  }, [_c('div', {
    staticClass: "block-section-sm box-list-area"
  }, [_c('div', {
    staticClass: "row hidden-xs"
  }, [_c('div', {
    staticClass: "col-sm-6 "
  }, [(_vm.keyword) ? _c('p', {
    staticClass: "color-black"
  }, [_c('strong', [_vm._v("Hasil pencarian untuk \"" + _vm._s(_vm.keyword) + "\"")])]) : _c('p', {
    staticClass: "color-black"
  }, [_vm._v("Indeks Kategori")])]), _vm._v(" "), (_vm.categories.total >= 1) ? _c('div', {
    staticClass: "col-sm-6"
  }, [_c('p', {
    staticClass: "text-right"
  }, [_vm._v("\n                  Menampilkan " + _vm._s(_vm.categories.from) + " sampai " + _vm._s(_vm.categories.to) + " dari total " + _vm._s(_vm.categories.total) + " kategori.\n               ")])]) : _vm._e()]), _vm._v(" "), (_vm.categories.total <= 0) ? _c('div', {
    staticClass: "alert alert-info"
  }, [_vm._v("\n            Kategori glosarium tidak ditemukan.\n         ")]) : _vm._e(), _vm._v(" "), _c('div', {
    staticClass: "box-list"
  }, _vm._l((_vm.categories.data), function(category) {
    return _c('div', {
      staticClass: "item"
    }, [_c('div', {
      staticClass: "row"
    }, [_c('div', {
      staticClass: "col-md-1 hidden-sm hidden-xs"
    }, [(category.metadata.icon) ? _c('div', {
      staticClass: "img-item"
    }, [_c('h2', [_c('i', {
      class: category.metadata.icon
    })])]) : _vm._e()]), _vm._v(" "), _c('div', {
      staticClass: "col-md-11"
    }, [_c('h3', {
      staticClass: "no-margin-top"
    }, [_c('router-link', {
      attrs: {
        "to": _vm._f("url")(category)
      }
    }, [_vm._v("\n                          " + _vm._s(category.name) + "\n                        ")]), _vm._v(" "), _vm._m(0, true)], 1), _vm._v(" "), _c('h5', [_c('span', {
      staticClass: "color-black"
    }, [_vm._v(_vm._s(category.words_count.toLocaleString('id-ID')) + " kata")])]), _vm._v(" "), _c('p', {
      staticClass: "text-truncate"
    }, [_vm._v(_vm._s(category.description))]), _vm._v(" "), _c('div', [_c('span', {
      staticClass: "color-white-mute"
    }, [_vm._v(_vm._s(category.updated_diff))])])])])])
  })), _vm._v(" "), (_vm.categories.next_page_url) ? _c('nav', [_c('button', {
    staticClass: "btn btn-t-primary btn-theme btn-block",
    attrs: {
      "disabled": _vm.loading
    },
    on: {
      "click": function($event) {
        $event.preventDefault();
        _vm.loadMore(_vm.categories.next_page_url)
      }
    }
  }, [_vm._v("\n            Muat lebih banyak... "), _c('loader', {
    attrs: {
      "show": _vm.loading
    }
  })], 1)]) : _vm._e()])]), _vm._v(" "), _c('div', {
    staticClass: "col-md-3"
  }, [_c('div', {
    staticClass: "block-section-sm side-right"
  }, [_c('div', {
    staticClass: "result-filter"
  }, [_c('glosarium-word-latest', {
    attrs: {
      "limit": 10
    }
  })], 1)])])])
},staticRenderFns: [function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('a', {
    attrs: {
      "href": "#"
    }
  }, [_c('i', {
    staticClass: "fa fa-link color-white-mute font-1x"
  })])
}]}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-7afd2574", module.exports)
  }
}

/***/ }),

/***/ 33:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return (_vm.categories) ? _c('div', {
    staticClass: "collapse in",
    attrs: {
      "id": "category"
    }
  }, [_c('div', {
    staticClass: "list-area"
  }, [_c('ul', {
    staticClass: "list-unstyled"
  }, _vm._l((_vm.categories), function(category) {
    return _c('li', [_c('router-link', {
      attrs: {
        "to": _vm._f("url")(category.slug)
      }
    }, [_c('i', {
      class: [category.metadata.icon, 'fa-fw']
    }), _vm._v("\n            " + _vm._s(category.name) + " (" + _vm._s(category.words_count.toLocaleString('id-Id')) + ")\n            ")])], 1)
  }))])]) : _vm._e()
},staticRenderFns: []}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-2751c595", module.exports)
  }
}

/***/ }),

/***/ 330:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "panel panel-default"
  }, [_c('div', {
    staticClass: "panel-heading"
  }, [_vm._v("\n      Kategori "), _c('loader', {
    attrs: {
      "show": _vm.loading
    }
  })], 1), _vm._v(" "), _c('div', {
    staticClass: "panel-body"
  }, [_c('search', {
    attrs: {
      "placeholder": "Cari kategori..."
    }
  }), _vm._v(" "), (_vm.categories) ? _c('div', {
    staticClass: "table-responsive"
  }, [_c('table', {
    staticClass: "table table-bordered"
  }, [_vm._m(0), _vm._v(" "), _c('tbody', _vm._l((_vm.categories.data), function(category, index) {
    return _c('tr', [_c('td', [_vm._v(_vm._s(_vm.categories.from + index))]), _vm._v(" "), _c('td', [_vm._v(_vm._s(category.name))]), _vm._v(" "), _c('td', [_vm._v(_vm._s(category.summary))]), _vm._v(" "), _c('td', [_c('router-link', {
      staticClass: "btn btn-info btn-xs",
      attrs: {
        "to": {
          name: 'glosarium.category.edit',
          params: {
            slug: category.slug
          }
        }
      }
    }, [_c('i', {
      staticClass: "fa fa-edit fa-fw"
    })]), _vm._v(" "), _c('button-delete', {
      attrs: {
        "url": _vm.categories.delete_url
      }
    })], 1)])
  }))])]) : _vm._e()], 1)])
},staticRenderFns: [function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('thead', [_c('tr', [_c('th', [_vm._v("#")]), _vm._v(" "), _c('th', [_vm._v("Kategori")]), _vm._v(" "), _c('th', [_vm._v("Deskripsi")]), _vm._v(" "), _c('th', [_vm._v("Aksi")])])])
}]}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-7c1ca242", module.exports)
  }
}

/***/ }),

/***/ 331:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "panel panel-default"
  }, [_c('div', {
    staticClass: "panel-heading"
  }, [_vm._v("\n      Kata Menunggu Persetujuan\n      "), _c('span', {
    staticClass: "pull-right"
  }, [_c('router-link', {
    staticClass: "btn btn-default btn-sm",
    attrs: {
      "to": {
        name: 'glosarium.word.create'
      }
    }
  }, [_c('i', {
    staticClass: "fa fa-plus fa-fw"
  })])], 1)]), _vm._v(" "), _c('div', {
    staticClass: "panel-body"
  }, [(_vm.words.total <= 0) ? _c('div', {
    staticClass: "alert alert-info"
  }, [_vm._v("\n         Tidak ada kata yang menunggu persetujuan untuk saat ini.   \n      ")]) : _vm._e(), _vm._v(" "), (_vm.words.total >= 1) ? _c('div', {
    staticClass: "tabel-responsive"
  }, [_c('table', {
    staticClass: "table table-bordered"
  }, [_vm._m(0), _vm._v(" "), _c('tbody', _vm._l((_vm.words.data), function(word, index) {
    return _c('tr', [_c('td', [_vm._v(_vm._s(_vm.words.from + index))]), _vm._v(" "), _c('td', [_vm._v(_vm._s(word.category.name))]), _vm._v(" "), _c('td', [_vm._v(_vm._s(word.origin))]), _vm._v(" "), _c('td', [_vm._v(_vm._s(word.locale))]), _vm._v(" "), _c('td')])
  }))])]) : _vm._e(), _vm._v(" "), (_vm.words.total >= 1) ? _c('pagination', {
    attrs: {
      "data": _vm.words
    }
  }) : _vm._e()], 1)])
},staticRenderFns: [function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('thead', [_c('tr', [_c('th', [_vm._v("#")]), _vm._v(" "), _c('th', [_vm._v("Kategori")]), _vm._v(" "), _c('th', [_vm._v("Kata Asal")]), _vm._v(" "), _c('th', [_vm._v("Translasi")]), _vm._v(" "), _c('th', [_vm._v("Aksi")])])])
}]}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-7f6efd54", module.exports)
  }
}

/***/ }),

/***/ 332:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "panel panel-default"
  }, [_c('div', {
    staticClass: "panel-heading"
  }, [_vm._v("\n      Tambah Kata\n      "), _c('span', {
    staticClass: "pull-right"
  }, [_c('router-link', {
    staticClass: "btn btn-default btn-sm",
    attrs: {
      "to": {
        name: 'glosarium.word'
      }
    }
  }, [_c('i', {
    staticClass: "fa fa-list fa-fw"
  })])], 1)]), _vm._v(" "), _c('div', {
    staticClass: "panel-body"
  }, [_c('form', {
    attrs: {
      "action": "/user/glosarium/word/store",
      "method": "post"
    },
    on: {
      "submit": function($event) {
        $event.preventDefault();
        _vm.store($event)
      }
    }
  }, [_c('div', {
    staticClass: "row"
  }, [_c('div', {
    class: ['form-group col-md-6', _vm.errors.category ? 'has-error' : '']
  }, [_c('label', {
    staticClass: "control-label"
  }, [_vm._v("Kategori")]), _vm._v(" "), _c('select', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.state.category),
      expression: "state.category"
    }],
    staticClass: "form-control",
    on: {
      "change": function($event) {
        var $$selectedVal = Array.prototype.filter.call($event.target.options, function(o) {
          return o.selected
        }).map(function(o) {
          var val = "_value" in o ? o._value : o.value;
          return val
        });
        _vm.state.category = $event.target.multiple ? $$selectedVal : $$selectedVal[0]
      }
    }
  }, [_c('option', {
    attrs: {
      "value": ""
    }
  }, [_vm._v("Pilih Kategori")]), _vm._v(" "), _vm._l((_vm.categories), function(category) {
    return _c('option', {
      domProps: {
        "value": category.id
      }
    }, [_vm._v("\n                     " + _vm._s(category.name) + "\n                  ")])
  })], 2), _vm._v(" "), (_vm.errors.category) ? _c('span', {
    staticClass: "label label-danger"
  }, [_vm._v(_vm._s(_vm.errors.category[0]))]) : _vm._e()])]), _vm._v(" "), _c('div', {
    staticClass: "row"
  }, [_c('div', {
    class: ['form-group col-md-3', _vm.errors.lang ? 'has-error' : '']
  }, [_c('label', {
    staticClass: "control-label"
  }, [_vm._v("Bahasa Asal")]), _vm._v(" "), _c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.state.lang),
      expression: "state.lang"
    }],
    staticClass: "form-control",
    attrs: {
      "disabled": _vm.loading,
      "type": "text"
    },
    domProps: {
      "value": (_vm.state.lang)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.state.lang = $event.target.value
      }
    }
  }), _vm._v(" "), (_vm.errors.lang) ? _c('span', {
    staticClass: "label label-danger"
  }, [_vm._v(_vm._s(_vm.errors.lang[0]))]) : _vm._e()])]), _vm._v(" "), _c('div', {
    staticClass: "row"
  }, [_c('div', {
    class: ['form-group col-md-8', _vm.errors.origin ? 'has-error' : '']
  }, [_c('label', {
    staticClass: "control-label"
  }, [_vm._v("Kata Asing")]), _vm._v(" "), _c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.state.origin),
      expression: "state.origin"
    }],
    staticClass: "form-control",
    attrs: {
      "disabled": _vm.loading,
      "type": "text"
    },
    domProps: {
      "value": (_vm.state.origin)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.state.origin = $event.target.value
      }
    }
  }), _vm._v(" "), (_vm.errors.origin) ? _c('span', {
    staticClass: "label label-danger"
  }, [_vm._v(_vm._s(_vm.errors.origin[0]))]) : _vm._e()])]), _vm._v(" "), _c('div', {
    staticClass: "row"
  }, [_c('div', {
    class: ['form-group col-md-8', _vm.errors.locale ? 'has-error' : '']
  }, [_c('label', {
    staticClass: "control-label"
  }, [_vm._v("Kata Lokal")]), _vm._v(" "), _c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.state.locale),
      expression: "state.locale"
    }],
    staticClass: "form-control",
    attrs: {
      "disabled": _vm.loading,
      "type": "text"
    },
    domProps: {
      "value": (_vm.state.locale)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.state.locale = $event.target.value
      }
    }
  }), _vm._v(" "), (_vm.errors.locale) ? _c('span', {
    staticClass: "label label-danger"
  }, [_vm._v(_vm._s(_vm.errors.locale[0]))]) : _vm._e()])]), _vm._v(" "), _c('div', {
    staticClass: "row"
  }, [_c('div', {
    staticClass: "col-md-12"
  }, [_c('button', {
    staticClass: "btn btn-theme btn-t-primary",
    attrs: {
      "disabled": _vm.loading,
      "type": "submit"
    }
  }, [_vm._v("\n                  Simpan Kata\n                  "), _c('loader', {
    attrs: {
      "show": _vm.loading
    }
  })], 1), _vm._v(" "), _c('router-link', {
    staticClass: "btn btn-default btn-theme",
    attrs: {
      "to": {
        name: 'glosarium.word'
      },
      "tag": "button"
    }
  }, [_vm._v("\n                  Kembali\n               ")])], 1)])])])])
},staticRenderFns: []}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-8c561574", module.exports)
  }
}

/***/ }),

/***/ 333:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('form', {
    staticClass: "form-search-list",
    on: {
      "submit": function($event) {
        $event.preventDefault();
        _vm.search($event)
      }
    }
  }, [_c('div', {
    staticClass: "row"
  }, [_c('div', {
    staticClass: "col-md-12"
  }, [_c('div', {
    attrs: {
      "id": "custom-search-input"
    }
  }, [_c('div', {
    staticClass: "input-group col-md-12"
  }, [_c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.state.keyword),
      expression: "state.keyword"
    }],
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "placeholder": _vm.placeholder
    },
    domProps: {
      "value": (_vm.state.keyword)
    },
    on: {
      "keyup": _vm.search,
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.state.keyword = $event.target.value
      }
    }
  }), _vm._v(" "), _vm._m(0)])])])])])
},staticRenderFns: [function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('span', {
    staticClass: "input-group-btn"
  }, [_c('button', {
    staticClass: "btn btn-info btn-lg",
    attrs: {
      "type": "button"
    }
  }, [_c('i', {
    staticClass: "glyphicon glyphicon-search"
  })])])
}]}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-93d383b6", module.exports)
  }
}

/***/ }),

/***/ 334:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "panel panel-default"
  }, [_c('div', {
    staticClass: "panel-heading"
  }, [_vm._v("\n      Kata "), _c('loader', {
    attrs: {
      "show": _vm.loading
    }
  }), _vm._v(" "), _c('span', {
    staticClass: "pull-right"
  }, [_c('router-link', {
    staticClass: "btn btn-default btn-sm",
    attrs: {
      "to": {
        name: 'glosarium.word.create'
      }
    }
  }, [_c('i', {
    staticClass: "fa fa-plus fa-fw"
  })])], 1)], 1), _vm._v(" "), _c('div', {
    staticClass: "panel-body"
  }, [_c('search', {
    attrs: {
      "placeholder": "Cari kata..."
    }
  }), _vm._v(" "), (_vm.words) ? _c('div', {
    staticClass: "tabel-responsive"
  }, [_c('table', {
    staticClass: "table table-bordered"
  }, [_vm._m(0), _vm._v(" "), _c('tbody', _vm._l((_vm.words.data), function(word, index) {
    return _c('tr', [_c('td', [_vm._v(_vm._s(_vm.words.from + index))]), _vm._v(" "), _c('td', [_vm._v(_vm._s(word.category.name))]), _vm._v(" "), _c('td', [_vm._v(_vm._s(word.origin))]), _vm._v(" "), _c('td', [_vm._v(_vm._s(word.locale))]), _vm._v(" "), _c('td', [_c('router-link', {
      staticClass: "btn btn-xs btn-info",
      attrs: {
        "to": {
          name: 'glosarium.word.edit',
          params: {
            slug: word.slug
          }
        }
      }
    }, [_c('i', {
      staticClass: "fa fa-edit fa-fw"
    })])], 1)])
  }))])]) : _vm._e(), _vm._v(" "), _c('pagination', {
    attrs: {
      "data": _vm.words
    }
  })], 1)])
},staticRenderFns: [function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('thead', [_c('tr', [_c('th', [_vm._v("#")]), _vm._v(" "), _c('th', [_vm._v("Kategori")]), _vm._v(" "), _c('th', [_vm._v("Kata Asal")]), _vm._v(" "), _c('th', [_vm._v("Translasi")]), _vm._v(" "), _c('th', [_vm._v("Aksi")])])])
}]}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-a20c2864", module.exports)
  }
}

/***/ }),

/***/ 335:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "panel panel-default"
  }, [_c('div', {
    staticClass: "panel-heading"
  }, [_vm._v("Selamat datang!")]), _vm._v(" "), _c('div', {
    staticClass: "panel-body"
  }, [_vm._m(0), _vm._v(" "), _c('p', [_vm._v("Anda juga dapat mnegubah "), _c('router-link', {
    attrs: {
      "to": {
        name: 'user.password'
      }
    }
  }, [_vm._v("sandi lewat")]), _vm._v(" dan membaca "), _c('router-link', {
    attrs: {
      "to": {
        name: 'user.notification'
      }
    }
  }, [_vm._v("notifikasi")]), _vm._v(" yang masuk pada akun Anda.")], 1), _vm._v(" "), _vm._m(1), _vm._v(" "), _c('p', [_vm._v("Hormat kami.")])])])
},staticRenderFns: [function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('p', [_vm._v("Halo, "), _c('br'), _vm._v(" Terima kasih telah bergabung dengan Glosarium Indonesia. Pada halaman kontributor, Anda dapat berkontribusi dengan menambahkan kata baru dengan mengklik "), _c('a', {
    attrs: {
      "href": "/word/propose"
    }
  }, [_vm._v("tautan ini")]), _vm._v(". Kontribusi Anda sangat membantu dalam perkembangan aplikasi Glosarium Indonesia.")])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('p', [_vm._v("Jika Anda menemukan kesalahan aplikasi, ada pertanyaan, saran maupun kritik, jangan sungkan untuk menyampaikannya melalui "), _c('a', {
    attrs: {
      "href": "/contact"
    }
  }, [_vm._v("formulir kontak")]), _vm._v(".")])
}]}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-bcb4ae66", module.exports)
  }
}

/***/ }),

/***/ 336:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(298);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(5)("6dc1b4aa", content, false);
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"id\":\"data-v-299b2e7c\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./notification.vue", function() {
     var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"id\":\"data-v-299b2e7c\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./notification.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 337:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(299);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(5)("595b2880", content, false);
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"id\":\"data-v-93d383b6\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./search.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"id\":\"data-v-93d383b6\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./search.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 34:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "container"
  }, [_c('div', {
    staticClass: "row"
  }, [_c('div', {
    staticClass: "col-md-12"
  }, [_c('div', {
    staticClass: "text-center logo"
  }, [_c('a', {
    attrs: {
      "href": _vm.url
    }
  }, [_c('img', {
    staticClass: "text-center",
    attrs: {
      "src": _vm.img,
      "alt": ""
    }
  })])])])])])
},staticRenderFns: []}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-aa5bb01e", module.exports)
  }
}

/***/ }),

/***/ 35:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "block-section",
    attrs: {
      "id": "affix-box"
    }
  }, [_c('h5', {
    staticClass: "no-margin-top font-bold margin-b-20 "
  }, [_c('a', {
    attrs: {
      "href": "#latest-words",
      "data-toggle": "collapse"
    }
  }, [_vm._v("Kata Terbaru "), _c('loader', {
    attrs: {
      "show": _vm.loading
    }
  }), _vm._v(" "), _c('i', {
    staticClass: "fa ic-arrow-toogle fa-angle-right pull-right"
  })], 1)]), _vm._v(" "), (_vm.words) ? _c('div', {
    staticClass: "collapse in",
    attrs: {
      "id": "latest-words"
    }
  }, [_c('div', {
    staticClass: "list-area"
  }, [_c('ul', {
    staticClass: "list-unstyled"
  }, _vm._l((_vm.words), function(word) {
    return _c('li', [_c('router-link', {
      attrs: {
        "to": _vm._f("url")(word)
      }
    }, [(word.category.metadata) ? _c('i', {
      class: [word.category.metadata.icon, 'fa-fw']
    }) : _vm._e(), _vm._v("\n                   \t" + _vm._s(word.origin) + " (" + _vm._s(word.locale) + ")\n                   ")])], 1)
  }))])]) : _vm._e()])
},staticRenderFns: []}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-f5c1c192", module.exports)
  }
}

/***/ }),

/***/ 36:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(31);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(5)("d47b60b6", content, false);
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"id\":\"data-v-1d24b542\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./search.vue", function() {
     var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"id\":\"data-v-1d24b542\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./search.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 37:
/***/ (function(module, exports) {

/**
 * Translates the list format produced by css-loader into something
 * easier to manipulate.
 */
module.exports = function listToStyles (parentId, list) {
  var styles = []
  var newStyles = {}
  for (var i = 0; i < list.length; i++) {
    var item = list[i]
    var id = item[0]
    var css = item[1]
    var media = item[2]
    var sourceMap = item[3]
    var part = {
      id: parentId + ':' + i,
      css: css,
      media: media,
      sourceMap: sourceMap
    }
    if (!newStyles[id]) {
      styles.push(newStyles[id] = { id: id, parts: [part] })
    } else {
      newStyles[id].parts.push(part)
    }
  }
  return styles
}


/***/ }),

/***/ 38:
/***/ (function(module, exports, __webpack_require__) {

var map = {
	"./bot/keyword/table.vue": 300,
	"./common/search.vue": 23,
	"./common/title.vue": 24,
	"./contact/form.vue": 301,
	"./error/404.vue": 465,
	"./glosarium/category/all.vue": 25,
	"./glosarium/category/edit.vue": 302,
	"./glosarium/category/index.vue": 303,
	"./glosarium/category/show.vue": 304,
	"./glosarium/category/table.vue": 305,
	"./glosarium/word/create.vue": 306,
	"./glosarium/word/edit.vue": 307,
	"./glosarium/word/index.vue": 308,
	"./glosarium/word/latest.vue": 26,
	"./glosarium/word/moderation.vue": 309,
	"./glosarium/word/show.vue": 310,
	"./glosarium/word/table.vue": 311,
	"./search.vue": 312,
	"./user/change-password.vue": 313,
	"./user/create.vue": 314,
	"./user/dashboard.vue": 315,
	"./user/index.vue": 316,
	"./user/notification.vue": 317
};
function webpackContext(req) {
	return __webpack_require__(webpackContextResolve(req));
};
function webpackContextResolve(req) {
	var id = map[req];
	if(!(id + 1)) // check for number or string
		throw new Error("Cannot find module '" + req + "'.");
	return id;
};
webpackContext.keys = function webpackContextKeys() {
	return Object.keys(map);
};
webpackContext.resolve = webpackContextResolve;
module.exports = webpackContext;
webpackContext.id = 38;

/***/ }),

/***/ 4:
/***/ (function(module, exports) {

/*
	MIT License http://www.opensource.org/licenses/mit-license.php
	Author Tobias Koppers @sokra
*/
// css base code, injected by the css-loader
module.exports = function() {
	var list = [];

	// return the list of modules as css string
	list.toString = function toString() {
		var result = [];
		for(var i = 0; i < this.length; i++) {
			var item = this[i];
			if(item[2]) {
				result.push("@media " + item[2] + "{" + item[1] + "}");
			} else {
				result.push(item[1]);
			}
		}
		return result.join("");
	};

	// import a list of modules into the list
	list.i = function(modules, mediaQuery) {
		if(typeof modules === "string")
			modules = [[null, modules, ""]];
		var alreadyImportedModules = {};
		for(var i = 0; i < this.length; i++) {
			var id = this[i][0];
			if(typeof id === "number")
				alreadyImportedModules[id] = true;
		}
		for(i = 0; i < modules.length; i++) {
			var item = modules[i];
			// skip already imported module
			// this implementation is not 100% perfect for weird media query combinations
			//  when a module is imported multiple times with different media queries.
			//  I hope this will never occur (Hey this way we have smaller bundles)
			if(typeof item[0] !== "number" || !alreadyImportedModules[item[0]]) {
				if(mediaQuery && !item[2]) {
					item[2] = mediaQuery;
				} else if(mediaQuery) {
					item[2] = "(" + item[2] + ") and (" + mediaQuery + ")";
				}
				list.push(item);
			}
		}
	};
	return list;
};


/***/ }),

/***/ 465:
/***/ (function(module, exports, __webpack_require__) {

var Component = __webpack_require__(1)(
  /* script */
  __webpack_require__(466),
  /* template */
  __webpack_require__(467),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/home/yugo/Documents/Web/PHP/glosarium/resources/assets/js/components/app/error/404.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] 404.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-56bee6c4", Component.options)
  } else {
    hotAPI.reload("data-v-56bee6c4", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 466:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
	name: 'Error404'
});

/***/ }),

/***/ 467:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _vm._m(0)
},staticRenderFns: [function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "row"
  }, [_c('div', {
    staticClass: "col-md-12"
  }, [_c('div', {
    staticClass: "text-center"
  }, [_c('h1', [_vm._v("Ups!")]), _vm._v(" "), _c('h2', [_vm._v("Halaman tidak ditemukan.")])]), _vm._v(" "), _c('div', {
    staticClass: "big-error"
  }, [_vm._v("404")])])])
}]}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-56bee6c4", module.exports)
  }
}

/***/ }),

/***/ 5:
/***/ (function(module, exports, __webpack_require__) {

/*
  MIT License http://www.opensource.org/licenses/mit-license.php
  Author Tobias Koppers @sokra
  Modified by Evan You @yyx990803
*/

var hasDocument = typeof document !== 'undefined'

if (typeof DEBUG !== 'undefined' && DEBUG) {
  if (!hasDocument) {
    throw new Error(
    'vue-style-loader cannot be used in a non-browser environment. ' +
    "Use { target: 'node' } in your Webpack config to indicate a server-rendering environment."
  ) }
}

var listToStyles = __webpack_require__(37)

/*
type StyleObject = {
  id: number;
  parts: Array<StyleObjectPart>
}

type StyleObjectPart = {
  css: string;
  media: string;
  sourceMap: ?string
}
*/

var stylesInDom = {/*
  [id: number]: {
    id: number,
    refs: number,
    parts: Array<(obj?: StyleObjectPart) => void>
  }
*/}

var head = hasDocument && (document.head || document.getElementsByTagName('head')[0])
var singletonElement = null
var singletonCounter = 0
var isProduction = false
var noop = function () {}

// Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
// tags it will allow on a page
var isOldIE = typeof navigator !== 'undefined' && /msie [6-9]\b/.test(navigator.userAgent.toLowerCase())

module.exports = function (parentId, list, _isProduction) {
  isProduction = _isProduction

  var styles = listToStyles(parentId, list)
  addStylesToDom(styles)

  return function update (newList) {
    var mayRemove = []
    for (var i = 0; i < styles.length; i++) {
      var item = styles[i]
      var domStyle = stylesInDom[item.id]
      domStyle.refs--
      mayRemove.push(domStyle)
    }
    if (newList) {
      styles = listToStyles(parentId, newList)
      addStylesToDom(styles)
    } else {
      styles = []
    }
    for (var i = 0; i < mayRemove.length; i++) {
      var domStyle = mayRemove[i]
      if (domStyle.refs === 0) {
        for (var j = 0; j < domStyle.parts.length; j++) {
          domStyle.parts[j]()
        }
        delete stylesInDom[domStyle.id]
      }
    }
  }
}

function addStylesToDom (styles /* Array<StyleObject> */) {
  for (var i = 0; i < styles.length; i++) {
    var item = styles[i]
    var domStyle = stylesInDom[item.id]
    if (domStyle) {
      domStyle.refs++
      for (var j = 0; j < domStyle.parts.length; j++) {
        domStyle.parts[j](item.parts[j])
      }
      for (; j < item.parts.length; j++) {
        domStyle.parts.push(addStyle(item.parts[j]))
      }
      if (domStyle.parts.length > item.parts.length) {
        domStyle.parts.length = item.parts.length
      }
    } else {
      var parts = []
      for (var j = 0; j < item.parts.length; j++) {
        parts.push(addStyle(item.parts[j]))
      }
      stylesInDom[item.id] = { id: item.id, refs: 1, parts: parts }
    }
  }
}

function createStyleElement () {
  var styleElement = document.createElement('style')
  styleElement.type = 'text/css'
  head.appendChild(styleElement)
  return styleElement
}

function addStyle (obj /* StyleObjectPart */) {
  var update, remove
  var styleElement = document.querySelector('style[data-vue-ssr-id~="' + obj.id + '"]')

  if (styleElement) {
    if (isProduction) {
      // has SSR styles and in production mode.
      // simply do nothing.
      return noop
    } else {
      // has SSR styles but in dev mode.
      // for some reason Chrome can't handle source map in server-rendered
      // style tags - source maps in <style> only works if the style tag is
      // created and inserted dynamically. So we remove the server rendered
      // styles and inject new ones.
      styleElement.parentNode.removeChild(styleElement)
    }
  }

  if (isOldIE) {
    // use singleton mode for IE9.
    var styleIndex = singletonCounter++
    styleElement = singletonElement || (singletonElement = createStyleElement())
    update = applyToSingletonTag.bind(null, styleElement, styleIndex, false)
    remove = applyToSingletonTag.bind(null, styleElement, styleIndex, true)
  } else {
    // use multi-style-tag mode in all other cases
    styleElement = createStyleElement()
    update = applyToTag.bind(null, styleElement)
    remove = function () {
      styleElement.parentNode.removeChild(styleElement)
    }
  }

  update(obj)

  return function updateStyle (newObj /* StyleObjectPart */) {
    if (newObj) {
      if (newObj.css === obj.css &&
          newObj.media === obj.media &&
          newObj.sourceMap === obj.sourceMap) {
        return
      }
      update(obj = newObj)
    } else {
      remove()
    }
  }
}

var replaceText = (function () {
  var textStore = []

  return function (index, replacement) {
    textStore[index] = replacement
    return textStore.filter(Boolean).join('\n')
  }
})()

function applyToSingletonTag (styleElement, index, remove, obj) {
  var css = remove ? '' : obj.css

  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = replaceText(index, css)
  } else {
    var cssNode = document.createTextNode(css)
    var childNodes = styleElement.childNodes
    if (childNodes[index]) styleElement.removeChild(childNodes[index])
    if (childNodes.length) {
      styleElement.insertBefore(cssNode, childNodes[index])
    } else {
      styleElement.appendChild(cssNode)
    }
  }
}

function applyToTag (styleElement, obj) {
  var css = obj.css
  var media = obj.media
  var sourceMap = obj.sourceMap

  if (media) {
    styleElement.setAttribute('media', media)
  }

  if (sourceMap) {
    // https://developer.chrome.com/devtools/docs/javascript-debugging
    // this makes source maps inside style tags work properly in Chrome
    css += '\n/*# sourceURL=' + sourceMap.sources[0] + ' */'
    // http://stackoverflow.com/a/26603875
    css += '\n/*# sourceMappingURL=data:application/json;base64,' + btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))) + ' */'
  }

  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = css
  } else {
    while (styleElement.firstChild) {
      styleElement.removeChild(styleElement.firstChild)
    }
    styleElement.appendChild(document.createTextNode(css))
  }
}


/***/ })

});