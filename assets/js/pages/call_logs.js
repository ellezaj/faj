Vue.use(VueTables.ClientTable);
Vue.use(VueTables.ServerTable);

var app = new Vue({
  el: '#call_logs',
  data: {
    form: {
      company_name: '',
      web_address: '',
      email_address: '',
      first_name: '',
      last_name: '',
      sole_trader: '',
      address: '',
      post_code: '',
      land_line: '',
      mobile: '',
      field_of_work: '',
      notes: '',
    },
    update_data: {
      id: 0,
      company_name: '',
      web_address: '',
      email_address: '',
      first_name: '',
      last_name: '',
      sole_trader: '',
      address: '',
      post_code: '',
      land_line: '',
      mobile: '',
      field_of_work: '',
      notes: '',
    },
    delete_data: {
      id: 0,
    },
    search: {
      equipment_type: '',
      technician_emp_id: '',
      date: '',
      office_id: 0,
      div_id: 0,
      sec_id: 0,
      unit_id: 0
    },
    mainTable: {
      columns: [
        "company_name",
        "web_address",
        "email_address",
        "persons_name",
        "sole_trader",
        "address",
        "post_code",
        "land_line",
        "mobile",
        "field_of_work",
        "notes",
        "added_by",
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
          equipment_id: "ID",
          equipment_type: "Equipment Type",
          technician_emp: "Technician",
          end_user: "End-User",
          odsu: "Office",
          brand_model: "Brand/Model",
          property_no: "Property Number",
          serial_number: "Serial Number",
          date_created: "Date Created",
          action: "Action",
          date_created: "Date Added",
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
          var url = window.App.baseUrl + "get-preventive-maintenance";
          return axios
            .get(url, {
              params: data
            })
            .catch(function (e) {
              console.log(e);
            });
        },
      },

    },
    loading: false,
  },
  created() {},
  mounted() {

    $('.modal').on('hidden.bs.modal', function () {
      app.resetFields();
    })

  },
  methods: {
    filterSearch() {

      app.$refs.main_table.getData()
    },
    save: function () {
      this.loading = true;
      var data = frmdata(this.form);
      var urls = window.App.baseUrl + "save-preventive-maintenance";
      axios.post(urls, data)
        .then(function (e) {

          if (e.data.success) {
            Toast.fire({
              icon: 'success',
              title: e.data.message
            })
            $('#addEquipmentModal').modal('hide')
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
    updateEquipment: function (data) {
      this.update_data.equipment_id = data.equipment_id;
      this.update_data.equipment_type_id = data.equipment_type_id;
      this.update_data.technician_emp_id = data.technician_emp_id;
      this.update_data.technician = data.technician;
      this.update_data.emp_id = data.emp_id;
      this.update_data.property_no = data.property_no;
      this.update_data.brand_model = data.brand_model;
      this.update_data.serial_number = data.serial_number;
    },
    deleteEquipment: function (data) {
      this.delete_data.equipment_id = data.equipment_id;
    },
    update_equipment_form: function () {
      this.loading = true;
      var data = frmdata(this.update_data);
      var urls = window.App.baseUrl + "update-preventive-maintenance";
      axios.post(urls, data)
        .then(function (e) {

          if (e.data.success) {
            Toast.fire({
              icon: 'success',
              title: e.data.message
            })
            $('#updateEquipmentModal').modal('hide')
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
    delete_equipment_form: function () {
      this.loading = true;
      var data = frmdata(this.delete_data);
      var urls = window.App.baseUrl + "delete-preventive-maintenance";
      axios.post(urls, data)
        .then(function (e) {

          if (e.data.success) {
            Toast.fire({
              icon: 'success',
              title: e.data.message
            })
            $('#deleteEquipmentModal').modal('hide')
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
      this.form.company_name = '';
      this.form.web_address = '';
      this.form.email_address = '';
      this.form.first_name = '';
      this.form.last_name = '';
      this.form.sole_trader = '';
      this.form.address = '';
      this.form.post_code = '';
      this.form.land_line = '';
      this.form.mobile = '';
      this.form.field_of_work = '';
      this.form.notes = '';
      this.form.added_by = '';
      this.form.date_added = '';
      refreshpicker();
    },

  }
});