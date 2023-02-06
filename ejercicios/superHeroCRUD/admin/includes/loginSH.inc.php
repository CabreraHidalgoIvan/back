<div class="container">
    <div class="row">


        <div class="col-lg-6 form_login">

            <div class="container">
                <div class="d-flex justify-content-center h-100">
                    <div class="card">
                        <div class="card-header">
                            <h3>SuperHero</h3>
                        </div>
                        <div class="card-body">
                            <form role="form" method="post"
                                  action="/back/code/work/x7/superHeroCRUD/admin/actions/loginSH.act.php">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" id="usernameSH" name="usernameSH" class="form-control"
                                           placeholder="Hero Name">

                                </div>
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" id="passwordSH" name="passwordSH" class="form-control"
                                           placeholder="password">
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Login" class="btn float-right login_btn">
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-center links">
                                Don't have an account?<a
                                    href="/back/code/work/x7/superHeroCRUD/admin/index.php?page=new">Sign Up</a>
                            </div>
                            <div class="d-flex justify-content-center">
                                <a href="#">Forgot your password?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-3"></div>

    </div>
</div>