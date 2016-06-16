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
			if(/^https?/.test(file)) {
				return this.el.src = file;
			}
			if(file.image) {
				return this.el.src = file.image;
			}
		}
	}
}