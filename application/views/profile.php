<div id="profile">
    <div class="row m-2 justify-content-center">
        <div class="col-10">
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal form-material" ref="reg" method="POST" @submit.prevent="update_profile">
                        <h4 class="card-title">User Profile</h4>
                        <div class="form-group">
                          <label for="first_name">First Name: <span class="text-danger">*</span></label>
                          <input type="text" v-model="reg.first_name" class="form-control" id="first_name" required>
                        </div>
                        <div class="form-group">
                          <label for="middle_name">Middle Name: <span class="text-danger">*</span></label>
                          <input type="text" v-model="reg.middle_name" class="form-control" id="middle_name">
                        </div>
                        <div class="form-group">
                          <label for="last_name">Last Name: <span class="text-danger">*</span></label>
                          <input type="text" v-model="reg.last_name" class="form-control" id="last_name" required>
                        </div>
                        <div class="form-group">
                          <label for="contact_number">Contact #: <span class="text-danger">*</span></label>
                          <input type="text" v-model="reg.contact_number" class="form-control" id="contact_number" required>
                        </div>
                        <div class="form-group">
                          <label for="email">Email: <span class="text-danger">*</span></label>
                          <input type="text" v-model="reg.email" class="form-control" id="email" required>
                        </div>



                        <div class="form-group">
                          <label for="username">Username: <span class="text-danger">*</span></label>
                          <input type="text" v-model="reg.username" class="form-control" id="username" required>
                        </div>
                        <div class="form-group">
                          <label for="password">Password: <span class="text-danger">*</span></label>
                          <input type="password" v-model="reg.password" class="form-control" id="password">
                        </div>
                        <div class="form-group">
                          <label for="c_password">Confirm Password: <span class="text-danger">*</span></label>
                          <input type="password" v-model="reg.c_password" class="form-control" id="c_password">
                        </div>
                        <div class="form-group">
                          <label for="province">Province: <span class="text-danger">*</span></label>
                          <select class="form-control" v-model="reg.prov_code" id="province" @change="getMuni(reg.prov_code)">
                            <template v-for="p,i in provList">
                              <option :value="p.prov_code">{{p.prov_name}}</option>
                            </template>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="municipality">Municipality: <span class="text-danger">*</span></label>
                          <select class="form-control" v-model="reg.mun_code" id="municipality">
                             <template v-for="m,i in munList">
                              <option :value="m.mun_code">{{m.mun_name}}</option>
                            </template>
                          </select>
                        </div>
                        <div class="form-group row justify-content-end pt-5">
                            <div class="col-md-3">
                                <button class="btn btn-primary btn-block text-uppercase waves-effect waves-light">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>