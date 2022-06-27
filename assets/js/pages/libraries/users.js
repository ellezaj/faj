Vue.use(VueTables.ClientTable);
Vue.use(VueTables.ServerTable);

var global_search = new Vue({
  data: {
    search: {
      page_module: '',
      priority: '',
      status: '',
    },
  }
})

var app = new Vue({
  el: '#user',
  data: {
    form: {
      username: "",
      password: "",
    },
    update_data: {
      uid: 0,
      username: "",
      password: "",
    },
    delete_data: {
      uid: 0,
    },
    global_search: global_search,
    mainTable: {
      columns: ["uid",
        "username",
        "access",
        "action",
      ],
      data: {
        list: []
      },
      options: {
        headings: {
          uid: "ID",
        },
        sortable: ["username"],
        filterable: false,
        sortIcon: {
          base: 'fa',
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

          var url = window.App.baseUrl + "get-user";
          return axios.get(url, data)
            .catch(function (e) {
              this.dispatch('error', e);
            }.bind(this));
        },
      },

    },
    loading: false
  },
  created() {
  },
  mounted() {
    $('.modal').on('hidden.bs.modal', function () {
      app.resetFields();
    })
  },
  methods: {
    searchChangeRequest: function () {
      var data = {
        params: {
          limit: 10,
          page: 1,
          page_module: global_search.search.page_module,
          priority: global_search.search.priority,
          status: global_search.search.status,
          search_count: true
        }
      };

      var url = window.App.baseUrl + "get-user";
      axios.get(url, data)
        .then(function (e) {
          app.$refs.main_table.data = e.data.data;
          app.$refs.main_table.count = parseInt(e.data.count);
        })

    },
    refresh: function () {
      window.location.reload();
    },
    save: function () {
      this.loading = true;
      var data = frmdata(this.form);
      var urls = window.App.baseUrl + "save-user";
      axios.post(urls, data)
        .then(function (e) {

          if (e.data.success) {
            Toast.fire({
              icon: 'success',
              title: e.data.message
            })
            $('#addUserModal').modal('hide')
            app.$refs.main_table.refresh();
            app.resetFields();
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
    updateUser: function (data) {
      this.update_data.uid = data.uid;
      this.update_data.username = data.username;
    },

    deleteUser: function (data) {
      this.delete_data.uid = data.uid;
    },
    update_user_form: function () {
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
            $('#updateUserModal').modal('hide')
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

    delete_user_form: function () {
      this.loading = true;
      var data = frmdata(this.delete_data);
      var urls = window.App.baseUrl + "delete-user";
      axios.post(urls, data)
        .then(function (e) {

          if (e.data.success) {
            Toast.fire({
              icon: 'success',
              title: e.data.message
            })
            $('#deleteUserModal').modal('hide')
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
    resetFields() {
      this.form.equipment_type_description = "";
    },

  }
});