<div class="section-header">
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
            <div class="section-header-breadcrumb-content">
                <h1>Dashboard</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#"><i class="fas fa-home"></i></a></div>
                    <div class="breadcrumb-item"><a href="<?= site_url('') ?>">Dashboard</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$modules = $this->config->item("modules");
if (check_modules_access($modules['all_transaction']['module_id']) == true) {
?>
    <style>
        /* Pagination container */
        .pagination {
            display: flex;
            justify-content: center;
            /* center the pagination */
            align-items: center;
            margin: 20px 0;
            gap: 5px;
            /* spacing between page links */
            flex-wrap: wrap;
            font-family: Arial, sans-serif;
        }

        /* Page links */
        .pagination a,
        .pagination strong {
            display: block;
            padding: 8px 12px;
            text-decoration: none;
            color: #007bff;
            /* main color */
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: all 0.2s;
        }

        /* Hover effect for links */
        .pagination a:hover {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }

        /* Active page */
        .pagination strong {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }

        /* Optional: next/prev arrows styling */
        .pagination a[rel="next"],
        .pagination a[rel="prev"] {
            font-weight: bold;
            padding: 8px 10px;
        }
    </style>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Transactions (<?= $total_records ?? 0; ?>)</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Order id</th>
                                        <th>Purchase id</th>
                                        <th>Email</th>
                                        <th>amount</th>
                                        <th>Payout</th>
                                        <th>transaction date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($transactions as $key => $c) { ?>
                                        <tr>
                                            <td><?php echo $c['id']; ?></td>
                                            <td><?php echo $c['order_id']; ?></td>
                                            <td><?php echo $c['purchase_id']; ?></td>
                                            <td><?php echo $c['email']; ?></td>
                                            <td><?php echo $c['amount']; ?></td>
                                            <td><?php echo $c['pay_out']; ?></td>
                                            <td><?php echo $c['transaction_date']; ?></td>
                                            <td>
                                                <a href="<?= site_url('delete_transaction/' . $c['id']) ?>" class="btn btn-danger">Delete</a>
                                                <a href="<?= site_url('update_transaction/' . $c['id']) ?>" class="btn btn-primary">Update</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <!-- Pagination links -->
                            <div>
                                <?= $pagination; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php
} ?>
<script>
$(document).ready(function() {
    // Destroy DataTable if it was initialized
    if ($.fn.DataTable.isDataTable('#save-stage')) {
        $('#save-stage').DataTable().destroy();
    }
    
    // Or simply don't initialize it at all
    // Just remove any DataTable initialization code
});
</script>