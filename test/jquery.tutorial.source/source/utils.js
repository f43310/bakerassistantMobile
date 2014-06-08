function checkForm() {
	try {
		if ($.trim($('#person').val()) == "" ||
			$.trim($('#contact').val()) == "" ||
			$.trim($('#description').val()) == "") {
				alert("Please enter all fields");
				return false;
			}
	} catch (e) {
		alert(e);
		return false;
	}
	return true;
}

function deleteEntry(id) {
	try {
		var confirmString = "Delete this entry.  Are you sure?\n" + $.trim($('#person').val()) + "\n" + $.trim($('#contact').val()) + "\n" + $.trim($('#description').val());
		if (window.confirm(confirmString)) {
			window.location="index.php?action=delete&id=" + id;
		}
	} catch (e) {
		alert(e);
		return false;
	}
	return true;

}