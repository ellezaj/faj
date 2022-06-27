Vue.use(VueTables.ClientTable);
Vue.use(VueTables.ServerTable);

var global_search = new Vue({
    data:{
        search: {
            page_module: '',
            priority: '',
            status: '',
        },
    }
})


var app = new Vue({
	el: '#user_vue',
	data:{		
        update_data: {
            uid: 0,
            role_id:"",
        },        
        global_search : global_search,
		mainTable: {
            columns: ["uid", 
                      "full_name",
                      "role_name", 
                      "username", 
                      "action",
                      ],
            data: {
                list: []
            },
            options: {
                headings:{
                    uid: "ID",
                    full_name: "Full Name",                    
                    role_name: "Role",
                },
                sortable: ["role_id"],
                filterable:false,
                sortIcon: {
                    base : 'fa',
                    is: 'fa-sort',
                    up: 'fa-sort-asc',
                    down: 'fa-sort-desc'
                },
                requestFunction: function (data) {
                    var data = {
                        params: {
                            query: data.query,
                            limit: data.limit,
                            page: data.page,
                            byColumn: data.byColumn,
                            ascending: data.ascending,
                            page_module: global_search.search.page_module,
                            priority: global_search.search.priority,
                            status: global_search.search.status,
                            search_count: true
                        }
                    };              
                    
                    var url = window.App.baseUrl + "get-user-list";
                    return axios.get(url, data)
                        .catch(function (e) {
                            this.dispatch('error', e);
                        }.bind(this));
                },
            },
            
        },
		loading: false
	},
	created(){
	},
	mounted(){        
	},
	methods: {        
        refresh: function(){
            window.location.reload();
        },
        changeRole: function(data){
            app.update_data.uid = data.uid;
            app.update_data.role_id = data.role_id;            
            app.update();
        },
        update: function () {
            this.loading = true;            
            var data = frmdata(this.update_data);
            var urls = window.App.baseUrl + "update-user";
            axios.post(urls, data)
                .then(function (e) {

                    if (e.data.success) {
                        Toast.fire({
                            icon: 'success',
                            title: e.data.message
                        })
                        $('#updateEquipmentTypeModal').modal('hide')
                        app.$refs.main_table.refresh();
                    }
                    else {
                        Swal.fire({
                            html: e.data.message
                        })
                    }
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
		resetFields(){            
            this.form.role_id = "";
        },

	}
});