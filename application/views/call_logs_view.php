<div id="call_logs" class="pt-3">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 style="display: inline-block;" class="card-title"><?= $template['title'] ?> Table</h3>
              <button style="float: right;" type="button" class="btn btn-primary ml-1" data-toggle="modal" data-target="#addCallLogModal"><i class="fa fa-plus"></i> Add Jewelry</button>
          </div>
          <div class="card-body">
            <div class="c-callout c-callout-danger"><small class="">Total Jewelries</small>
                <div class="text-value-lg">{{count_calls}}</div>
            </div>
            <div class="row" style="margin-bottom: 15px;">
              <div class="col-md-12">
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                  <i class="fa fa-search"></i> Advance Search
                </button>
              </div>
            </div>
            <div class=" collapse" id="collapseExample">

              <div class="row">
                <div class="col-md-3 form-group">
                  <label class="font-weight-bold">Country</label>
                  <input type="text" class="form-control" v-model="search.country">
                </div>
                <div class="col-md-3 form-group">
                  <label class="font-weight-bold">City</label>
                  <input type="text" class="form-control" v-model="search.city">
                </div>
                <div class="col-md-3 form-group">
                  <label class="font-weight-bold">Web Address</label>
                  <input type="text" class="form-control" v-model="search.web_address">
                </div>
                <div class="col-md-3 form-group">
                  <label class="font-weight-bold">Email Address</label>
                  <input type="text" class="form-control" v-model="search.email_address">
                </div>
              </div>
              <div class="row">
                <div class="col-md-3 form-group">
                  <label class="font-weight-bold">Address</label>
                  <input type="text" class="form-control" v-model="search.address">
                </div>
                <div class="col-md-3 form-group">
                  <label class="font-weight-bold">Phone number</label>
                  <input type="text" class="form-control form-control-sm" v-model="search.sole_trader">
                </div>
                <div class="col-md-3 form-group">
                  <label class="font-weight-bold">Shop/Stall/Dealer</label>
                  <select class="form-control" v-model="search.shop_stall">
                    <option value="shop">Shop</option>
                    <option value="stall">Stall</option>
                    <option value="dealer">Dealer</option>
                  </select>
                </div>
                <div class="col-md-3 form-group">
                  <label class="font-weight-bold">Category</label>
                  <select class="selectpicker form-control" v-model="search.category" multiple>
                    <option value="watches">Watches</option>
                    <option value="jewelry">Jewelry</option>
                    <option value="jewelry_services">Jewelry Services</option>
                    <option value="watch_repairs">Watch Repairs</option>
                    <option value="polishing">Polishing</option>
                    <option value="casting">Casting</option>
                    <option value="plating">Plating</option>
                    <option value="watch_making">Watch Making</option>
                    <option value="wholesale">Wholesale</option>
                    <option value="retail">Retail</option>
                    <option value="auction">Auction</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3 form-group">
                  <label class="font-weight-bold">Added by</label>
                  <select id="obsu_select" class="selectpicker form-control" data-live-search="true" v-model="search.added_by">
                    <option value="0" selected="">Select a User</option>
                    <option v-for="v,k in users" :value="k">{{v}}</option>
                  </select>
                </div>
                <div class="col-md-3 form-group">
                  <label class="font-weight-bold">Date Added</label>
                  <input type="date" class="form-control" v-model="search.date_added">
                </div>
                <div class="col-md-6 form-group">
                  <label class="font-weight-bold">&nbsp;</label>
                  <br>
                  <button class="btn btn-primary" @click="filterSearch">Search</button>
                  <button class="btn btn-warning" @click="refresh()">Reset Filter</button>
                </div>
              </div>
            </div>

            <v-server-table :columns="mainTable.columns" :options="mainTable.options" id="v-ref-code-table" ref="main_table">
            
              <template slot="watches" slot-scope="props">
                <i v-if="props.row.watches == 1" class="fa fa-check"></i><i v-else class="fa fa-times"></i>
              </template>
              <template slot="jewelry" slot-scope="props">
                <i v-if="props.row.jewelry == 1" class="fa fa-check"></i><i v-else class="fa fa-times"></i>
              </template>
              <template slot="jewelry_services" slot-scope="props">
                <i v-if="props.row.jewelry_services == 1" class="fa fa-check"></i><i v-else class="fa fa-times"></i>
              </template>
              <template slot="watch_repairs" slot-scope="props">
                <i v-if="props.row.watch_repairs == 1" class="fa fa-check"></i><i v-else class="fa fa-times"></i>
              </template>
              <template slot="polishing" slot-scope="props">
                <i v-if="props.row.polishing == 1" class="fa fa-check"></i><i v-else class="fa fa-times"></i>
              </template>
              <template slot="casting" slot-scope="props">
                <i v-if="props.row.casting == 1" class="fa fa-check"></i><i v-else class="fa fa-times"></i>
              </template>
              <template slot="plating" slot-scope="props">
                <i v-if="props.row.plating == 1" class="fa fa-check"></i><i v-else class="fa fa-times"></i>
              </template>
              <template slot="watch_making" slot-scope="props">
                <i v-if="props.row.watch_making == 1" class="fa fa-check"></i><i v-else class="fa fa-times"></i>
              </template>
              <template slot="wholesale" slot-scope="props">
                <i v-if="props.row.wholesale == 1" class="fa fa-check"></i><i v-else class="fa fa-times"></i>
              </template>
              <template slot="retail" slot-scope="props">
                <i v-if="props.row.retail == 1" class="fa fa-check"></i><i v-else class="fa fa-times"></i>
              </template>
              <template slot="auction" slot-scope="props">
                <i v-if="props.row.auction == 1" class="fa fa-check"></i><i v-else class="fa fa-times"></i>
              </template>

              <template slot="action" slot-scope="props">
                <button type="button" class="btn btn-warning btn-sm" @click="updateClient(props.row)" data-toggle="modal" data-target="#updateClientModal"><i class="fa fa-edit"></i></button>
                <template v-if="parseInt(props.row.added_by) == <?=sesdata('user_id')?> || <?=sesdata('access')?> == 1">
                  <button type="button" class="btn btn-danger btn-sm" @click="deleteClient(props.row)" data-toggle="modal" data-target="#deleteClientModal"><i class="fa fa-trash"></i></button>
                </template>
              </template>
            </v-server-table>
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
                    <h5 class="modal-title">Add Jewelry</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Country</label>
                                <input type="text" class="form-control form-control-sm" v-model="form.country">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">City</label>
                                <input type="text" class="form-control form-control-sm" v-model="form.city">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Web Address</label>
                                <input type="text" class="form-control form-control-sm" v-model="form.web_address">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Address</label>
                                <input type="text" class="form-control form-control-sm" v-model="form.address">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Phone Number</label>
                                <input type="text" class="form-control form-control-sm" v-model="form.phone_number">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Shop/Stall/Dealer</label>
                                <select class="form-control" v-model="form.shop_stall">
                                  <option value="shop">Shop</option>
                                  <option value="stall">Stall</option>
                                  <option value="dealer">Dealer</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Name of Shop</label>
                                <input type="text" class="form-control form-control-sm" v-model="form.name_of_shop">
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-sm" id="call_table">
                      <tr>
                        <td>
                          <label class="d-block" for="watches"><input type="checkbox" true-value=1 false-value=0 v-model="form.watches" id="watches"> Watches</label>
                        </td>
                        <td>
                          <label for="jewelry" class="d-block"><input type="checkbox" id="jewelry" true-value=1 false-value=0 v-model="form.jewelry"> Jewelry</label>
                        </td>
                        <td>
                          <label class="d-block" for="jewelry_services"><input type="checkbox" true-value=1 false-value=0 v-model="form.jewelry_services" id="jewelry_services"> Jewelry Services</label>
                        </td>
                        <td>
                          <label for="watch_repairs" class="d-block"><input type="checkbox" id="watch_repairs" true-value=1 false-value=0 v-model="form.watch_repairs"> Watch Repairs</label>
                        </td>
                        <td>
                          <label for="polishing" class="d-block"><input type="checkbox" id="polishing" true-value=1 false-value=0 v-model="form.polishing"> Polishing</label>
                        </td>
                        <td>
                          <label class="d-block" for="casting"><input type="checkbox" true-value=1 false-value=0 v-model="form.casting" id="casting"> Casting</label>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <label for="plating" class="d-block"><input type="checkbox" id="plating" true-value=1 false-value=0 v-model="form.plating"> Plating</label>
                        </td>
                        <td>
                          <label class="d-block" for="watch_making"><input type="checkbox" true-value=1 false-value=0 v-model="form.watch_making" id="watch_making"> Watch Making</label>
                        </td>
                        <td>
                          <label for="wholesale" class="d-block"><input type="checkbox" id="wholesale" true-value=1 false-value=0 v-model="form.wholesale"> Wholesale</label>
                        </td>
                        <td>
                          <label for="retail" class="d-block"><input type="checkbox" id="retail" true-value=1 false-value=0 v-model="form.retail"> Retail</label>
                        </td>
                        <td>
                          <label for="auction" class="d-block"><input type="checkbox" id="auction" true-value=1 false-value=0 v-model="form.auction"> Auction</label>
                        </td>
                      </tr>
                    </table>
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

  <div class="modal" id="updateClientModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
      <form v-on:submit.prevent="update_client_form">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Update Jewelry</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">Country</label>
                        <input type="text" class="form-control form-control-sm" v-model="update_data.country">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">City</label>
                        <input type="text" class="form-control form-control-sm" v-model="update_data.city">
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">Email Address</label>
                        <input type="email" class="form-control form-control-sm" v-model="update_data.email_address">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">Web Address</label>
                        <input type="text" class="form-control form-control-sm" v-model="update_data.web_address">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">Address</label>
                        <input type="text" class="form-control form-control-sm" v-model="update_data.address">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">Phone Number</label>
                        <input type="text" class="form-control form-control-sm" v-model="update_data.phone_number">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">Shop/Stall/Dealer</label>
                        <select class="form-control" v-model="update_data.shop_stall">
                          <option value="shop">Shop</option>
                          <option value="stall">Stall</option>
                          <option value="dealer">Dealer</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">Name of Shop</label>
                        <input type="text" class="form-control form-control-sm" v-model="update_data.name_of_shop">
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-sm" id="call_table">
              <tr>
                <td>
                  <label class="d-block" for="u_watches"><input type="checkbox" true-value=1 false-value=0 v-model="update_data.u_watches" id="watches"> Watches</label>
                </td>
                <td>
                  <label for="u_jewelry" class="d-block"><input type="checkbox" id="u_jewelry" true-value=1 false-value=0 v-model="update_data.jewelry"> Jewelry</label>
                </td>
                <td>
                  <label class="d-block" for="u_jewelry_services"><input type="checkbox" true-value=1 false-value=0 v-model="update_data.jewelry_services" id="u_jewelry_services"> Jewelry Services</label>
                </td>
                <td>
                  <label for="u_watch_repairs" class="d-block"><input type="checkbox" id="u_watch_repairs" true-value=1 false-value=0 v-model="update_data.watch_repairs"> Watch Repairs</label>
                </td>
                <td>
                  <label for="u_polishing" class="d-block"><input type="checkbox" id="u_polishing" true-value=1 false-value=0 v-model="update_data.polishing"> Polishing</label>
                </td>
                <td>
                  <label class="d-block" for="u_casting"><input type="checkbox" true-value=1 false-value=0 v-model="update_data.casting" id="u_casting"> Casting</label>
                </td>
              </tr>
              <tr>
                <td>
                  <label for="u_plating" class="d-block"><input type="checkbox" id="u_plating" true-value=1 false-value=0 v-model="update_data.plating"> Plating</label>
                </td>
                <td>
                  <label class="d-block" for="u_watch_making"><input type="checkbox" true-value=1 false-value=0 v-model="update_data.watch_making" id="u_watch_making"> Watch Making</label>
                </td>
                <td>
                  <label for="u_wholesale" class="d-block"><input type="checkbox" id="u_wholesale" true-value=1 false-value=0 v-model="update_data.wholesale"> Wholesale</label>
                </td>
                <td>
                  <label for="u_retail" class="d-block"><input type="checkbox" id="u_retail" true-value=1 false-value=0 v-model="update_data.retail"> Retail</label>
                </td>
                <td>
                  <label for="u_auction" class="d-block"><input type="checkbox" id="u_auction" true-value=1 false-value=0 v-model="update_data.auction"> Auction</label>
                </td>
              </tr>
            </table>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="font-weight-bold">Notes</label>
                        <textarea class="form-control form-control-sm" v-model="update_data.notes"></textarea>
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

  <div class="modal" id="deleteClientModal" tabindex="-1" role="dialog">
    <form v-on:submit.prevent="delete_client_form">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete Client</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete this Client?
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