<style>
    #refreshUser:hover{
         background-color: #bfc6cd !important;

    }
    #refreshUser.refresh-bg {
        background-color: #1f2935 !important;
    }
     #refreshUser.refresh-bg:active {
        background-color: #086aebff !important;
    }

     #refreshUser.refresh-bg:hover {
        background-color: #bfc6cd !important;
    }

</style>
<div class="section-header">
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
            <div class="section-header-breadcrumb-content">
                <h1>Transactions</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#"><i class="fas fa-home"></i></a></div>
                    <div class="breadcrumb-item"><a href="<?= site_url('all_transaction') ?>">Transaction</a></div>
                    <div class="breadcrumb-item"><a href="">Buy</a></div>
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
                    <h4>Buy</h4>
                </div>
                <br>
                <div class="form-group">
                    <label for="order_id" class="col-md-4 control-label"><span class="text-danger">*</span>Order
                        id</label>
                    <div class="col-md-5">
                        <input type="text" name="order_id" class="form-control" id="order_id" required />
                        <span class="text-danger"><?php echo form_error('order_id'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="card_type" class="col-md-4 control-label"><span class="text-danger">*</span>Card
                        Type</label>
                    <div class="col-md-5">
                        <select id="card_type" type="text" name="card_type" class="form-control" required>
                            <option value="0">Select Card Type</option>
                            <option value="LIMIT">LIMIT</option>
                            <option value="CD">CD</option>
                        </select>
                        <span class="text-danger"><?php echo form_error('card_type'); ?></span>
                    </div>
                </div>

                <div class="card-body">
                    <!-- <a href="<?= site_url('download_transaction_file') ?>" class="btn btn-primary" id="buy_transaction">BUY</a> -->
                    <a href="javascript:void(0)" class="btn btn-primary buy_transaction">BUY</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="transaction-table-show" style="display:none">
        <div class="col-md-12">
            <div class="transaction-timer">
                <h1 id="timer">12:00</h1>
            </div>
        </div>
        <div class="col-md-12">
            <div class="transaction-show">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-left w-50">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-left w-50"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="mb-3 d-flex justify-content-around">
                    <a class="btn btn-primary" href="javascript:void(0)" onclick="goToAddTransactionPage('<?= site_url('add_transaction') ?>')">add transaction</a>
                    <a class="btn btn-secondary" style="display: none;" id="refreshUser" href="javascript:void(0)" onclick="refreshUserData()">Refresh User</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    var interval = '';
    let userInfo = '';
    let lastUserIds = [];
    let cardType = $('#card_type').val();
    let orderId = $('#order_id').val();
    let addTransactions = "<?= site_url('add_transaction') ?>";
    let normalUser = "<?= site_url('normal_user') ?>";
    let downloadTransactionFile = "<?= site_url('download_transaction_file') ?>";

    $(document).on('click', '.buy_transaction', function(e) {
        e.preventDefault();
        let orderId = $('#order_id').val();

        if (!orderId) {
            swal("Info", "Please enter order id first", "info");
            return;
        }

        checkOrder(function(isValid) {
            if (isValid) {
                handlePostTransactionFlow();
            }
        });
    });

    function handlePostTransactionFlow() {
        let cardType = $('#card_type').val();
        let orderId = $('#order_id').val();


        if (cardType.toUpperCase() === 'LIMIT') {
            localStorage.setItem('card_type', 'LIMIT');
            localStorage.setItem('orderId', orderId);
            window.location.href = normalUser;
            return; 
        }

        if (cardType.toUpperCase() == 'CD') {

           let isTransactionAdded = localStorage.getItem('transactionAdded');
           let isCdTransaction = localStorage.getItem('isCdTransaction');
           if (isTransactionAdded !== 'true' && isCdTransaction !== 'true') {
               timerDataShow();
               localStorage.setItem('isCdTransaction', 'true');
                return;
            }

            swal({
                title: "Do you want to reuse the same email?",
                icon: "success",
                buttons: {
                    cancel: {
                        text: "No",
                        visible: true,
                        closeModal: true
                    },
                    confirm: {
                        text: "Yes",
                        closeModal: true
                    }
                }
            }).then((willReuse) => {

                if (willReuse) {
                    localStorage.setItem('orderId', orderId);
                    window.location.href = addTransactions;

                } else {
                    timerDataShow();
                }

            });
        } 

    }

    function goToAddTransactionPage(path) {
        window.location = path;
    }

    function timerDataShow() {
        let orderId = $('#order_id').val();
        let cardType = $('#card_type').val();

        $.ajax({
            url: downloadTransactionFile,
            method: "POST",
            data: {
                cardType: cardType,
                orderID: orderId
            },
            method: "post",
            success: function(data) {
                const res = JSON.parse(data);
                if (res.status !== 'error') {
                    localStorage.setItem('userInfo', res[0].email);
                    localStorage.setItem('orderId', orderId);
                    handleDownloadResponse(res)
                }

            }
        })
    }

    function handleDownloadResponse(data) {
        if (data.message != undefined) {
            swal({
                title: "Are you sure?",
                text: data.message,
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then(confirm => {
                confirm
                    ?
                    forceProceed() :
                    processResponseData(data, cardType);
            });
        } else {
            processResponseData(data, cardType);
        }
    }

    function forceProceed() {
        let cardType = $('#card_type').val();
        $.ajax({
            url: "<?= site_url('download_transaction_file') ?>",
            data: {
                cardType,
                orderID,
                force_proceed: 'yes'
            },
            method: "post",
            success: function(data) {
                let res = JSON.parse(data);
                processResponseData(res, cardType);
            }
        });
    }

    function processResponseData(data, cardType) {
        if (data.status != 'error') {

            lastUserIds.push(data[0]['id'] ?? '');
            let cvv = data[0]['cvv'] == '' ? 'not found' : data[0]['cvv'];
            let cardType = data[0]['card_type'] == null ? 'not found' : data[0]['card_type'];

            $('.transaction-show table tr>td:nth-child(1)').html(data[0]['email']);
            $('#transaction-table-show').show();
            $('#transaction-table-show .transaction-show').show();
            if (cardType.toUpperCase() == 'CD') {
                $(".transaction-timer").hide();
                $("#refreshUser").show();
            } else {
                $("#refreshUser").hide();
            }
            sessionStorage.setItem('cardType', cardType.toUpperCase() ?? '');
            interval = setInterval(updateCountdown, 1000);
            userInfo = data;
        } else {
            let count = cardType.toUpperCase() == 'LIMIT' ? 'zero' : 'three';
            if (cardType.toUpperCase() == 'LIMIT') {
                sweetAlert(
                    'User not found',
                    'No user has zero transactions.',
                    'info'
                );
            } else {
                sweetAlert(
                    'User not found',
                    'There is no user who has fewer than three transactions.',
                    'info'
                );
            }
            $("#refreshUser").hide();
        }
    }

    function refreshUserData() {
        if ($('#order_id').val().length == 0) {
            sweetAlert(
                'Please enter order id',
                'You must have to enter order id first to buy these transactions',
                'info'
            );
            return false;
        }
        let cardType = $('#card_type').val();
        let orderID = $('#order_id').val();
        $.ajax({
            url: "<?= site_url('download_transaction_file') ?>",
            data: {
                cardType,
                orderID,
                last_user_ids: lastUserIds,
                force_proceed: 'yes'
            },
            method: "post",
            success: function(data) {
                let res = JSON.parse(data);

                localStorage.setItem('userInfo', res[0].email);
                processResponseData(res, cardType);
                $("#refreshUser").addClass("refresh-bg");
            }
        });
    }
    const startingMinutes = 12;
    let time = startingMinutes * 60;
    const countdownEl = document.getElementById('timer');

    function updateCountdown() {

        let cardType = sessionStorage.getItem('cardType') ?? '';
        const minutes = Math.floor(time / 60);
        let seconds = time % 60;
        seconds = seconds < 10 ? '0' + seconds : seconds;
        countdownEl.innerHTML = `${minutes}:${seconds}`;
        time--;
        console.log(time)
        if (time == 0 && cardType != 'CD') {
            time = startingMinutes * 60;
            $('.buy_transaction').attr('disabled', false).css('pointer-events', 'auto');
            clearInterval(interval);
            $('#transaction-table-show .transaction-show').hide();
            $('.transaction-timer h1').html(
                '<button class="btn btn-primary buy_transaction" onclick="timer_data_show()">Try again</button>')
        }

    }

    function checkOrder(callback) {
        let cardType = $('#card_type').val();
        let orderID = $('#order_id').val();


        $.ajax({
            url: "<?= site_url('download_transaction_file') ?>",
            method: "POST",
            data: {
                cardType,
                orderID
            },
            success: function(data) {
                let dataObj = {};
                dataObj = JSON.parse(data);
                console.log(dataObj);
                

                if (dataObj.status === 'error') {
                    swal("Error", dataObj.message, "error");
                    callback(false);
                } else {
                    callback(true);
                }
            }
        });
    }
</script>