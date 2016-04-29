import countdown from 'countdown';

module.exports = {
	alertSuccess(caption = "Successful.", titlt = 'Ya!') {
		swal(title, caption, 'success');
	},

	alertError(caption = "Something wrong!", title = 'Ooop!') {
		swal(title, caption, 'error');
	},

    countDownGame(start = new Date, end = new Date, hourEnd = 0) {
        return countdown(
            new Date(start), 
            new Date(new Date(end).setHours(hourEnd))
        ).toString();
    },

    getQuerystring(name, url) {
        if (!url) url = window.location.href;
        url = url.toLowerCase();
        name = name.replace(/[\[\]]/g, "\\$&").toLowerCase();
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }
}

$('[data-toggle="tooltip"]').tooltip();