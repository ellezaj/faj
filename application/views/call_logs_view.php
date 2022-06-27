<div id="call_logs" class="pt-3">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 style="display: inline-block;" class="card-title"><?= $template['title'] ?> Table</h3>
              <button style="float: right;" type="button" class="btn btn-primary ml-1" data-toggle="modal" data-target="#addCallLogModal"><i class="fa fa-plus"></i> Add Call Log</button>
          </div>
          <div class="card-body">

            <div class="row" style="margin-bottom: 15px;">
              <div class="col-md-12">
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                  <i class="fa fa-search"></i> Advance Search
                </button>
              </div>
            </div>
            <div class=" collapse" id="collapseExample">

              <div class="row">
                <div class="col-md-4 form-group">
                  <label class="font-weight-bold">Equipment Type</label>
                  <select class="selectpicker form-control" data-live-search="true" title="Select Equipment Type" v-model="search.equipment_type">
                    <option value="0" selected="">Select Equipment Type</option>
                    <option v-for="v in equipment_type" :value="v.equipment_type_id">{{v.equipment_type_description}}</option>
                  </select>
                </div>
                <div class="col-md-4 form-group">
                  <label class="font-weight-bold">Technician</label>
                  <select id="obsu_select" class="selectpicker form-control" data-live-search="true" title="Select a Technician" v-model="search.technician_emp_id">
                    <option value="0" selected="">Select a Technician</option>
                    <option v-for="v in technician" :value="v.emp_id">{{v.full_name}}</option>
                  </select>
                </div>
                <div class="col-md-4 form-group">
                  <label class="font-weight-bold">Date</label>
                  <input type="date" class="form-control" v-model="search.date">
                </div>
              </div>
              <div class="row">
                <div class="col-md-3 form-group">
                  <label class="font-weight-bold">Office</label>
                  <select class="selectpicker form-control" data-live-search="true" title="Select Office" v-model="search.office_id" required>
                    <option value="0" selected="">Select an Office</option>
                    <option v-for="office in office" :value="office.office_id" :data-subtext="office.office_title">{{office.office_shortname}}</option>
                  </select>
                </div>
                <div class="col-md-3 form-group">
                  <label class="font-weight-bold">Division</label>
                  <select class="selectpicker form-control" data-live-search="true" title="Select Division" v-model="search.div_id">
                    <option value="0" selected="">Select a Division</option>
                    <option v-for="div in division" :value="div.div_id" :data-subtext="div.div_title">{{div.div_shortname}}</option>
                  </select>
                </div>
                <div class="col-md-3 form-group">
                  <label class="font-weight-bold">Section</label>
                  <select class="selectpicker form-control" data-live-search="true" title="Select Section" v-model="search.sec_id">
                    <option value="0" selected="">Select a Section</option>
                    <option v-for="section in section" :value="section.sec_id" :data-subtext="section.sec_title">{{section.sec_shortname}}</option>
                  </select>
                </div>
                <div class="col-md-3 form-group">
                  <label class="font-weight-bold">Unit</label>
                  <select class="selectpicker form-control" data-live-search="true" title="Select Unit" v-model="search.unit_id">
                    <option value="0" selected="">Select a Unit</option>
                    <option v-for="unit in unit" :value="unit.unit_id" :data-subtext="unit.unit_title">{{unit.unit_shortname}}</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <button class="btn btn-primary" @click="filterSearch">Search</button>
                  <button class="btn btn-warning" @click="refresh()">Reset Filter</button>
                </div>
              </div>
            </div>

            <!-- <v-server-table :columns="mainTable.columns" :options="mainTable.options" id="v-ref-code-table" ref="main_table">
              <template slot="action" slot-scope="props">
                <a :href="getUrl(props.row.equipment_id)" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                <?php if (sesdata('role_id') == 1 || sesdata('role_id') == 2) : ?>
                  <button type="button" class="btn btn-warning btn-sm" @click="updateEquipment(props.row)" data-toggle="modal" data-target="#updateEquipmentModal"><i class="fa fa-edit"></i></button>
                  <button type="button" class="btn btn-danger btn-sm" @click="deleteEquipment(props.row)" data-toggle="modal" data-target="#deleteEquipmentModal"><i class="fa fa-trash"></i></button>
                <?php endif; ?>
              </template>
            </v-server-table> -->
          </div>
          <div class="card-footer clearfix">
          </div>
        </div>
      </div>
    </div>
  </div>

<div class="modal" id="addCallLogModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <form v-on:submit.prevent="save">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Call Log</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Company Name</label>
                                <input type="text" class="form-control form-control-sm" v-model="form.company_name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Web Address</label>
                                <textarea class="form-control form-control-sm" v-model="form.web_address"></textarea>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Email Address</label>
                                <input type="email" class="form-control form-control-sm" v-model="form.email_address">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="font-weight-bold">First Name <span style="color: red">*</span></label>
                                <input type="text" class="form-control form-control-sm" v-model="form.first_name">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="font-weight-bold">Last Name <span style="color: red">*</span></label>
                                <input type="text" class="form-control form-control-sm" v-model="form.last_name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Sole Trader or Limited Company</label>
                                <input type="text" class="form-control form-control-sm" v-model="form.sole_trader">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Address</label>
                                <textarea class="form-control form-control-sm" v-model="form.address"></textarea>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Post Code</label>
                                <input type="text" class="form-control form-control-sm" v-model="form.post_code">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Landline <span style="color: red">*</span></label>
                                <input type="text" class="form-control form-control-sm" v-model="form.land_line">
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Mobile</label>
                                <input type="text" class="form-control form-control-sm" v-model="form.mobile">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Field of Work</label>
                                <input type="text" class="form-control form-control-sm" v-model="form.field_of_work">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="font-weight-bold">Notes</label>
                                <textarea class="form-control form-control-sm" v-model="form.notes"></textarea>
                            </div>
                        </div>
                    </div>
           
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success">Add</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

  <div class="modal" id="updateEquipmentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <form v-on:submit.prevent="update_equipment_form">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Update Equipment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="font-weight-bold">Equipment Type</label>
                  <select class="form-control" v-model="update_data.equipment_type_id" required>
                    <option value="">Select Equipment Type</option>
                    <option v-for="v,i in equipment_type" :value="v.equipment_type_id">{{v.equipment_type_description}}</option>
                  </select>
                </div>
              </div>
            </div>
            <!-- <div class="row">
                            <div class="col-md-12">
                                <label class="font-weight-bold">Technician</label>
                                <select class="form-control" v-model="update_data.technician_emp_id" required>
                                    <option value="">Select Technician</option>
                                    <option v-for="v,i in technician" :value="v.emp_id">{{v.full_name}}</option>
                                </select>
                            </div>
                        </div> -->
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="font-weight-bold">End-User <span style="color: red">*</span></label>
                  <select class="form-control selectpicker" data-live-search="true" v-model="update_data.emp_id" required>
                    <option value="">Select End-User</option>
                    <option v-for="v,i in end_user" :value="v.emp_id">{{v.full_name}}</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row" v-if="update_data.equipment_type_id == 9 || update_data.equipment_type_id == 1 || update_data.equipment_type_id == 3">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="font-weight-bold">Computer Name</label>
                  <input class="form-control" v-model="update_data.computer_name"></input>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="font-weight-bold">Property Number <span style="color: red">*</span></label>
                  <input class="form-control" v-model="update_data.property_no" required></input>
                </div>
              </div>
            </div>
            <div class="row" v-if="update_data.equipment_type_id == 8 || update_data.equipment_type_id == 4 || update_data.equipment_type_id == 6">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="font-weight-bold">Brand and Model</label>
                  <input class="form-control" v-model="update_data.brand_model"></input>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="font-weight-bold">Serial Number <span style="color: red">*</span></label>
                  <input class="form-control" v-model="update_data.serial_number" required></input>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-warning">Update</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="modal" id="deleteEquipmentModal" tabindex="-1" role="dialog">
    <form v-on:submit.prevent="delete_equipment_form">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete Equipment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="text" v-model="delete_data.equipment_id" hidden>
            Are you sure you want to delete this Equipment?
          </div>
          <div class="modal-footer">
            <button class="btn btn-success">Confirm</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>