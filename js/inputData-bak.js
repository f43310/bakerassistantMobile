// 确保metric列和百分比列输入的都是数字且大于0
//格式化数字，输入只能是数字和小数点
//
function numberAndPoint(str) {
	return str.replace(/[^(\d|\.)]/g,'');
}

//格式化数字，保留num位小数
//
function formatNum(str,num){
	var s = parseFloat(str);
	if(!num) num=4;
	if(isNaN(s)){
		return;
	}
	s = s.toFixed(num);
	if(s=="" || s<0) s=0;
	return s;
}

// 检查ingre和metric列全部都填上了
//
function checkFill(){
	var _len = $("#tab tr").length;
	console.log("DEBUG -表格行数 "+_len);
	for(var i=1; i<_len;i++){
		if (($("#ingre"+i).val() ==null)||($("#ingre"+i).val() =="")){
			console.log("DEBUG - 检查ingre字段为空时弹出警告");
			alert("inger字段"+i+"不能为空");
		}

		if (($("#metric"+i).val() ==null)||($("#metric"+i).val() =="")){
			console.log("DEBUG - 检查metric字段为空时弹出警告");
			alert("metric字段"+i+"不能为空");
		}
	}

	// 将百分比计算方法插入到每一个百分比框中
	// 
	var allingres = $("#tab tr").length-1;
	console.log("DEBUG -allingres是 "+allingres);
	for (var i=1;i<=allingres;i++){
		console.log("DEBUG -input 行号 "+i);
		$("#percent"+i).bind("change",function(){this.value=numberAndPoint(this.value);exchangePerc(this);});
	}
}



// 计算百分比方法
//
function exchangePerc(str){
	if(str.value!=100){
		alert("按照烘焙百分比规定，请先指定以面粉，或蛋为基数100.");
	}else{
		var allingres = $("#tab tr").length-1;
			// console.log("DEBUG - allingres= "+allingres);
		var percentId=str.id;
		var baseid=percentId;
		var sum=0;
		var perSum=0;
		baseid=baseid.substr(7,percentId.length);
			// console.log("DEBUG - baseid= "+baseid);
		var baseMetric=$("#metric"+baseid).val();
		for (var i=1;i<=allingres;i++){
			sum+=Number($("#metric"+i).val());
			
				// console.log("DEBUG -遍历行号: "+i);
				// console.log("DEBUG -thisid= percent"+i +" percentId= "+percentId);
			if("percent"+i != percentId){
					// console.log("DEBUG - 不等于基数的行是 "+i);
				var thisNum= $("#metric"+i).val()/baseMetric*100;
					// console.log("DEBUG - 该行的值是 "+$("#metric"+i).val());
					// console.log("DEBUG - 基数的值是 "+baseMetric);
					// console.log("DEBUG - 百分比是 "+thisNum);
				$("#percent"+i).val(formatNum(thisNum,2));
			}
			perSum+=Number($("#percent"+i).val());
		}

	}
		// 增加一行显示总量和，总百分比
		//
		console.log("DEBUG -sum= "+sum +" perSum= "+perSum);
		$("#tab").append("<tr><td align='right' colspan='2'>总计:&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;"+formatNum(sum,2)+"</td><td>&nbsp;&nbsp;&nbsp;"+formatNum(perSum,2)+"%</td><td></td></tr>");
		$("form").append("<input type='hidden' name='sum' value='"+formatNum(sum,2)+"' /><input type='hidden' name='perSum' value='"+formatNum(perSum,2)+"' />");
		$("#but").attr("disabled","disabled");
		// $("*:not(#sub)").attr("disabled","disabled");
}

// 求用量总和与百分比总和
// 
function showSumCount(){

}

//　在配方表中增加一行配料
//
function addNewLine(){
	        //增加<tr/>
        $("#but").click(function(){
            var _len = $("#tab tr").length;        
            $("#tab").append("<tr id="+_len+" align='center'>"
                                // +"<td>"+_len+"</td>"
                                +"<td><input type='text' name='ingre"+_len+"' id='ingre"+_len+"' /></td>"
                                +"<td><input type='text' name='metric"+_len+"' id='metric"+_len+"' onchange='javascript:this.value=numberAndPoint(this.value);' /></td>"
                                +"<td><input type='text' name='percent"+_len+"' id='percent"+_len+"' onclick='checkFill()' /><span class='bold'>%</span></td>"
                                +"<td><a href=\'#\' onclick=\'deltr("+_len+")\'>删除</a></td>"
                            +"</tr>");
}

// 绑定 #add button 的click事件
// $(document).bind("mobileinit", function(){
// $.mobile.activeBtnClass="ui-btn-hover-a";
// });
// $("document").on("mobileinit",function(){
// 	$.mobile.button.prototype.initSelector="div#add";
// });

// $(".selector").button({disabled,true});

// $(function(){
// 	console.log("DEBUG - BUTTON CREATED");
// 	$("#add").on("click", function() {alert("DEBUG - BUTTON CREATED");});
// });

// $("#add").on("click",function(){
// 	console.log("DEBUG - BUTTON CREATED");
// });
