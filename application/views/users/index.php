<div class="section-header">
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
            <div class="section-header-breadcrumb-content">
                <h1>Users</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#"><i class="fas fa-home"></i></a></div>
                    <div class="breadcrumb-item"><a href="<?= site_url('list')?>">Users</a></div>
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
                    <h4>Users</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th class="text-center">created date</th>
                                    <th class="text-center">created by</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user){
                                ?>
                                <tr>
                                    <td><?= $user['id']; ?></td>
                                    <td><?= $user['first_name'] ." ". $user['last_name']; ?></td>
                                    <td><?= $user['email'] ;?></td>
                                    <td class="text-center"><?= $user['created_date']; ?></td>
                                    <td class="text-center"><?= $user['created_by']; ?></td>
                                    <td class="text-center"><a href="<?= site_url('edit/'.$user['id'])?>" class="btn btn-primary">Udpate</a> &nbsp<a href="<?= site_url('delete/'.$user['id'])?>" class="btn btn-danger">Delete</a></td>
                                </tr>
                                <?php
                                }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>