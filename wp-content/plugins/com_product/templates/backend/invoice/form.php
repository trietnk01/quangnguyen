<?php
	global $zController;
	$vHtml = new HtmlControl();
	$msg = '';
	if(count($zController->_error)>0){
		$msg .= '<div class="error"><ul>';
		foreach ($zController->_error as $key => $val){
			$msg .= '<li>' . $val . '</li>';
		}
		$msg .= '</ul></div>';
	}
	$page 	= $zController->getParams('page');
	$action = ($zController->getParams('action') != '')? $zController->getParams('action'):'add';
	$lbl 	= 'Invoice';
	$lbl_sku 	= 	@$zController->_data['sku'];
	$lbl_created_date 	=datetimeConverter(@$zController->_data['created_date'],"d/m/Y") 	;

	$input_email 	= '<input type="text"  name="email" class="regular-text" value="'.sanitize_text_field(@$zController->_data['email']).'" />';
	$input_fullname 	='<input type="text"  name="fullname" class="regular-text" value="'.sanitize_text_field(@$zController->_data['fullname']).'" />';
	$input_address 	='<input type="text"  name="address" class="regular-text" value="'.sanitize_text_field(@$zController->_data['address']).'" />';
	$input_phone 	='<input type="text"  name="phone" class="regular-text" value="'.sanitize_text_field(@$zController->_data['phone']).'" />';
	$input_note 	='<textarea type="text"  name="note" class="regular-text" rows="10" >'.sanitize_text_field(@$zController->_data['note']).'</textarea>';

	$lbl_payment_method_name=@$zController->_data["payment_method_name"];
	$lbl_total_quantity 	= fnPrice(@$zController->_data['total_quantity'])	;
	$lbl_total_price 	=fnPrice(@$zController->_data['total_price']) 	;
	$arr_status              =   array(-1 => '- Select status -', 1 => 'Đã hoàn tất', 0 => 'Chưa hoàn tất');
	$ddl_status              =   $vHtml->cmsSelectbox("status","status","form-control",$arr_status,(int)@$zController->_data['status'],"");
	// lấy danh sách chi tiết đơn hàng
	$invoiceDetailModel=$zController->getModel("/backend","AdminInvoiceModel");
	$arrInvoiceDetail=$invoiceDetailModel->getInvoiceDetail();


?>
<div class="wrap">
	<h1><?php echo $lbl;?></h1>
	<?php echo $msg;?>
	<form method="post" action="" id="<?php echo $page;?>"
		enctype="multipart/form-data">
		<input name="action" value="<?php echo $action;?>" type="hidden">
		<?php wp_nonce_field($action,'security_code',true);?>
		<table class="content-form">
				<tr>
					<td scope="row" align="right">
						<label><i><b>Mã đơn hàng :</b></i></label>
					</td>
					<td><?php echo $lbl_sku;?></td>
				</tr>
				<tr>
					<td scope="row" align="right">
						<label><i><b>Ngày đặt hàng :</b></i></label>
					</td>
					<td><?php echo $lbl_created_date;?></td>
				</tr>
				<tr>
					<td scope="row" align="right">
						<label><i><b>Email :</b></i></label>
					</td>
					<td><?php echo $input_email;?></td>
				</tr>
				<tr>
					<td scope="row" align="right">
						<label><i><b>Họ tên :</b></i></label>
					</td>
					<td><?php echo $input_fullname;?></td>
				</tr>
				<tr>
					<td scope="row" align="right">
						<label><i><b>Địa chỉ :</b></i></label>
					</td>
					<td><?php echo $input_address;?></td>
				</tr>
				<tr>
					<td scope="row" align="right">
						<label><i><b>Phone :</b></i></label>
					</td>
					<td><?php echo $input_phone;?></td>
				</tr>
				<tr>
					<td scope="row" align="right" style="vertical-align: top;">
						<label><i><b>Ghi chú :</b></i></label>
					</td>
					<td><?php echo $input_note;?></td>
				</tr>
				<tr>
					<td scope="row" align="right">
						<label><i><b>Phương thức thanh toán :</b></i></label>
					</td>
					<td><?php echo @$zController->_data['payment_method_name'];?></td>
				</tr>
				<tr>
					<td scope="row" align="right">
						<label><i><b>Số lượng :</b></i></label>
					</td>
					<td><b><?php echo $lbl_total_quantity;?></b></td>
				</tr>
				<tr>
					<td scope="row" align="right">
						<label><i><b>Thành tiền :</b></i></label>
					</td>
					<td><?php echo $lbl_total_price . ' đ';?></td>
				</tr>
				<tr>
					<td scope="row" align="right">
						<label><i><b>Trạng thái giao hàng :</b></i></label>
					</td>
					<td><?php echo $ddl_status;?></td>
				</tr>
		</table>
		<p class="submit">
			<input name="submit" id="submit" class="button button-primary" value="Save Changes" type="submit">
		</p>
	</form>
	<div>
		<table width="100%" id="com_product16" class="com_product16">
			<thead>
				<tr>
					<th>Mã sản phẩm</th>
					<th>Tên sản phẩm</th>
					<th>Hình</th>
					<th>Giá</th>
					<th>Số lượng</th>
					<th>Thành tiền</th>
				</tr>
			</thead>
			<tbody>
			<?php
			foreach ($arrInvoiceDetail as $key => $value) {
				$product_sku=@$value["product_sku"];
				$product_name=@$value["product_name"];
				$product_image=@$value["product_image"];
				$product_price=fnPrice(@$value["product_price"]) ;
				$product_quantity=fnPrice(@$value["product_quantity"]) ;
				$product_total_price=fnPrice(@$value["product_total_price"]);
			 	?>
			 	<tr>
					<td><?php echo @$product_sku; ?></td>
					<td><?php echo @$product_name; ?></td>
					<td align="center"><img  src="<?php echo @$product_image; ?>" width="84" height="112" /></td>
					<td align="right"><?php echo @$product_price; ?></td>
					<td align="center"><?php echo @$product_quantity; ?></td>
					<td align="right"><?php echo @$product_total_price; ?></td>
				</tr>
			 	<?php
			 }
			?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4" align="center"><b>Tổng cộng</b></td>
					<td align="right"><?php echo $lbl_total_quantity; ?></td>
					<td align="right"><?php echo $lbl_total_price; ?></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>
