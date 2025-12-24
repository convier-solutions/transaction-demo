<div class="section-header">
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
            <div class="section-header-breadcrumb-content">
                <h1>Transactions</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#"><i class="fas fa-home"></i></a></div>
                    <div class="breadcrumb-item"><a href="<?= site_url('add_transaction') ?>">Add Transaction</a></div>
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
                    <h4>Add Transaction</h4>
                </div>

                <div class="card-body">

                    <?php echo form_open('add_transaction', array("class" => "form-horizontal", "id" => "addTransaction")); ?>

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
                        <label for="order_id" class="col-md-4 control-label"><span class="text-danger">*</span>Order
                            id</label>
                        <div class="col-md-8">
                            <input type="text" name="order_id" class="form-control" id="order_id" value="<?= set_value('order_id'); ?>" required />
                            <span class="text-danger"><?php echo form_error('order_id'); ?> </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="purchase_id" class="col-md-4 control-label"><span class="text-danger">*</span>Purchase id</label>
                        <div class="col-md-8">
                            <input type="text" name="purchase_id" class="form-control" id="purchase_id" value="<?= set_value('purchase_id'); ?>" required />
                            <span class="text-danger"><?php echo form_error('purchase_id'); ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="total_cost" class="col-md-4 control-label"><span class="text-danger">*</span>Total
                            Cost</label>
                        <div class="col-md-8">
                            <input type="text" name="total_cost" class="form-control" id="total_cost" value="<?= set_value('total_cost'); ?>" required />
                            <span class="text-danger"><?php echo form_error('total_cost'); ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pay_out" class="col-md-4 control-label"><span class="text-danger">*</span>Payout</label>
                        <div class="col-md-8">
                            <input type="text" name="pay_out" class="form-control" id="pay_out" value="<?= set_value('pay_out'); ?>" required />
                            <span class="text-danger"><?php echo form_error('pay_out'); ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="user" class="col-md-4 control-label"><span class="text-danger">*</span>User
                            email</label>
                        <div class="col-md-8">
                            <input type="email" name="user" class="form-control" id="user" value="<?= set_value('user'); ?>" required />
                            <span class="text-danger"><?php echo form_error('user'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="transaction_date" class="col-md-4 control-label"><span class="text-danger">*</span>Transaction date</label>
                        <div class="col-md-8">
                            <input type="date" name="transaction_date" class="form-control" id="transaction_date" value="<?= set_value('transaction_date'); ?>" required />
                            <span class="text-danger"><?php echo form_error('transaction_date'); ?></span>
                        </div>
                    </div>

                    <!-- <div class="form-group">
                <label for="role" class="col-md-4 control-label"><span class="text-danger">*</span>Users</label>
                <div class="col-md-8">
                    <select name="client_privileges" class="form-control select2" required>
                        <option value="see_all_clients">See All Clients</option>
                        <option value="cannot_see_clients">Cannot See Clients</option>
                        <option value="only_see_assigned_clients">Only See Assigned Clients</option>
                    </select>
                </div>
            </div> -->

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let orderId = localStorage.getItem('orderId');
        let userInfo = localStorage.getItem('userInfo');
        let oldUserInfo = localStorage.getItem('oldUserInfo');
        
        if ( orderId || userInfo ) {
            $('#user').val(userInfo ? userInfo : oldUserInfo);
            $('#order_id').val(orderId);

            // sessionStorage.removeItem('orderId');
            // sessionStorage.removeItem('userInfo');

        }

    });
    $("#addTransaction").submit(function(e) {
        e.preventDefault();

        let form = this;
        let downloadTransactions = "<?= site_url('download_transaction') ?>";
        let oldUserInfo = $('#user').val();

        $.ajax({
            url: "<?= site_url('add_transaction') ?>",
            type: "POST",
            data: $(form).serialize(),
            dataType: "json",
            success: function(response) {

                if (response.status === 'error') {
                    swal("Error", response.message, "error");
                    return;
                }

                localStorage.removeItem('orderId');
                localStorage.setItem('transactionAdded', 'true');
                localStorage.setItem('isCdTransaction', 'false');
                localStorage.removeItem('card_type');
                window.location.href = downloadTransactions;

            },
        });
    });
</script>