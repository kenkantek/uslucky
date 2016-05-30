module.exports = {
	update(file) {
		if(!file) return false;

		if(/^image\//.test(file.type)) {
			const reader = new FileReader();
			reader.onload = (event) => {
			    this.el.src = event.target.result;
			}
			reader.readAsDataURL(file);
		} else {
			this.el.src = file;
		}
	}
}