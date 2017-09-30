// https://github.com/hilongjw/vue-progressbar
import VueProgressBar from 'vue-progressbar';
Vue.use(VueProgressBar, {
	color: '#ecf0f1',
	failedColor: '#d9534f',
	thickness: '4px'
});

// highlight js
window.hljs = require('highlight.js');