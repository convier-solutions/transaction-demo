<head>
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.16.9/dist/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

</head>

<div class="section-header">
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
            <div class="section-header-breadcrumb-content">
                <h1>Transactions</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#"><i class="fas fa-home"></i></a></div>
                    <div class="breadcrumb-item">
                        <a href="<?= site_url('all_transaction') ?>">Transaction</a>
                    </div>
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
                        <h4>Transactions</h4>
                        <button style="all: unset; right:20px; position:absolute; text-decoration: underline;" type="button"
                            onclick="exportToExcel()"> Download excel</button>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="all-transaction" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Order id</th>
                                        <th>Purchase id</th>
                                        <th>Email</th>
                                        <th>Amount</th>
                                        <th>Payout</th>
                                        <th>Transaction date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
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
        if($('#all-transaction').length > 0) {
            $('#all-transaction').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: '<?= site_url('all_transaction') ?>',
                    type: 'POST'
                },
                columns: [
                    { data: 'id' },
                    { data: 'order_id' },
                    { data: 'purchase_id' },
                    { data: 'email' },
                    { data: 'amount' },
                    { data: 'pay_out' },
                    { data: 'transaction_date' },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return `
                                <a href="<?= site_url('delete_transaction/') ?>${data.id}" class="btn btn-danger">Delete</a>
                                <a href="<?= site_url('update_transaction/') ?>${data.id}" class="btn btn-primary">Update</a>
                            `;
                        }
                    }
                ],
                order: [[0, 'desc']]


            });
        }
    });

    function downloadTransactionCSV() {
        let tableId = 'save-stage';
        const table = document.getElementById(tableId);

        // Define the filename for the CSV file
        const filename = 'transactions.csv';

        // Get all the rows and columns in the table
        const rows = table.querySelectorAll('tr');
        const headers = table.querySelectorAll('th');

        // Create a new empty array for the data
        const data = [];

        // Add the headers to the data array
        const headerRow = [];
        for (let i = 0; i < headers.length - 1; i++) {
            headerRow.push(headers[i].textContent);
        }
        data.push(headerRow);

        // Loop through each row in the table and add its data to the data array
        for (let i = 0; i < rows.length; i++) {
            // Skip the header row
            if (i === 0) {
                continue;
            }

            // Get all the cells in the row, except the last one
            const cells = rows[i].querySelectorAll('td:not(:last-child)');

            // Create a new empty array for this row's data
            const rowData = [];

            // Loop through each cell in the row and add its text to the rowData array
            for (let j = 0; j < cells.length; j++) {
                rowData.push(cells[j].textContent);
            }

            // Add the row's data to the data array
            data.push(rowData);
        }

        // Create a new CSV string from the data
        let csv = '';
        for (let i = 0; i < data.length; i++) {
            csv += data[i].join(',') + '\n';
        }

        // Create a new anchor element and set its attributes
        const link = document.createElement('a');
        link.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv));
        link.setAttribute('download', filename);

        // Add the link to the page and click it to start the download
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    function exportToExcel() {
        $.ajax({
            url: '<?= site_url('download_transaction_csv') ?>',
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                if (response.status === 'error') {
                    console.error('Error fetching data:', response.message);
                    return;
                    
                }
                data = response.data;

                if (data && data.length) {
                    var workbook = XLSX.utils.book_new();
                    var worksheet = XLSX.utils.json_to_sheet(data);

                    // replace underscores with spaces in column names
                    var headers = {};
                    for (var h in worksheet) {
                        var header = h.replace(/_/g, ' ');
                        headers[header] = worksheet[h];
                    }
                    worksheet = headers;

                    XLSX.utils.book_append_sheet(workbook, worksheet, 'Transactions');
                    var wbout = XLSX.write(workbook, {
                        bookType: 'xlsx',
                        type: 'binary'
                    });

                    function s2ab(s) {
                        var buf = new ArrayBuffer(s.length);
                        var view = new Uint8Array(buf);
                        for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
                        return buf;
                    }
                    saveAs(new Blob([s2ab(wbout)], {
                        type: 'application/octet-stream'
                    }), 'Transactions.xlsx');
                } else {
                    console.log('No data to export.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    }
</script>