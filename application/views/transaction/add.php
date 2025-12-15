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
                            <input type="text" name="order_id" class="form-control" id="order_id" required />
                            <span class="text-danger"><?php echo form_error('order_id'); ?> </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="purchase_id" class="col-md-4 control-label"><span class="text-danger">*</span>Purchase id</label>
                        <div class="col-md-8">
                            <input type="text" name="purchase_id" class="form-control" id="purchase_id" required />
                            <span class="text-danger"><?php echo form_error('purchase_id'); ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="total_cost" class="col-md-4 control-label"><span class="text-danger">*</span>Total
                            Cost</label>
                        <div class="col-md-8">
                            <input type="text" name="total_cost" class="form-control" id="total_cost" required />
                            <span class="text-danger"><?php echo form_error('total_cost'); ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pay_out" class="col-md-4 control-label"><span class="text-danger">*</span>Payout</label>
                        <div class="col-md-8">
                            <input type="text" name="pay_out" class="form-control" id="pay_out" required />
                            <span class="text-danger"><?php echo form_error('pay_out'); ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="user" class="col-md-4 control-label"><span class="text-danger">*</span>User
                            email</label>
                        <div class="col-md-8">
                            <input type="email" name="user" class="form-control" id="user" required />
                            <span class="text-danger"><?php echo form_error('user'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="transaction_date" class="col-md-4 control-label"><span class="text-danger">*</span>Transaction date</label>
                        <div class="col-md-8">
                            <input type="date" name="transaction_date" class="form-control" id="transaction_date" required />
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
        let orderId = sessionStorage.getItem('orderId');
        let user = sessionStorage.getItem('userInfo');
        user = JSON.parse(user);
        if (user) {
            $('#user').val(user[0]['email']);
            $('#order_id').val(orderId);

            // sessionStorage.removeItem('orderId');
            // sessionStorage.removeItem('userInfo');

        }

    });
    $("#addTransaction").submit(function(e) {
        e.preventDefault();
        let downloadTransactions = "<?= site_url('download_transaction') ?>";
        $.ajax({
            url: "<?= site_url('add_transaction') ?>",
            type: "POST",
            data: $(this).serialize(),
            data_type: "json",
            success: function(response) {
                response = JSON.parse(response);
                if (response.status == 'error') {
                    swal("Error", response.message, "error");
                    return;
                }
                swal({
                    title: "Transaction added successfully!",
                    text: "Do you want to reuse the same email?",
                    icon: "success",
                    buttons: {
                        cancel: {
                            text: "No",
                            visible: true,
                            className: "",
                            closeModal: true,
                        },
                        confirm: {
                            text: "Yes",
                            className: "",
                            closeModal: true
                        }
                    }
                }).then((willReuse) => {
                    if (willReuse) {
                        sessionStorage.removeItem('orderId');
                        window.location.reload();
                        let orderID = $('#order_id').val();
                        // $.ajax({
                        //     url: "<?= site_url('download_transaction_file') ?>",
                        //     type: "POST",
                        //     data: {
                        //         orderID,
                        //     },
                        //     success: function(response) {
                        //         console.log(response);
                        //         dataObj = {};
                        //         if (response != 'false') {
                        //             dataObj = JSON.parse(response);
                        //         }
                        //         if (dataObj.message != undefined) {
                        //             swal({
                        //                 title: "Are you sure?",
                        //                 text: dataObj.message,
                        //                 icon: "warning",
                        //                 buttons: true,
                        //                 dangerMode: true,
                        //             }).then((willProceed) => {
                        //                 if (willProceed) {
                        //                     $("#addTransaction").submit();
                        //                 } else {
                        //                     // window.location.href = downloadTransactions;
                        //                 }
                        //                 return;
                        //             });
                        //         } else {
                        //             $("#addTransaction").submit();
                        //         }
                        //     }
                        // });
                    } else {
                        // User pressed NO → reload or go back
                        window.location.href = downloadTransactions;
                    }
                });
            }
        });
    });
</script>