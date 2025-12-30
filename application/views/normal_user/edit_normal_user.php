<div class="section-header">
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
            <div class="section-header-breadcrumb-content">
                <h1>Ticket Master Users</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#"><i class="fas fa-home"></i></a></div>
                    <div class="breadcrumb-item"><a href="<?= site_url('normal_user') ?>">Update Ticket Master Users</a>
                    </div>
                    <div class="breadcrumb-item"><a href="">Edit</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-12 col-md-12 col-lg-12">
    <div class="card">

        <div class="card-header">
            <h4>Update Ticket Master User </h4>
        </div>

        <div class="card-body">

            <?php echo form_open('edit_normal_user/' . $id, array("class" => "form-horizontal")); ?>

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
                <label for="" class="col-md-4 control-label"><span class="text-danger">*</span>Email</label>
                <div class="col-md-8">
                    <input type="email" name="email" class="form-control" id="" value="<?= $user[0]['email'] ?>" />
                    <span class="text-danger"><?php echo form_error('email'); ?></span>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-md-4 control-label"><span class="text-danger">*</span>Password</label>
                <div class="col-md-8">
                    <input type="text" name="password" class="form-control" id="" value="<?= $user[0]['password'] ?>" />
                    <span class="text-danger"><?php echo form_error('password'); ?></span>
                </div>
            </div>

            <div class="form-group">
                <label for="cvv" class="col-md-4 control-label"><span class="text-danger">*</span>CVV</label>
                <div class="col-md-8">
                    <input id="cvv" type="text" name="cvv" maxlength="3" value="<?= $user[0]['cvv'] ?>" class="form-control" required />
                    <span class="text-danger"><?php echo form_error('cvv'); ?></span>
                </div>
            </div>

            <div class=" form-group">
                <label for="card_type" class="col-md-4 control-label"><span class="text-danger">*</span>Card
                    Type</label>
                <div class="col-md-8">
                    <select id="card_type" type="text" name="card_type" class="form-control" required>
                        <option>Select Card Type</option>
                        <option <?= ($user[0]['card_type'] === 'LIMIT') ? 'selected' : '' ?> value="LIMIT">LIMIT
                        </option>
                        <option <?= ($user[0]['card_type'] === 'BOFA') ? 'selected' : '' ?> value="BOFA">BOFA</option>
                        <option <?= ($user[0]['card_type'] === 'CD') ? 'selected' : '' ?> value="CD">CD</option>
                    </select>
                    <span class="text-danger"><?php echo form_error('card_type'); ?></span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>

</div>