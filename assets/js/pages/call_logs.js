Vue.use(VueTables.ClientTable);
Vue.use(VueTables.ServerTable);

var app = new Vue({
  el: '#call_logs',
  data: {
    form: {
      name_of_shop:'',
      country: '',
      city: '',
      web_address: '',
      email_address: '',
      address: '',
      phone_number: '',
      shop_stall: '',
      watches: '',
      jewelry: '',
      jewelry_services: '',
      watch_repairs: '',
      polishing: '',
      casting: '',
      plating: '',
      watch_making: '',
      wholesale: '',
      retail: '',
      auction: '',
      notes: '',
    },
    update_data: {
      id: 0,
      name_of_shop:'',
      country: '',
      city: '',
      web_address: '',
      email_address: '',
      address: '',
      phone_number: '',
      shop_stall: '',
      watches: '',
      jewelry: '',
      jewelry_services: '',
      watch_repairs: '',
      polishing: '',
      casting: '',
      plating: '',
      watch_making: '',
      wholesale: '',
      retail: '',
      auction: '',
      notes: '',
    },
    delete_data: {
      id: 0,
    },
    search: {
      country: '',
      city: '',
      web_address: '',
      email_address: '',
      address: '',
      phone_number: '',
      shop_stall: '',
      category: [],
      added_by: '',
      date_added: '',
    },
    count_calls:0,
    mainTable: {
      columns: [
        "country",
        "city",
        "name_of_shop",
        "web_address",
        "email_address",
        "address",
        "phone_number",
        "shop_stall",
        "watches",
        "jewelry",
        "jewelry_services",
        "watch_repairs",
        "polishing",
        "casting",
        "plating",
        "watch_making",
        "wholesale",
        "retail",
        "auction",
        "notes",
        "username",
        "date_added",
        "action",
      ],
      data: {
        list: []
      },
      options: {
        perPageValues: [10, 25, 50, 100],
        perPage: 10,
        params: this.search,
        headings: {
          shop_stall: "Shop/Stall/Dealer",
          username: "Added by",
          action: "Action",
        },
        sortable: ["equipment_id", "equipment_type_id", "technician_emp_id"],
        filterable: true,
        sortIcon: {
          base: 'fa',
          is: 'fa-sort',
          up: 'fa-sort-asc',
          down: 'fa-sort-desc'
        },
        requestFunction: function (data) {
          // var data = {
          //     params: {
          //         query: data.query,
          //         limit: data.limit,
          //         page: data.page,
          //         byColumn: data.byColumn,
          //         ascending: data.ascending,
          //         equipment_type: global_search.equipment_type,
          //         technician_emp_id: global_search.technician_emp_id,
          //         date: global_search.date,
          //         office_id: global_search.office_id,
          //         div_id: global_search.div_id,
          //         sec_id: global_search.sec_id,
          //         unit_id: global_search.unit_id,                            
          //         search_count: true
          //     }
          // };              
          if (typeof app != "undefined") {
            data.search = app.search
          }
          var url = window.App.baseUrl + "get-client";
          let data_call =  axios
            .get(url, {
              params: data
            })
            .catch(function (e) {
              console.log(e);
            });

            data_call.then(function (e) {
              app.count_calls = e.data.count;
            })

            return data_call 
        },
      },

    },
    loading: false,
    users: [],
  },
  created() {},
  mounted() {

    $('.modal').on('hidden.bs.modal', function () {
      app.resetFields();
    });

    this.getUsers();

  },
  methods: {
    getUsers: function () {
      this.loading = true;
      var data = frmdata(this.update_data);
      var urls = window.App.baseUrl + "get-user-search";
      axios.post(urls, data)
        .then(function (e) {
          app.users = e.data.data;
          refreshpicker();
         
        })
        .catch(function (error) {
          console.log(error)
        });
    },
    filterSearch() {

      app.$refs.main_table.getData()
    },
    save: function () {
      this.loading = true;
      var data = frmdata(this.form);
      var urls = window.App.baseUrl + "save-client";
      axios.post(urls, data)
        .then(function (e) {

          if (e.data.success) {
            Toast.fire({
              icon: 'success',
              title: e.data.message
            })
            $('#addCallLogModal').modal('hide')
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
    updateClient: function (data) {
      this.update_data.id = data.id;
      this.update_data.country = data.country;
      this.update_data.name_of_shop = data.name_of_shop;
      this.update_data.city = data.city;
      this.update_data.web_address = data.web_address;
      this.update_data.email_address = data.email_address;
      this.update_data.address = data.address;
      this.update_data.phone_number = data.phone_number;
      this.update_data.shop_stall = data.shop_stall;
      this.update_data.watches = data.watches;
      this.update_data.jewelry = data.jewelry;
      this.update_data.jewelry_services = data.jewelry_services;
      this.update_data.watch_repairs = data.watch_repairs;
      this.update_data.polishing = data.polishing;
      this.update_data.casting = data.casting;
      this.update_data.plating = data.plating;
      this.update_data.watch_making = data.watch_making;
      this.update_data.wholesale = data.wholesale;
      this.update_data.retail = data.retail;
      this.update_data.auction = data.auction;
      this.update_data.notes = data.notes;
    },
    deleteClient: function (data) {
      this.delete_data.id = data.id;
    },
    update_client_form: function () {
      this.loading = true;
      var data = frmdata(this.update_data);
      var urls = window.App.baseUrl + "update-client";
      axios.post(urls, data)
        .then(function (e) {

          if (e.data.success) {
            Toast.fire({
              icon: 'success',
              title: e.data.message
            })
            $('#updateClientModal').modal('hide')
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
    delete_client_form: function () {
      this.loading = true;
      var data = frmdata(this.delete_data);
      var urls = window.App.baseUrl + "delete-client";
      axios.post(urls, data)
        .then(function (e) {

          if (e.data.success) {
            Toast.fire({
              icon: 'success',
              title: e.data.message
            })
            $('#deleteClientModal').modal('hide')
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
      this.form.name_of_shop = '';
      this.form.country = '';
      this.form.city = '';
      this.form.web_address = '';
      this.form.email_address = '';
      this.form.address = '';
      this.form.phone_number = '';
      this.form.shop_stall = '';
      this.form.watches = '';
      this.form.jewelry = '';
      this.form.jewelry_services = '';
      this.form.watch_repairs = '';
      this.form.polishing = '';
      this.form.casting = '';
      this.form.plating = '';
      this.form.watch_making = '';
      this.form.wholesale = '';
      this.form.retail = '';
      this.form.auction = '';
      this.form.notes = '';
      refreshpicker();
    },
    refresh() {
      this.search =  {
        country: '',
        city: '',
        web_address: '',
        email_address: '',
        address: '',
        phone_number: '',
        shop_stall: '',
        category: [],
        added_by: '',
        date_added: '',
      };
      refreshpicker();
    },

  }
});