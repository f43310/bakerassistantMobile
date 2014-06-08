	// 需求总量
	var reqSum=0;
	// 基准配料用量
	var baseMetric=0;


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

// 初始化保存按钮为disabled
// 
function disSaveButton(){
	$("#sub").attr("disabled","disabled");
}
// 相反
//
function saveButtonDisplay(){
	$("#sub").attr("disabled",false);
}

	// 初始化禁用保存
	//
	disSaveButton();
	// 绑定事件到reqSum 框
	console.log("事件change 被绑定到#reqSum");
	$("#reqSum").bind("change",function(){this.value = numberAndPoint(this.value);calculation(this);saveButtonDisplay();});



// 根据输入总量计算原料用量
function calculation(str){

	if(isNaN(str.value)){
		alert("不是一个数字的值.");
	}else{
		reqSum = formatNum(str.value,2);
			console.log("DEBUG - reqSum的值为: " + reqSum );			// 调试
		var perSum= $("#perSum").val();
			console.log("DEBUG - perSum的值为: " + perSum );			// 调试

		baseMetric = formatNum(reqSum/perSum*100, 2);					// 基准参量
			console.log("DEBUG - baseMetric的值为: " + baseMetric );			// 调试
		// 遍历每个百分比输入框，如果是100就将对应 metric 的值 设为 baseMetric，否则，相应metric 的值设为 baseMetric*percenti
		var r=1;
				console.log("DEBUG - r 的值为: " + r );			// 调试
		$("#tIngres").find("input[name^='percent']").each(			// 选择所有 input name属性以percent开头的input
				function(){
					if (this.value == 100){
						$("#metric"+r).val(baseMetric);
						r++;
						console.log("DEBUG - r1 的值为: " + r );			// 调试
					}else{
								console.log("DEBUG - percentr 的值为: " + $("#percent"+r).val() );			// 调试
						var generateMetric = formatNum(baseMetric*$("#percent"+r).val()/100, 2);
								console.log("DEBUG - generateMetric 的值为: " + generateMetric );			// 调试
						$("#metric"+r).val(generateMetric);
						r++;
						console.log("DEBUG - r2 的值为: " + r );			// 调试

					}
				}

			);

	}
}