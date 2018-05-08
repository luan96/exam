$.ajaxSetup({
    beforeSend: function(xhr, type) {
        if (!type.crossDomain) {
            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
        }
    },
});

var exam = {
	// remainTime: function()
	// {
	//     $.ajax({
	//     	url: "/exam/time", 
	//     	dataType: "json", 
	//     	success: function(result){
	//         $("#remain").text(result.remain_time);
	// 	    }
	// 	});
	// },

	//Thời gian còn lại của thí sinh
	secondsToWords: function(val)
	{
		if(val<=1){
            $('#btn_finish').trigger('click');
			return "Hết giờ";
		} 
	   	hours = parseInt( val / 3600 ) % 24;
	   	minutes = parseInt( val / 60 ) % 60;
	   	seconds = val % 60;
		result = "";
		if(hours) result += (hours < 10 ? "0" + hours : hours) + ":" ;
	    else{ result += "00:"}
		if(minutes) result +=(minutes < 10 ? "0" + minutes : minutes) + ":";
	    else{ result += "00:"}
		result += (seconds  < 10 ? "0" + seconds : seconds) + " ";
		
		return result;
	},
	countDownTime: function()
	{
	    if(typeof ($('#remain').text())!== "undefined")
	    {
	        val = parseInt($('#remain').text(),10);
	        maxtime = 3600;
	        $('#remainTime').html(exam.secondsToWords(val));
	        remain = val-1;

	        if(remain<=0 && !finishExam)
	        {
	            QuestionFront.finishExam(true);
	        }
	        $('#remain').text(remain);
	    }
	} 
}

var user = {
	handleFiles: function(files)
	{
	    show_image.innerHTML = "";
	    for (var i = 0; i < files.length; i++)
	    {
	    	var img = document.createElement("img");
	    	img.src = window.URL.createObjectURL(files[i]);
	    	img.height = 60;
			img.onload = function()
			{
	        	window.URL.revokeObjectURL(this.src);
	      	}
			show_image.appendChild(img);
	    }
	}
}

//lưu từng câu hỏi khi nhấn chuyển câu hỏi
$(document).ready(function(){
	$(".chuyencauhoi").click(function()
	{
		var answer = [];
		var question = $('.tab-pane.active .macauhoi').val();
		$.each($('.tab-pane.active input:checked'),function(){
			answer.push($(this).val());
		});
		$.ajax({
			url : "/exam/luubailam",
			type : "post",
			data : {
				answers: answer,
				quesstions: question,
			},
			success : function (){}
		});
	});
});
