<div class="section-header">
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
            <div class="section-header-breadcrumb-content">
                <h1>Ticket Master Users</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#"><i class="fas fa-home"></i></a></div>
                    <div class="breadcrumb-item"><a href="<?= site_url('normal_user') ?>">Add Ticket Master Users</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-12 col-md-12 col-lg-12">
    <div class="card">

        <div class="card-header">
            <h4>Add Ticket Master User </h4>
        </div>

        <div class="card-body">

            <?php echo form_open('normal_user', array("class" => "form-horizontal",  "id" => "normalUserForm")); ?>

            <?php if (isset($error_response)) {
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
                <label for="email" class="col-md-4 control-label"><span class="text-danger">*</span>Email</label>
                <div class="col-md-8">
                    <input id="email" type="email" name="email" class="form-control" value="<?= set_value('email'); ?>" required />
                    <span class="text-danger"><?php echo form_error('email'); ?></span>
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="col-md-4 control-label"><span class="text-danger">*</span>Password</label>
                <div class="col-md-8">
                    <input type="password" name="password" class="form-control" id="password"  value="<?= set_value('password'); ?>"  required />
                    <span class="text-danger"><?php echo form_error('password'); ?></span>
                </div>
            </div>

            <div class="form-group">
                <label for="cvv" class="col-md-4 control-label"><span class="text-danger">*</span>CVV</label>
                <div class="col-md-8">
                    <input id="cvv" type="text" name="cvv" maxlength="3" class="form-control" value="<?= set_value('cvv'); ?>" required />
                    <span class="text-danger"><?php echo form_error('cvv'); ?></span>
                </div>
            </div>

            <div class="form-group">
                <label for="card_type" class="col-md-4 control-label"><span class="text-danger">*</span>Card
                    Type</label>
                <div class="col-md-8">
                    <select id="card_type" type="text" name="card_type" class="form-control" required>
                        <option value="0">Select Card Type</option>
                        <option value="LIMIT">LIMIT</option>
                        <option value="CD">CD</option>
                    </select>
                    <span class="text-danger"><?php echo form_error('card_type'); ?></span>
                </div>
            </div>

            <div class="form-group">
                <input type="hidden" name="redirect_to" id="redirect_to" value="" />
            </div>

            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                    <button type="submit" class="btn btn-primary" onclick="saveNewUser()">Add</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Transactions</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="normal-user" style="width:100%;">
                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Created date</th>
                            <th>Action</th>
                        </tr>

                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        let cardType = localStorage.getItem('card_type');
        document.getElementById('normalUserForm').reset();
        if (cardType === 'LIMIT') {
            $('#card_type').val(cardType);
            $('#redirect_to').val(cardType);
        }

        $('#normal-user').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: '<?= site_url('normal_user') ?>',
                type: 'POST'
            },
            columns: [
                { data: 'id' },
                { data: 'email' },
                { data: 'created_datetime' },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return `
                                    <a href="<?= site_url('delete_normal_user/') ?>${data.id}" class="btn btn-danger">Delete</a>
                                    <a href="<?= site_url('edit_normal_user/') ?>${data.id}" class="btn btn-primary">Update</a>
                                `;
                        }
                    }
            ]
        });

    });

    function saveNewUser() {
        $newUser = $('#email').val();
        $card_type = $('#card_type').val();
        let userInfo = localStorage.getItem('userInfo');
        
        if ($card_type === 'LIMIT') {
            localStorage.setItem('limitUserInfo', $newUser);
        }

        if (userInfo) {
            userInfo = $newUser;
            localStorage.setItem('userInfo', userInfo);
        } else {
            localStorage.setItem('userInfo', $newUser);
        }
    }
</script>