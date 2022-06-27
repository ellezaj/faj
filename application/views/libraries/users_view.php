<div id="user" class="pt-3">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 style="display: inline-block;" class="card-title"><?= $template['title'] ?> Table</h3>
            <button style="display: inline-block; float: right;" type="button" class="btn btn-primary ml-1" data-toggle="modal" data-target="#addUserModal"><i class="fa fa-plus"></i> Add User</button>
          </div>
          <div class="card-body">
            <v-server-table :columns="mainTable.columns" :options="mainTable.options" id="v-ref-code-table" ref="main_table">
              <template slot="access" slot-scope="props">
                <template v-if="parseInt(props.row.access) == 1">
                  <span class="badge badge-primary">Admin</span>
                </template>
                <template v-if="parseInt(props.row.access) == 2">
                  <span class="badge badge-success">Sales</span>
                </template>
              </template>
              <template slot="action" slot-scope="props">
                <button type="button" class="btn btn-warning btn-sm" @click="updateUser(props.row)" data-toggle="modal" data-target="#updateUserModal"><i class="fa fa-edit"></i></button>
                <button type="button" class="btn btn-danger btn-sm" @click="deleteUser(props.row)" data-toggle="modal" data-target="#deleteUserModal"><i class="fa fa-trash"></i></button>
              </template>
            </v-server-table>
          </div>
          <div class="card-footer clearfix">
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="modal" id="addUserModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <form v-on:submit.prevent="save">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <label class="font-weight-bold">Username</label>
                <input class="form-control" v-model="form.username" required></input>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label class="font-weight-bold">Password</label>
                <input class="form-control" v-model="form.password" required></input>
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

  <div class="modal" id="updateUserModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <form v-on:submit.prevent="update_user_form">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Update User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <label class="font-weight-bold">Username</label>
                <input class="form-control" v-model="update_data.username" required></input>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label class="font-weight-bold">Password</label>
                <input class="form-control" v-model="update_data.password" required></input>
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

  <div class="modal" id="deleteUserModal" tabindex="-1" role="dialog">
    <form v-on:submit.prevent="delete_user_form">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete this User?
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