module.exports = {
  handleChange(e) {
    this.vm.$set(this.expression, e.target.files[0]);
  },

  bind() {
    this.el.addEventListener('change', this.handleChange.bind(this), false);
  },

  unbind() {
    this.el.removeEventListener('change', this.handleChange, false);
  }
}