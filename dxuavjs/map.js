var points = [];//原始点信息数组  
var bPoints = [];//百度化坐标数组。用于更新显示范围。  
//var lng = 117.06;
//var lat = 36.05;
//var lng_point = [],lat_point = [];
var Points = [];

//创建标注点并添加到地图中

function getusers() {
        var lng,lat,arr = []; 
        $.ajax({
            type: "post",
            async: false,
            url: "./dxuavphp/dxuav.php",
            data: {},
            dataType: "json",
            success: function(result){
               if(result){
        
                        lng = result[0].LNG;
                        lat = result[0].LAT;
                        arr[0] = lng;
                        arr[1] = lat;     
                }
            },
            error: function(errmsg) {
                alert("Ajax获取服务器数据出错了！"+ errmsg);
            }
        });
    return arr;
    }


function addMarker_plane(points) {
    //循环建立标注点
    for(var i=0, pointsLen = points.length; i<pointsLen; i++) {
        var point = new BMap.Point(points[i].lng, points[i].lat); //将标注点转化成地图上的点
        var marker = new BMap.Marker(point); //将点转化成标注点
        map.addOverlay(marker);  //将标注点添加到地图上
        //添加监听事件
        (function() {
            var thePoint = points[i];
            marker.addEventListener("click",
                function() {
                showInfo(this,thePoint);
            });
         })();  
    }
}

//point to fly线  
function addMarker_point(lngPoint,latPoint){
      var point = new BMap.Point(lngPoint,latPoint);
      var marker = new BMap.Marker(point);
      map.addOverlay(marker);

}



function addLine(points){  

    var linePoints = [],pointsLen = points.length,i,polyline;  
    if(pointsLen == 0){  
        return;  
    }  
    // 创建标注对象并添加到地图     
    for(i = 0;i <pointsLen;i++){  
        linePoints.push(new BMap.Point(points[i].lng,points[i].lat));  
    }  

    polyline = new BMap.Polyline(linePoints, {strokeColor:"blue", strokeWeight:5, strokeOpacity:1});   //创建折线  
    map.addOverlay(polyline);   //增加折线  
}


//addline for point
function addLine_point(point){
  var linePoints = [],pointsLen = point.length,i,polyline;  
    if(pointsLen == 0){  
        return;  
    }  
    // 创建标注对象并添加到地图     
    for(i = 0;i <pointsLen;i++){  
        linePoints.push(new BMap.Point(point[i].lng,point[i].lat));  
    }  

    polyline = new BMap.Polyline(linePoints, {strokeColor:"blue", strokeWeight:1, strokeOpacity:1});   //创建折线  
   map.addOverlay(polyline);
}

//随机生成新的点，加入到轨迹中。  
function dynamicLine(){  
   // var lng = 112+getRandom(100)*0.01;  
   // var lat = 26+getRandom(100)*0.01;  
   // var id = getRandom(1000);
      var data,lng,lat;  
      data = getusers();
      lng = data[0];
      lat = data[1];
     // console.log(data[0]);
    var point = {"lng":lng,"lat":lat}  
    var makerPoints = [];  
    var newLinePoints = [];  
    var len;  

    makerPoints.push(point);              
    addMarker_plane(makerPoints);//增加对应该的轨迹点  
    points.push(point);  
    bPoints.push(new BMap.Point(lng,lat));  
    len = points.length;  
    newLinePoints = points.slice(len-2, len);//最后两个点用来画线。  

    addLine(newLinePoints);//增加轨迹线  
    setZoom(bPoints);  
   setTimeout(dynamicLine, 1000);  
}    

//根据点信息实时更新地图显示范围，让轨迹完整显示。设置新的中心点和显示级别  
function setZoom(bPoints){  
    var view = map.getViewport(eval(bPoints));  
    var mapZoom = view.zoom;   
    var centerPoint = view.center;   
    map.centerAndZoom(centerPoint,mapZoom);  
}  

