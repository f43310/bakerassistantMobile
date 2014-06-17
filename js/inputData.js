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

// function小数点后一位四舍五入
//
function round2(str){
   var s = parseFloat(str.substr(-1,1));
   if (s<5){
      return str.replace(/[1-9]$/,"0");      /// [1-9]$/
   }else {
      return str.replace(/[1-9]$/,"5");      //
   }

}


// 取得数组长度
function count(o) {                 
    var t  =  typeof o;                 
    if (t  ==  'string') {                         
        return o.length;                 
    } else 
    if (t  ==  'object') {                         
        var n  =  0;                         
        for (var i  in  o) { 
         n++;                         
        }                         
        return n; 

                        
    }                 
    return false;         
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

// clearPercentCol
//
function clearPercentCol(){
   // alert("href");
   $("input[id^='percent']").val("");
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
// function showSumCount(){

// }
// 定义recipes数组
// var recipes = new Array();

// 
$(function(){
// $("[type='submit']").button("disable");
	//增加<tr/>
	// 
   $("#add").click(function(){
   	 console.log("DEBUG - #add click");			// 调试
   	 var _len = $("tbody tr").length+1;
   	 console.log("DEBUG - _len: " + _len);			// 调试
   	 	$("tbody").append("<tr id='"+_len+"'>"
   	 		+"<td><div data-role='fieldcontain'><input type='text' name='ingre"+_len+"' id='ingre"+_len+"' data-mini='true'></div></td>"
   	 		+"<td><div data-role='fieldcontain'><input type='number' name='metric"+_len+"' id='metric"+_len+"' data-mini='true'></div></td>"
   	 		+"<td><div data-role='fieldcontain'><input type='number' name='percent"+_len+"' id='percent"+_len+"' data-mini='true'></div></td>"
   	 		+"<td><a href='#' data-role='button' data-mini='true' onclick='deltr("+_len+")'>删</a></td>"
   	 		+"</tr>");
   	 	$("tbody").trigger("create");		// css样式丢失,不能正解渲染
   	 	$("#tab").table("rebuild");			// 重构在reflow模式下,低屏宽显示正常
   	 	   // 删除控件
	   $("#tab input").textinput({clearBtn:true});
	   $("#tab input").textinput("refresh");
	   // 增加一行就绑定一次事件
	   $("input[type='number']").on("keyup change", function(){this.value=numberAndPoint(this.value);});
      // 设置step验证
      $("input[type='number']").attr("step", "0.01");

   });

   // 增加require属性
   $("#tab input").attr('required', true);

   // 删除控件
   $("#tab input").textinput({clearBtn:true});
   $("#tab input").textinput("refresh");	


});


   // 删除一行<tr>
   //
   var deltr = function(index){
   		var _len = $("tbody tr").length;
         console.log("DEBUG del - _len: " + _len);       // 调试
   		$("tr[id='"+index+"']").remove();		// 删除当前行
         console.log("DEBUG del - index: " + index);       // 调试
   		for(var i=index,j=_len;i<=j;i++){
   			var nextTxtVal1 = $("#ingre"+i).val();
            var nextTxtVal2 = $("#metric"+i).val();
            var nextTxtVal3 = $("#percent"+i).val();
            $("tr[id='"+i+"']")
            	.replaceWith("<tr id='"+(i-1)+"'>"
            		+"<td><div data-role='fieldcontain'><input type='text' name='ingre"+(i-1)+"' id='ingre"+(i-1)+"' value='"+nextTxtVal1+"' data-mini='true'></div></td>"
		   	 		+"<td><div data-role='fieldcontain'><input type='number' name='metric"+(i-1)+"' id='metric"+(i-1)+"' value='"+nextTxtVal2+"' data-mini='true'></div></td>"
		   	 		+"<td><div data-role='fieldcontain'><input type='number' name='percent"+(i-1)+"' id='percent"+(i-1)+"' value='"+nextTxtVal3+"' data-mini='true'></div></td>"
		   	 		+"<td><a href='#' data-role='button' data-mini='true' onclick='deltr("+(i-1)+")'>删</a></td>"
            		+"</tr>");
               console.log("DEBUG del - i: " + i);       // 调试
   		}
   		$("tbody").trigger("create");
   	 	$("#tab").table("rebuild");

   }

   // 计算烘焙百分比按钮
   $(function(){
   		$("#calculate").click(function(){
   			// 定义数组
   				var percents = new Array();
   			// 先验证配料和用量两列
   			var i=1;
   			$("tbody tr").each(function(){
   				if(($("input[id='ingre"+i+"']").val()=="") || ($("input[id='metric"+i+"']").val()=="")){
   					alert("请填写第 "+i+" 行上的配料和用量!");
   				}

   				if(($("input[id='percent"+i+"']").val() != "") && ($("input[id='percent"+i+"']").val() != undefined)){
   					percents[i] = $("input[id='percent"+i+"']").val();
   					console.log("DEBUG - percents: " + percents[i]);
   				}

   				i++;
   			});

   			// 判断数组
   			// 调试
   			// for(x in percents){
   			// 	console.log("DEBUG percents[x]" + x +"="+ percents[x]);
   			// }
   			console.log("DEBUG count(percents): " + count(percents));			// 调试
            var arrlen=count(percents);

   			if((arrlen) > 1){
   				alert("只能有一个百分比 100%");
   			} else if((arrlen) == 0){
   				alert("请指定一个原料做为100%");
   			} else if((arrlen) == 1){
   				for (var x in percents){
   					if (percents[x] != 100){
   						alert("您指定的值只能为100");
   					} else{
   						// 计算百分比
   						// 取得100%行号对应的metric值
   						var baseMetric =  $("input[id='metric"+x+"']").val();
   							console.log("DEBUG baseMetric: " + baseMetric);			// 调试
   						// 遍历每一行 
   						var i=1;
   						$("tbody tr").each(function(){
   							console.log("DEBUG x: " + x);			// 调试
   							console.log("DEBUG i: " + i);			// 调试
   							if ( i != x ) {
   								var thisRowMetric = $("input[id='metric"+i+"']").val();
   									console.log("DEBUG thisRowMetric: " + thisRowMetric);			// 调试
   								var thisRowPercent = formatNum((thisRowMetric/baseMetric*100),2);
   									console.log("DEBUG thisRowPercent: " + thisRowPercent);			// 调试
   								$("input[id='percent"+i+"']").val(thisRowPercent);
   							}
   							i++;
   						});

                     // 计算metric 和 percent列之和
                     var sum=0;
                     var percentSum=0;
                     var l=1;
                     $("tbody tr").each(function(){
                        sum += Number($("input[id='metric"+l+"']").val());
                        percentSum += Number($("input[id='percent"+l+"']").val());
                        l++;
                     });

                     // 表格最后增加一行显示 sum 和 percentSum
                     $("tbody").append("<tr>"
                                          +"<td></td>"
                                          +"<td>总产量= "+formatNum(sum,2)+"<input type='hidden' name='sum' id='sum' value='"+formatNum(sum,2)+"'></td>"
                                          +"<td>总百分比= "+formatNum(percentSum,2)+"<input type='hidden' name='percentSum' id='percentSum' value='"+formatNum(percentSum,2)+"'></td>"
                                          +"<td></td>"
                                          +"</tr>");
                     $("tbody").trigger("create");
                     $("#tab").table("rebuild");
                     $("#add").attr("disabled","disabled");

   					}
   				}
   			}




   		});
   });

// 增加 onchange事件 判断为数字
	$(function(){
		console.log("DEBUG :keyup change 事件己绑定!");
		$("input[type='number']").on("keyup change", function(){this.value=numberAndPoint(this.value);});
		// $("input[id^='percent']").on("change", function(){this.value=numberAndPoint(this.value);});
	});

   // 添加 step验证
   $(function(){
      $("input[type='number']").attr("step", "0.01");
   });

   // showDetail.php 生成子配方
   $(function(){
      $("#generateRecipe").click(function(){
         // alert($("input[id='requireSum']").val());
         if(($("input[id='requireSum']").val()=="") || ($("input[id='requireSum']").val()==undefined)){
            alert("请先填写需求总量");
            return false;
         }else{
            // 计算新配方
            var requireSum=$("input[id='requireSum']").val();
            console.log("DEBUG reqireSum: " + requireSum);       // 调试
            var percentSum=$("input[id='percentSum']").val();
            console.log("DEBUG percentSum: " + percentSum);       // 调试
            var newBaseMetric=formatNum(requireSum/percentSum*100);
            console.log("DEBUG newBaseMetric: " + newBaseMetric);       // 调试
            var i=1;
            $("tbody tr").each(function(){
               if($("input[id='percent"+i+"']").val()==100){
                  $("input[id='metric"+i+"']").val(round2(formatNum(newBaseMetric,1)));      // 设置小数位
               }else{
                  var thisPercent=$("input[id='percent"+i+"']").val();
                  console.log("DEBUG thisPercent: " + thisPercent);       // 调试
                  var newMetric=round2(formatNum(newBaseMetric*thisPercent/100,1));
                  console.log("DEBUG newMetric: " + newMetric);       // 调试
                  $("input[id='metric"+i+"']").val(newMetric);
               }
               i++;
            });
            $("#generateRecipe").attr("disabled","disabled").button("refresh");
            $("#saveSonRecipe").attr("disabled",false).button("refresh");

         }
      });
   });
   // 配方详情页增加根据一种配料的量计算其它配料的量
   $(function(){
      $("input[id^='metric']").on("change",function(){
         // alert(this.id);
         var rowNum=this.id.substr(-1,1);
         var thisPercent=$("input[id='percent"+rowNum+"']").val();
         var baseMetric=round2(formatNum(this.value/(thisPercent/100),1));
         var i=1;
         $("tbody tr").each(function(){
            if($("input[id='percent"+i+"']").val()==100){
               $("input[id='metric"+i+"']").val(baseMetric);
            }else{
               if(i!=rowNum){
                  var thisRowPercent=$("input[id='percent"+i+"']").val();
                  var thisMetric=round2(formatNum(baseMetric*(thisRowPercent/100),1));
                  $("input[id='metric"+i+"']").val(thisMetric);
               }
            }
            i++;
         });
         
      })
   });
