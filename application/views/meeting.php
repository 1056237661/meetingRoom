<!--
    $beginToday 今天开始的时间戳
    $nowTime    现在的时间戳
    $intNumber  已经过期的时间段个数
-->
<?php
	$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
	$nowTime = time();
	$intNumber = floor(($nowTime - $beginToday-32400)/1800);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>会议室</title>
		<meta name="format-detection" content="telephone=no" />
    	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" />
    	<!--初始化样式-->
    	<link rel="stylesheet" type="text/css" href="/style/css/base.css"/>
    	<!--自定义样式-->
    	<link rel="stylesheet" type="text/css" href="/style/css/index.css"/>
	</head>
	<body>
		<!--导航栏-->
		<div class="banner box_sizing">
			<ul class="banner-ul">
				<li id="home">首页</li>
				<li id="order_meet" class="border-bottom">预约会议室</li>
				<li id="my_order" >我的预约</li>
			</ul>
		</div>
		
		<!--首页-->
		<div class="home box_sizing">
			<div class="">
				<a href="#"><img src="/style/images/31DD.tmp.jpg"/></a>
				<p>课程表</p>
			</div>
			<div class="">
				<a href="#"><img src="/style/images/75C2.tmp.jpg"/></a>
				<p>图书馆</p>
			</div>
			<div class="">
				<a href="#"><img src="/style/images/DDF8.tmp.jpg"/></a>
				<p>会议室</p>
			</div>
			<div class="">
				<a href="#"><img src="/style/images/1001.tmp.jpg"/></a>
				<p>用户中心</p>
			</div>
		</div>
		
		<!--会议室预约-->
		<div class="orderRoom 2 box_sizing">
			<div class="selectRoom">
				<p>选择会议室</p>
				<div class="meetingRoom">
					<ul>
						<li class="meetSelected meet191" value="191">19层大会议室</li>
						<li class="meet192" value="192">19层小会议室</li>
						<li class="meet193" value="193">19层休息室</li>
						<li class="meet201" value="201">20层大会议室</li>
					</ul>
				</div>
			</div>
			<div class="selectRoom">
				<p>选择时间</p>
				<div class="daySelect">
					<ul>
						<li id="day<?php echo $day;?>" class="daySelected" value="<?php echo $day; ?>">今天(<?php echo $day; ?>号)</li>
						<li id="day<?php echo $day1;?>" value="<?php echo $day1; ?>">明天(<?php echo $day1; ?>号)</li>
						<li id="day<?php echo $day2;?>" value="<?php echo $day2; ?>">后天(<?php echo $day2; ?>号)</li>
					</ul>
				</div>
			</div>
			<div class="timeSelect">
				<p>选择时间段</p>
				<div class="timebox">
					<ul>
						<li id="box1">9:00 - 9:30<p></p></li>
						<li id="box2">9:30 - 10:00<p></p></li>
						<li id="box3">10:00 - 10:30<p></p></li>
						<li id="box4">10:30 - 11:00<p></p></li>
						<li id="box5">11:00 - 11:30<p></p></li>
						<li id="box6">11:30 - 12:00<p></p></li>
						<li id="box7">12:00 - 12:30<p></p></li>
						<li id="box8">12:30 - 13:00<p></p></li>
						<li id="box9">13:00 - 13:30<p></p></li>
						<li id="box10">13:30 - 14:00<p></p></li>
						<li id="box11">14:00 - 14:30<p></p></li>
						<li id="box12">14:30 - 15:00<p></p></li>
						<li id="box13">15:00 - 15:30<p></p></li>
						<li id="box14">15:30 - 16:00<p></p></li>
						<li id="box15">16:00 - 16:30<p></p></li>
						<li id="box16">16:30 - 17:00<p></p></li>
						<li id="box17">17:00 - 17:30<p></p></li>
						<li id="box18">17:30 - 18:00<p></p></li>
						<li id="box19">18:00 - 18:30<p></p></li>
						<li id="box20">18:30 - 19:00<p></p></li>
						<li id="box21">19:00 - 19:30<p></p></li>
						<li id="box22"><span>19:30 - 20:00</span><p></p></li>
						<li id="box23"><span>20:00 - 20:30</span><p></p></li>
						<li id="box24"><span>20:30 - 21:00</span><p></p></li>
					</ul>
				</div>
				<a href='#' class='verify'>确认预约</a>
			</div>
		</div>
		
		<!--我的预约-->
		<div class="myOrder">
			<div class="norecord">
				<img src="/style/images/find1.png"/>
				<p>没有会议室预约记录！</p>
			</div>
		</div>
		<div class="noMyOrder"></div>
		
	</body>
	<script src="/style/res/jquery-1.12.2.min.js"></script>
	<script src="/style/js/style.js"></script>

	<script type="text/javascript">
		//时间已过，禁止选
		function  overdue(){
			var today = parseInt(<?php echo $day; ?>);
			var daySelected = parseInt($(".daySelected").val());
			if( today == daySelected ){
				recover();
				var intNumber = "<?php echo $intNumber; ?>";
				for ( var i = 1;i<=intNumber;i++){
					$("#box"+i).addClass("overdue");
					$("#box"+i).unbind("click");
				}
			}else{
				recover();
			}
		}
		//恢复函数
		function recover(){
			$(".timebox ul li").attr("class","");
			$(".timebox ul li p").text("");
			$(".timebox ul li").unbind("click");
			$(".timebox ul li").click(function(){
				$(this).toggleClass("checked");
			})
		}

		//（首页、预约会议室、我的预约）点击样式
		$(".banner-ul li").click(function(){
			$(this).addClass("border-bottom").siblings(".banner-ul li").removeClass("border-bottom");
			if ($(this).attr("id")=="home") {
				$(".orderRoom").css("display","none");
				$(".noMyOrder").css("display","none");
				$(".myOrder").css("display","none");
				$(".home").css("display","block");

			} else if($(this).attr("id")=="order_meet"){
				$(".home").css("display","none");
				$(".noMyOrder").css("display","none");
				$(".myOrder").css("display","none");
				$(".orderRoom").css("display","block");
			}else{
				$(".home").css("display","none");
				$(".orderRoom").css("display","none");
				$(".noMyOrder").css("display","block");
			}
		});
		/*会议室选择*/
		$(".meetingRoom ul li").click(function(){
			$(this).addClass("meetSelected").siblings(".meetingRoom ul li").removeClass("meetSelected");
			overdue();
			selectSubmit();
		})
		/*日期选择*/
		$(".daySelect ul li").click(function(){
			$(this).addClass("daySelected").siblings(".daySelect ul li").removeClass("daySelected");
			overdue();
			selectSubmit();
		})
		//时间段选择变色
		$(".timebox ul li").click(function(){
			$(this).toggleClass("checked");
		})

		//提交预约信息
		$(".verify").click(function(){
			var selected = "";
			var length0 = $(".checked").size();
			var arr0 = [];
			for(var index0 = 0; index0 < length0; index0++){//创建一个数字数组
				arr0[index0] = index0;
			}
			$.each(arr0,function(i){
				var idValue0 = $(".checked").eq(i).attr("id");
				if(idValue0 != ''){
					idValue0=idValue0.replace("box","");
					selected = selected + ","+idValue0;
				}
			});
			var length = $(".myselfCheck").size();
			var arr = [];
			for(var index = 0; index < length; index++){//创建一个数字数组
				arr[index] = index;
			}
			$.each(arr,function(i){
				var idValue = $(".myselfCheck").eq(i).attr("id");
				if(idValue != ''){
					idValue=idValue.replace("box","");
					selected = selected + ","+idValue;
				}
			});
			selected = selected.substr(1);
			console.log(selected);
			$.ajax({
				url:'/Meet_select/verify',
				type:"POST",
				data: {'meetSelected':$('.meetSelected').val(),'daySelected':$('.daySelected').val(),'selected':selected},//参数，这里是一个json语句
				success: function (data) {
					alert("预约成功！");
				},
				error: function (err) {
					alert("系统繁忙，请您稍后再试！");
				}
			});
		})

		/*我的预约*/
		$("#my_order").click(function(){
			var meetRoom = {"191":"19层大会议室","192":"19层小会议室","193":"19层休息室","201":"20层大会议室"};
			var orderDate = {"0":"今天","1":"明天","2":"后天"};
			var timeBucket = {"1":"【9:00-9:30】","2":"【9:30-10:00】","3":"【10:00-10:30】","4":"【10:30-11:00】","5":"【11:00-11:30】","6":"【11:30-12:00】","7":"【12:00-12:30】","8":"【12:30-13:00】","9":"【13:00-13:30】","10":"【13:30-14:00】","11":"【14:00-14:30】","12":"【14:30-15:00】","13":"【15:00-15:30】","14":"【15:30-16:00】","15":"【16:00-16:30】","16":"【16:30-17:00】","17":"【17:00-17:30】","18":"【17:30-18:00】","19":"【18:00-18:30】","20":"【18:30-19:00】","21":"【19:00-19:30】","22":"【19:30-20:00】","23":"【20:00-20:30】","24":"【20:30-21:00】"};
			$.ajax({
				url:"/Meet_select/my_order",
				type:"POST",
				success:function(data){
					if( data == -1 ){
						$(".noMyOrder").css("display","none");
						$(".myOrder").css("display","block");
					}else{
						$(".myOrder").css("display","none");
						data = eval(data);
						$(".noMyOrder").html("");
						for(var p in data){
							/*记录ID*/
							var id = data[p].id;
							/*会议室名称*/
							roomnumber = data[p].roomnumber;
							roomname = meetRoom[roomnumber];
							/*日期名称*/
							var today =parseInt(<?php echo $day;?>);
							orderDay = parseInt(data[p].day);
							var poor = orderDay - today;
							showDay = orderDate[poor]+"（"+orderDay+"）号";
							/*时间段显示*/
							var selected = data[p].selected;
							var selected = selected.split(",");
							selected = selected.sort(function(a,b){return a-b});
							var selectTime = "";
							for(var x in selected ){
								selectTime += timeBucket[selected[x]]+" ";
							}
							$(".noMyOrder").append("<div class=order><p class=meetTitle><span class=sidebar>会议室：</span><span>"+roomname+"</span></p><p><span class=sidebar>日期：</span><span>"+showDay+"</span></p><p><span class=sidebar>预约时间：</span><span class=timeBucket>"+selectTime+"</span></p><div id="+id+" class='button box_sizing'><span roomnumber="+roomnumber+" orderDay="+orderDay+" class='modify box_sizing'>修改预约</span><span id="+id+" class='cancel box_sizing'>取消预约</span></div></div>")
						}
						/*修改预约*/
						$(".modify").click(function(){
							var roomnumber = $(this).attr("roomnumber");
							var orderDay = $(this).attr("orderDay");
							$.ajax({
								type: "POST",
								url: "select",//传入后台的地址/方法
								data: {'meetSelected':roomnumber,'daySelected':orderDay},//参数，这里是一个json语句
								success: function (data) {
									$(".noMyOrder").css("display","none");
									$(".orderRoom").css("display","block");
									$(".meet"+roomnumber).addClass("meetSelected").siblings(".meetingRoom ul li").removeClass("meetSelected");
									$("#day"+orderDay).addClass("daySelected").siblings(".daySelect ul li").removeClass("daySelected");
									overdue();
									data = eval(data);
									for(var p in data){
										var selected = data[p].selected;
										selected = selected.split(",");
										var username = data[p].username;
										var myself = "<?php echo $_SESSION['username'];?>";
										for(var x in selected ){
											if(username==myself){
                                                $("#box"+selected[x]).attr('class',"checked");
											}else{
                                                $("#box"+selected[x]+" p").text(username);
												$("#box"+selected[x]).attr('class','').addClass('haveCheck');
                                                $("#box"+selected[x]).unbind('click');
											}
										}
									}
								},error: function (err) {
									alert("错误信息："+err);
								}
							});

						});
						/*取消预约*/
						$(".cancel").click(function(){
							var id = $(this).attr("id");
							$.ajax({
								url:"/Meet_select/cancel",
								type:"POST",
								data:{"id":id},
								success:function(data){
									alert("取消成功！");
								}
							})
						});

					}

				},
				error:function(error){

				}
			})
		});

		//会议室/时间选择 查询
		selectSubmit();
		function selectSubmit(){
			$.ajax({
				type: "POST",
				url: "/Meet_select/select",//传入后台的地址/方法
				data: {'meetSelected':$('.meetSelected').val(),'daySelected':$('.daySelected').val()},//参数，这里是一个json语句
				success: function (data) {
					data = eval(data);
					for(var p in data){
						var selected = data[p].selected;
						selected = selected.split(",");
						var username = data[p].username;
						var myself = "<?php echo $_SESSION['username'];?>";
						for(var x in selected ){
							if(username==myself){
								$("#box"+selected[x]).attr('class','').addClass('myselfCheck');
							}else{
								$("#box"+selected[x]).attr('class','').addClass('haveCheck');
							}
							$("#box"+selected[x]+" p").text(username);
							$("#box"+selected[x]).unbind('click');
						}
					}
				},error: function (err) {
					alert("错误信息："+err);
				}
			});
		}

        /*时间过期检测*/
		overdue();
	</script>
</html>
