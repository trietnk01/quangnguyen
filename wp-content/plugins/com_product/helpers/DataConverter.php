<?php
class DataConverter{
	public static function convertInvoiceToArrayData($data){
    	global $zController;
        $vHtml=new HtmlControl();
        $result=array();
        for ($i=0; $i < count($data); $i++) {
            $result[$i]=array(
                    "id"                    =>  (float)@$data[$i]["id"],
                    "sku"                   =>  @$data[$i]["sku"],
                    "created_date"          =>  datetimeConverter(@$data[$i]["created_date"],"d/m/Y"),
                    "email"                 =>  @$data[$i]["email"],
                    "fullname"              =>  @$data[$i]["fullname"],
                    "address"               =>  @$data[$i]["address"],
                    "phone"                 =>  @$data[$i]["phone"],
                    "payment_method_name"   =>  @$data[$i]["payment_method_name"],
                    "note"                  =>  @$data[$i]["note"],
                    "total_quantity"        =>  (float)@$data[$i]["total_quantity"],
                    "total_price"           =>  @$data[$i]["total_price"],
                    "total_price_text"      =>  fnPrice(@$data[$i]["total_price"]),
                    "status"                =>  (float)@$data[$i]["status"]
                );
        }
        return $result;
    }
}