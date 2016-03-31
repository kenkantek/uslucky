import moment from 'moment';
import countdown from 'moment-countdown';
import tz from 'moment-timezone';

module.exports = {
	alertSuccess(caption = "Successful.", titlt = 'Ya!') {
		swal(title, caption, 'success');
	},

	alertError(caption = "Something wrong!", title = 'Ooop!') {
		swal(title, caption, 'error');
	},

    countDown(date_draw = new Date(), addHour = hours_before_close, tz = _timzone) {
        let end_month = date_draw.getMonth() + 1,
            now = moment().tz(tz).format(),
            start = moment(String(now).replace('T', ' ').substr(0, 19)),
            end = `${date_draw.getFullYear()}-${end_month >= 10 ? end_month : '0' + end_month}-${date_draw.getDate()} ${addHour}:00:00`;
        return start.countdown(end).toString();
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