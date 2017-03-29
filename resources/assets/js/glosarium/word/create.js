$(() => {
	$('#content').removeClass('bg-color2')
		.addClass('bg-color1');

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

	mounted() {
		if (this.auth) {
         this.getCategory(routes.glosariumCategoryAll);
		}
	},

	methods: {

		pre() {
			this.loading = true;

			this.alerts = {
				type: null,
				title: null,
				message: null
			};
		},

		post() {
			this.loading = false;
		},

		error() {
			this.alerts = {
				type: 'danger',
				title: 'Ups!',
				message: 'Terjadi kesalahan internal'
			};
		},

		getCategory(url) {
			axios.get(url).then(response => {
            this.categories = response.data;
         })
		},

		create(e) {
			this.pre();

			axios.post(e.target.action, this.forms).then(response => {

				this.alerts = response.data.alerts;

				this.forms = {
					category: '',
					origin: null,
					locale: null,
					description: null
				};

				this.errors = [];

				this.post();

			}).catch(error => {
				if (error.response.status == 422) {
					this.errors = error.response.data;
				}
				else {
					this.error();
				}

				this.post();
			});
		}

	}
});