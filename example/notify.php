<?php
include __DIR__.'/common.php';

$order_id = isset($_POST['order_id']) ? $_POST['order_id'] : '';
$out_order_id = isset($_POST['out_order_id']) ? $_POST['out_order_id'] : '';
$price = isset($_POST['price']) ? $_POST['price'] : '';
$realprice = isset($_POST['realprice']) ? $_POST['realprice'] : '';
$type = isset($_POST['type']) ? $_POST['type'] : '';
$paytime = isset($_POST['paytime']) ? $_POST['paytime'] : '';
$extend = isset($_POST['extend']) ? $_POST['extend'] : '';
$sign = isset($_POST['sign']) ? $_POST['sign'] : '';

if ($sign != md5(md5($order_id.$out_order_id.$price.$realprice.$type.$paytime.$extend).$config['secretkey'])) {
    echo '签名错误';
    exit;
}
//你可以在此页面处理你的订单逻辑

//此页面只允许输出success这6个字符，不允许再输出其它任何字符
echo "success";
exit;
