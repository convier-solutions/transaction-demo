<div class="section-header">
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
            <div class="section-header-breadcrumb-content">
                <h1>Users</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#"><i class="fas fa-home"></i></a></div>
                    <div class="breadcrumb-item"><a href="<?= site_url('list') ?>">Users</a></div>
                    <div class="breadcrumb-item"><a href="">Edit</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h4>Update Portal User</h4>
                </div>

                <div class="card-body">

                    <?php echo form_open('edit/' . $user_id, array("class" => "form-horizontal")); ?>

                    <?php
                    if (isset($success_response)) {
                    ?>
                        <div class="alert alert-success alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                                <?= $success_response ?>
                            </div>
                        </div>
                    <?php
                    } else if (isset($error_response)) {
                    ?>
                        <div class="alert alert-danger alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                                <?= $error_response ?>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="form-group">
                        <label for="first_name" class="col-md-4 control-label"><span class="text-danger">*</span>First Name</label>
                        <div class="col-md-8">
                            <input type="text" name="first_name" value="<?= $user[0]['first_name'] ?>" class="form-control" id="first_name" />
                            <span class="text-danger"><?php echo form_error('first_name'); ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="last_name" class="col-md-4 control-label"><span class="text-danger">*</span>Last Name</label>
                        <div class="col-md-8">
                            <input type="text" name="last_name" value="<?= $user[0]['last_name'] ?>" class="form-control" id="last_name" />
                            <span class="text-danger"><?php echo form_error('last_name'); ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label"><span class="text-danger">*</span>Email</label>
                        <div class="col-md-8">
                            <input type="email" name="email" value="<?= $user[0]['email'] ?>" class="form-control" id="email" />
                            <span class="text-danger"><?php echo form_error('email'); ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-md-4 control-label"><span class="text-danger">*</span>Password</label>
                        <div class="col-md-8">
                            <input type="text" name="password" class="form-control" id="password" value="<?= $user[0]['password'] ?>" />
                            <span class="text-danger"><?php echo form_error('password'); ?></span>
                        </div>
                    </div>

                    <div>
                        <h5>Select ACL modules</h5>
                        <hr>
                    </div>

                    <div class="acl_modules">
                        <div class="row">
                            <div class="col-lg-1"></div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <input class="form-check-input" type="checkbox" value="" id="select-all"><label class="col-sm-7 control-label">Select All</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php $i = 0;
                        foreach ($modules as $module) {
                            $checked = '';
                            if ($i % 2 == 0) {

                        ?>
                                <div class="row">
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <div class="col-sm-10">
                                                <?php if (isset($acl_module)) {
                                                    foreach ($acl_module as $single_acl_module) {
                                                        if ($module['module_id'] == $single_acl_module) {
                                                            $checked = 'checked';
                                                        }
                                                    }
                                                }
                                                echo '<input ' . $checked . ' class="form-check-input module_checkbox" name="modulesid[]" type="checkbox" value="' . $module['module_id'] . '"><label class="col-sm-7 control-label">' . $module['module_name'] . '</label>'
                                                ?>
                                                <!-- <input class="form-check-input" name="modulesid[]" type="checkbox" value="<?= $module['module_id'] ?>"><label class="col-sm-7 control-label"><?= $module['module_name'] ?></label> -->
                                            </div>
                                        </div>
                                    </div>
                                <?php    } else {
                                ?>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <div class="col-sm-10">
                                                <?php if (isset($acl_module)) {
                                                    foreach ($acl_module as $single_acl_module) {
                                                        if ($module['module_id'] == $single_acl_module) {
                                                            $checked = 'checked';
                                                        }
                                                    }
                                                }
                                                echo '<input ' . $checked . ' class="form-check-input module_checkbox" name="modulesid[]" type="checkbox" value="' . $module['module_id'] . '"><label class="col-sm-7 control-label">' . $module['module_name'] . '</label>'
                                                ?>
                                                <!-- <input class="form-check-input" name="modulesid[]" type="checkbox" value="<?= $module['module_id'] ?>"><label class="col-sm-7 control-label"><?= $module['module_name'] ?></label> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php  }
                            $i++;
                        }
                        ?>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <button type="submit" name="add_user" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $('#checkBtn').click(function() {
        checked = $("input[type=checkbox]:checked").length;

        if (!checked) {
            Swal.fire(
                'Please select ACL modules',
                'You must have to select atleast one ACL module?',
                'info'
            );
            return false;
        }

    });

    $('#select-all').click(function(event) {
        if (this.checked) {
            // Iterate each checkbox
            $(':checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $(':checkbox').each(function() {
                this.checked = false;
            });
        }
    });
</script>