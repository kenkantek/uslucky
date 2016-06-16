import _ from 'lodash';

export default (val, categories) => {
	const parent = _.find(categories, { id: val });
	return val && parent
	? `<span class="badge badge-success">${parent.name}</span>` 
	: `<span class="badge badge-dark">No Parent</span>`;
}