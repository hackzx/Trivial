<?php

$ak = '4ef459f6884c1b8b266d7fef067defc9';
$ip = $_REQUEST['ip'];
$GPS_url = 'http://api.map.baidu.com/highacciploc/v1?&qterm=pc&ak='.$ak.'&coord=bd09ll&qcip='.$ip;
$GPS_json = file_get_contents($GPS_url);
$GPS_obj = json_decode($GPS_json);
$lat = $GPS_obj->content->location->lat;
$lng = $GPS_obj->content->location->lng;

$Address_url ='http://api.map.baidu.com/geocoder/v2/?output=json&pois=0&ak='.$ak.'&location='.$lat.','.$lng;
$Address_json = file_get_contents($Address_url);
$Address_obj = json_decode($Address_json);
$Address = $Address_obj->result->formatted_address.$Address_obj->result->addressComponent->direction.','.$Address_obj->result->sematic_description;

if (stripos($_SERVER['HTTP_USER_AGENT'], "curl") !== false) {
    echo $Address;
    exit();
}

echo '<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<style type="text/css">
        body, html{width: 100%;height: 100%;margin:0;font-family:"寰蒋闆呴粦";}
        #allmap{height:500px;width:100%;}
        #r-result{width:100%; font-size:14px;}
    </style>
        <style type="text/css">
        body, html,#allmap {width: 100%;height: 100%;overflow: hidden;margin:0;font-family:"寰蒋闆呴粦";}
    </style>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak='.$ak.'"></script>
    <title>GPS鍧愭爣</title>
</head>
<body>
    <div id="allmap"></div>
</body>
</html>
<script type="text/javascript">

    var x = '.$lng.';
    var y = '.$lat.';

    var ggPoint = new BMap.Point(x,y);

    var bm = new BMap.Map("allmap");
    bm.enableScrollWheelZoom();
    bm.centerAndZoom(ggPoint, 15);
    bm.addControl(new BMap.NavigationControl());
    var point = new BMap.Point(x,y);

    var markergg = new BMap.Marker(ggPoint);
    bm.addOverlay(markergg);
    var labelgg = new BMap.Label("'.$Address.'",{offset:new BMap.Size(20,-10)});
    markergg.setLabel(labelgg);

</script>';
?>
