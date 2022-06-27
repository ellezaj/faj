var app = new Vue({
	el: '#login',
	data: {
		password: "",
        username: ""
	},
	methods: {
		checklogin() {
            var dt = { password: this.password, username: this.username };
            var dt = methods.formData(dt);
            var urls = window.App.baseUrl + "login-process";
            axios.post(urls, dt)
                .then(function (e) {
                    if (e.data.success) {
                        window.location.replace(window.App.baseUrl + "call-logs");
                    } else {
                        swal.fire("Login Failed", e.data.message, "error");
                    }

                })
        },
	},	
	mounted: function () {


	},
})