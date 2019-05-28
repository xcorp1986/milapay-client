<?php

include __DIR__.'/common.php';

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $out_order_id = isset($_POST['out_order_id']) ? $_POST['out_order_id'] : '';
    $type = isset($_POST['type']) ? $_POST['type'] : '';
    $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
    $notifyurl = isset($_POST['notifyurl']) ? $_POST['notifyurl'] : '';
    $returnurl = isset($_POST['returnurl']) ? $_POST['returnurl'] : '';
    $extend = isset($_POST['extend']) ? $_POST['extend'] : '';

    $format = 'html';

    //验证签名
    $sign = md5(md5($price . $out_order_id . $type . $product_id . $notifyurl . $returnurl . $extend) . $config['secretkey']);
    $params = [
        'price'        => $price,
        'out_order_id' => $out_order_id,
        'type'         => $type,
        'product_id'   => $product_id,
        'notifyurl'    => $notifyurl,
        'returnurl'    => $returnurl,
        'extend'       => $extend,
        'sign'         => $sign,
        'format'       => $format,
    ];
    $url = $config['apiurl'] . "?" . http_build_query($params);
    header("location:{$url}");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>收款客户端</title>
    <link crossorigin="anonymous" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" href="//lib.baomitu.com/twitter-bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="well bs-component" style="margin:50px auto;">
        <form class="form-horizontal" method="POST">
            <fieldset>
                <legend>提交订单</legend>
                <div class="form-group">
                    <label class="col-lg-2 control-label">订单号(out_order_id)</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="out_order_id" required value="<?php echo date("YmdHis") ?><?php echo mt_rand(1000, 9999) ?>" placeholder="唯一订单号">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">订单金额(price)</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="price" required value="<?php echo mt_rand(1, 100) ?>" placeholder="订单金额">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">产品ID(product_id)</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="product_id" placeholder="产品ID,如果不了解,请留空">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">透传信息(extend)</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="extend" placeholder="透传信息,可以留空">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-2 control-label">支付方式(type)</label>
                    <div class="col-lg-10">
                        <div class="radio">
                            <label>
                                <input type="radio" name="type" value="wechat" checked="">微信
                            </label>
                            <label>
                                <input type="radio" name="type" value="alipay">支付宝
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">回调地址(notifyurl)</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="notifyurl" value="http://<?php echo $_SERVER['HTTP_HOST'] ?><?php echo $_SERVER['REQUEST_URI'] ?>notify.php" placeholder="成功后异步通知到的地址">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">跳转地址(returnurl)</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="returnurl" value="http://<?php echo $_SERVER['HTTP_HOST'] ?><?php echo $_SERVER['REQUEST_URI'] ?>return.php" placeholder="成功后前台跳转的地址">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="submit" class="btn btn-primary">提交订单</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<script crossorigin="anonymous" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" src="//lib.baomitu.com/jquery/3.3.1/jquery.min.js"></script>
<script crossorigin="anonymous" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" src="//lib.baomitu.com/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
