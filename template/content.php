<div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-6">
                   <h3 style="margin-top:50px;" class="text-center text-success">Join the Largest network of Bollywood Celibrety</h3>
                    <img src="images/004.jpg" class="img-responsive img-thumbnail " style="margin-top:20px; ; border-radius:20px;">
                </div>
                <div class="col-md-5">
                  <h3 style="margin-top:50px;" class="text-center text-success">Sign Up Here</h3>
                   <form class="form-horizontal" style="margin-top:50px;" method="post" action="">
                      <div class="form-group">
                        <label  class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-8">
                          <input type="text" name="u_name" class="form-control"  placeholder="Gaurav Sontakke" required="required">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label  class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-8">
                          <input type="password" name="u_pass" class="form-control"  placeholder="*****" required="required">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label  class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-8">
                          <input type="email"  name="u_email" class="form-control"  placeholder="santu.ghau@gmail.com" required="required">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label  class="col-sm-2 control-label">Country</label>
                        <div class="col-sm-8">
                          <select class="form-control" name="u_country">
                              <option>Please select</option>
                              <option>India</option>
                              <option>Nepal</option>
                              <option>United States</option>
                              <option>Japan</option>
                           </select>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label  class="col-sm-2 control-label">Gender</label>
                        <div class="col-sm-8">
                          <select class="form-control" name="u_gender">
                              <option>Please select</option>
                              <option>Male</option>
                              <option>Female</option>
                          </select>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label  class="col-sm-2 control-label">Birthday</label>
                        <div class="col-sm-8">
                          <input type="date" class="form-control" name="u_birthday" required="required" >
                        </div>
                      </div>
                      <div class="col-md-5"></div>
                      <button type="submit" name="u_submit" class="btn btn-primary ">SignUp</button>
                      
                    </form> 
                    <?php include("user_insert.php"); ?>
                </div>
            </div>