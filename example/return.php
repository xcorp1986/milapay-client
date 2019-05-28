<?php
include __DIR__.'/common.php';

$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : '';
$out_order_id = isset($_GET['out_order_id']) ? $_GET['out_order_id'] : '';
$sign = isset($_GET['sign']) ? $_GET['sign'] : '';

if ($sign != md5(md5($order_id . $out_order_id) . $config['secretkey'])) {
    echo '签名错误';
    exit;
}

echo "返回成功，你可以在此页面输出结果通知或提示信息，但请不要在此页面处理订单逻辑";
exit;
