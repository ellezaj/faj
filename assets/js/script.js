const Toast = Swal.mixin({
	toast: true,
	position: 'top-end',
	showConfirmButton: false,
	timer: 3000,
	timerProgressBar: true,
	onOpen: (toast) => {
		toast.addEventListener('mouseenter', Swal.stopTimer)
		toast.addEventListener('mouseleave', Swal.resumeTimer)
	}
})


function showloading(type = 1, timer = 500, loading_content = "") {
	// var message = (message.length > 0) ? message : "Submitting Data . . .";
	$("#loading_content").html("")
	if (type == 1) {
		// Show Loading
		$('.parent-loading').removeClass('d-none');
	} else {
		setTimeout(() => {
			$('.parent-loading').addClass('d-none');
		}, timer);
	}

	if (loading_content != "") {
		$("#loading_content").html(loading_content)
	}

}


function showAlert(message, type, timer = 0) {
	// type = ['', 'info', 'danger', 'success', 'warning', 'rose', 'primary'];
	setTimeout(() => {
		Toast.fire({
			icon: type,
			title: message,
		});
	}, timer);

}




function refreshpicker(timer = 1000) {
	setTimeout(function () {
		$('.selectpicker').selectpicker('refresh');
		$('.lods').removeClass('fa-spin');
	}, timer);
}

function frmdata(obj) {
	var formData = new FormData();
	var fd = new FormData();
	for (var key in obj) {
		let val = (typeof(obj[key]) === 'object')?JSON.stringify(obj[key]):obj[key];
        formData.append(key, val);
	}
	return formData;
}

if ($('#navigationpanel').length) {
	var nav = new Vue({
		el: '#navigationpanel',
		data: {
			activenav: ""
		},
		methods: {
			checkactive: function (page = '') {
				var path = window.location.pathname;

				var path = path.split("/", 3).slice(-1)[0];

				return this.activenav == page ? "active" : '';
			}
		}
	});
}



function clearinput(forminput, me) {
	Object.keys(this.data.form).forEach(function (key, index) {
		self.data.form[key] = '';
	})
}

$('.datepicker').datetimepicker({
	format: 'YYYY-MM-DD',
	minDate: new Date(),
	icons: {
		time: "fa fa-clock-o",
		date: "fa fa-calendar",
		up: "fa fa-chevron-up",
		down: "fa fa-chevron-down",
		previous: 'fa fa-chevron-left',
		next: 'fa fa-chevron-right',
		today: 'fa fa-screenshot',
		clear: 'fa fa-trash',
		close: 'fa fa-remove',
		inline: true
	}
});

$('.datepicker_year').datetimepicker({
	format: 'YYYY',
	minDate: new Date(),
	icons: {
		time: "fa fa-clock-o",
		date: "fa fa-calendar",
		up: "fa fa-chevron-up",
		down: "fa fa-chevron-down",
		previous: 'fa fa-chevron-left',
		next: 'fa fa-chevron-right',
		today: 'fa fa-screenshot',
		clear: 'fa fa-trash',
		close: 'fa fa-remove',
		inline: true
	}
});


function refreshtiny() {
	["filemanager",
		"advlist autolink lists link image charmap print preview hr anchor pagebreak",
		"searchreplace wordcount visualblocks visualchars code fullscreen",
		"insertdatetime media nonbreaking save table contextmenu directionality",
		"emoticons template paste textcolor colorpicker textpattern,code"
	]
	tinyMCE.init({
		cleanup_on_startup: false,
		trim_span_elements: false,
		verify_html: false,
		cleanup: false,
		mode: "specific_textareas",
		editor_selector: "myTextEditor",
		theme: "modern",
		plugins: ["image searchreplace wordcount visualblocks visualchars code fullscreen"],
		extended_valid_elements: '*[*]',
		image_advtab: true,

		toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect forecolor backcolor | link unlink anchor | image media | print preview code",
		file_browser_callback: function (field_name, url, type, win) {
			if (type == 'image') {
				var filebrowser = window.App.baseUrl + "/assets/plugin/editor/plugins/filemanager/dialog.php";
				filebrowser += (filebrowser.indexOf("?") < 0) ? "?type=" + 1 + '&field_id=' + field_name : "&type=" + type;
				tinymce.activeEditor.windowManager.open({
					title: "Insert Image",
					filetype: 'image',
					width: 898,
					height: 598,
					url: filebrowser
				}, {
					window: win,
					input: field_name
				});

				return true;
			}
		}
	});
}

$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
})