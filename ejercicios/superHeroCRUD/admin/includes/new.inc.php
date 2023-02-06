<div class="container">
    <div class="row">


        <div class="col-lg-6 form_new">

            <div class="container">
                <div class="d-flex justify-content-center h-100">
                    <div class="card">
                        <div class="card-header">
                            <h3>New User</h3>
                        </div>
                        <div class="card-body">
                            <form role="form" method="post" action="/back/code/work/x7/superHeroCRUD/admin/actions/new.act.php">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" id="username" name="username" class="form-control"
                                           placeholder="username">

                                </div>
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="password">
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Register" class="btn float-right login_btn">
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-center links">
                                Do you have an account?<a
                                        href="/back/code/work/x7/superHeroCRUD/admin/index.php?page=login">Sign In</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-3"></div>

    </div>
</div>