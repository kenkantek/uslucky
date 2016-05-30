module.exports = {
  handleChange(e) {
  	for(let i = 0; i < e.target.files.length; i++) {
	    this.vm.$set(this.expression, [...this.vm.$get(this.expression), e.target.files[i]]);
  	}
  },

  bind() {
    this.el.addEventListener('change', this.handleChange.bind(this), false);
  },

  unbind() {
    this.el.removeEventListener('change', this.handleChange, false);
  }
}