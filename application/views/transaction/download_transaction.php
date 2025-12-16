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
                            <option value="BOFA">BOFA</option>
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
                            <th class="text-left w-50">Password</th>
                            <th class="text-left w-50">CVV</th>
                            <th class="text-left w-50">Card Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-left w-50"></td>
                            <td class="text-left w-50"></td>
                            <td class="text-left w-50"></td>
                            <td class="text-left w-50"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="mb-3 d-flex justify-content-around">
                    <a class="btn btn-primary" href="javascript:void(0)" onclick="goToAddTransactionPage('<?= site_url('add_transaction') ?>')">add transaction</a>
                    <a class="btn btn-secondary" style="display: none;" id="refreshUser" href="javascript:void(0)">Refresh User</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    $(document).ready(function() {

    $("#refreshUser").on("click", function() {
        refreshUserData();
    });

});
    var interval = '';
    let lastUserIds = [];
    $('.buy_transaction').click(timer_data_show);

    let userInfo = '';

    function goToAddTransactionPage(path) {
        let orderId = $('#order_id').val();
        sessionStorage.setItem('userInfo', userInfo);
        sessionStorage.setItem('orderId', orderId);
        window.location = path;
    }

    function timer_data_show() {

        if ($('#order_id').val().length == 0) {
            sweetAlert(
                'Please enter order id',
                'You must have to enter order id first to buy these transactions',
                'info'
            );
            return false;
        } else {
            $('.buy_transaction').attr('disabled', true).css('pointer-events', 'none');
            let cardType = $('#card_type').val();
            let orderID = $('#order_id').val();
            $.ajax({
                url: "<?= site_url('download_transaction_file') ?>",
                data: {
                    cardType,
                    orderID
                },
                method: "post",
                success: function(data) {
                    console.log(data,"ajax response");
                    dataObj={};
                    if(data != 'false'){
                        dataObj = JSON.parse(data);
                    }
                    if (dataObj.message != undefined) {
                        // Show confirmation dialog
                        swal({
                                title: "Are you sure?",
                                text: dataObj.message,
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                            })
                            .then((willProceed) => {
                                if (willProceed) {
                                    // User confirmed, proceed with the request
                                    $.ajax({
                                        url: "<?= site_url('download_transaction_file') ?>",
                                        data: {
                                            cardType,
                                            orderID,
                                            force_proceed: 'yes'
                                        },
                                        method: "post",
                                        success: function(data) {
                                            processResponseData(data, cardType);
                                        }
                                    });
                                } else {
                                    if (data != 'false') {
                                        processResponseData(data, cardType);
                                    }
                                }
                            });
                        return;

                    }else{
                        processResponseData(data, cardType);
                    }


                }
            });
        }
    }

    function processResponseData(data, cardType) {
        if (data != 'false') {

            let user = JSON.parse(data);
            console.log(user,"user data");
            lastUserIds.push(user[0]['id']??'');
            let cvv = user[0]['cvv'] == '' ? 'not found' : user[0]['cvv'];
            let cardType = user[0]['card_type'] == null ? 'not found' : user[0]['card_type'];

            $('.transaction-show table tr>td:nth-child(1)').html(user[0]['email']);
            $('#transaction-table-show').show();
            $('#transaction-table-show .transaction-show').show();
            if(cardType.toUpperCase() == 'CD'){
                $(".transaction-timer").hide();
                $("#refreshUser").show();
            }else{
                $('.transaction-show table tr>td:nth-child(2)').html(user[0]['password']);
                $('.transaction-show table tr>td:nth-child(3)').html(cvv);
                $('.transaction-show table tr>td:nth-child(4)').html(cardType);
                $("#refreshUser").hide();
            }
            sessionStorage.setItem('cardType', cardType.toUpperCase()??'');
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
                processResponseData(data, cardType);
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
</script>