<?php
    ob_start();
    include '../lib/session.php';
    Session::checkSession();
?>



<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <link href="css/table/demo_page.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN: load jquery -->
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="js/table/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- END: load jquery -->
    <script type="text/javascript" src="js/table/table.js"></script>
    <script src="js/setup.js" type="text/javascript"></script>
	 <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
		    setSidebarHeight();
        });

        function searchTheoKhoang(){
            var datebd = document.getElementById("ngaybd").value;
            var datekt = document.getElementById("ngaykt").value;
            $.ajax({
                type: "POST",
                url: "http://localhost:81/Web2-master/admin/xulySearch.php",
                data: {
                datebd: datebd,
                datekt: datekt
                },
                success: function (response) {
                // var form = document.querySelector('.block');
                
                var donhangs = JSON.parse(response);
                var html = `<table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="7%">Serial No.</th>
							<th width="20%">Date</th>
							<th width="15%">Total money</th>
							<th width="15%">Customers</th>
							<th width="23%">Status</th>
							<th width="20%">Detail</th>
						</tr>
					</thead>
					<tbody>`;
                if (donhangs.length > 0) {
                    for (var i = 0; i < donhangs.length; i++) {
                        var donhang = donhangs[i];
                        html += '<tr class="odd gradeX">';
                        html += '<td>' + (i + 1) + '</td>';
                        html += '<td>' + donhang.createDate + '</td>';
                        html += '<td>' + donhang.tongTien + '.đ</td>';
                        html += '<td><a href="customer.php?cusId=' + donhang.customerId + '">Customer</a></td>';
                        html += '<td>';
                        if (donhang.state == 0) {
                            html += '<a href="?shiftId=' + donhang.id + '">pending</a>';
                        } else if (donhang.state != -1) {
                            html += 'processed';
                        } else {
                            html += 'canceled';
                        }
                        html += '</td>';
                        html += '<td>';
                        html += '<form action="chitietHD.php" method="post">';
                        html += '<input type="hidden" name="idHD" value="' + donhang.id + '"/>';
                        html += '<input type="submit" name="loadchitiet" id="loadCT" value="Xem chi tiết"/>';
                        html += '</form>';
                        html += '</td>';
                        html += '</tr>';

                }} else {
                                html += '<h3>No products were found!</h3>';
                            }
                            html += '</tbody></table>';
                            $('.showSearch').html(html);
                  },
                            error: function(response) {
                            // Xử lý lỗi (nếu có)
                            console.log(response.responseText);
                            }
                        });
            }
    </script>

</head>
<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft logo">
                    <img src="img/livelogo.png" alt="Logo" />
				</div>
				<div class="floatleft middle">
					<h1>Training with live project</h1>
					<p>www.trainingwithliveproject.com</p>
				</div>
                <div class="floatright">
                    <div class="floatleft">
                        <img src="img/img-profile.jpg" alt="Profile Pic" /></div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li>Hello <?php echo Session::get('adminName')?> </li>
                            
                            <?php
                                if( isset($_GET['action']) && $_GET['action'] =='logout'){
                                    Session::destroy();
                                }
                            ?>

                            <li><a href="?action=logout">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="index.php"><span>Dashboard</span></a> </li>
                <li class="ic-form-style"><a href=""><span>User Profile</span></a></li>
				<li class="ic-typography"><a href="changepassword.php"><span>Change Password</span></a></li>
				<li class="ic-grid-tables"><a href="inbox.php"><span>Orders</span></a></li>
                <li class="ic-charts"><a href="thongkeForm.php"><span>Statistical</span></a></li>
            </ul>
        </div>
        <div class="clear">
        </div>
        <?php
            ob_end_flush();
        ?>