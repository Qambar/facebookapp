$.each({
	changeValueAndSubmit: function(idOfFieldWithValue, value, formId){
		$(idOfFieldWithValue).val(value);
		$(formId).submit();
	},
	selectNewFriendAndSubmit: function (idOfDropDownField, friendCountValue, friendSentCount, formId) {
		$(idOfDropDownField).get(0).selectedIndex = friendCountValue;
		var TotalCount = $(idOfDropDownField + ' option').size();
		
		if (friendCountValue < TotalCount) {
			friendCountValue++;
			$(friendSentCount).val(friendCountValue);
			setTimeout(function(){$(formId).submit()},200); //delay submit
		} else {
			alert("Message Sent to All Your Friends ! :)");
		}
		
	}
},$.univ._import);