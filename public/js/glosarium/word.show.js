!function(t){function o(r){if(n[r])return n[r].exports;var e=n[r]={i:r,l:!1,exports:{}};return t[r].call(e.exports,e,e.exports,o),e.l=!0,e.exports}var n={};o.m=t,o.c=n,o.i=function(t){return t},o.d=function(t,n,r){o.o(t,n)||Object.defineProperty(t,n,{configurable:!1,enumerable:!0,get:r})},o.n=function(t){var n=t&&t.__esModule?function(){return t.default}:function(){return t};return o.d(n,"a",n),n},o.o=function(t,o){return Object.prototype.hasOwnProperty.call(t,o)},o.p="",o(o.s=310)}({31:function(t,o){$(function(){$("li.glosarium").addClass("active")}),new Vue({el:"#content",data:{loginAlert:!1,total:0,words:words,word:word,categories:[]},mounted:function(){this.sameCategory(routes.glosariumWordSimilar)},computed:{totalVote:function(){return word.description?this.word.description.vote_up-this.word.description.vote_down:0}},methods:{sameCategory:function(t){var o=this;axios.post(t,{origin:this.words.origin}).then(function(t){o.categories=t.data})},vote:function(){var t=this,o=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"up";if(Laravel.auth){var n="up"==o?routes.glosariumDescriptionUp:routes.glosariumDescriptionDown;axios.post(n,{id:this.word.description.id}).then(function(n){"up"==o?t.word.description.vote_up=n.data.vote_up:t.word.description.vote_down=n.data.vote_down}).catch(function(t){})}else this.loginAlert=!0},favorite:function(){var t=this;axios.post(routes.glosariumFavoritePost,{slug:this.word.slug}).then(function(o){1==o.data.success&&(t.word.favorites_count+=1)}).catch(function(o){401==o.response.status&&(t.loginAlert=!0)})}}})},310:function(t,o,n){t.exports=n(31)}});