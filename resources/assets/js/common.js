module.exports = {
	alertSuccess(message = 'Ya!', caption = "Successful.") {
		swal(message, caption, 'success');
	},

	alertError(message = 'Ooop!', caption = "Something wrong!") {
		swal(message, caption, 'error');
	}
}