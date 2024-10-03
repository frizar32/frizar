document.addEventListener('DOMContentLoaded', ()=>{
	let flag = document.querySelector('.filter-mobail-js') == null ? false : true;
	if(flag){
		document.querySelector('.bxr-border-color .bxr-sortbutton.filter-mobail').addEventListener('click', ()=>{
			filterBlock();
		});
		document.querySelector('.js-filter-mobile-toggle').addEventListener('click', ()=>{
			filterBlock();
		});
	}
	else{
		document.getElementById('filter_mobail').style.display = "none";
	}
});

function filterBlock(){
	let filter = document.querySelector('.filter-mobail-js');
	let triangle = document.querySelector('.fa.fa-triangle');
	if(triangle.classList.contains('triangle-up')){
		triangle.classList.remove('triangle-up');
		triangle.classList.add('triangle-down');
		filter.style.left = '0';
		filter.style.right = '0';
		document.querySelector('body').style.overflowY = "hidden";
	}else{
		triangle.classList.remove('triangle-down');
		triangle.classList.add('triangle-up');
		filter.style.left = '-100%';
		filter.style.right = '100%';
		document.querySelector('body').style.overflowY = "auto";
	}
}