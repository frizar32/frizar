document.addEventListener('DOMContentLoaded', ()=>{
	let max = 0;
	for(let elem of document.querySelectorAll('.bxr-default-element .bxr-promo-ribbon-info')){
		if(max < elem.offsetHeight){
			max = elem.offsetHeight;
		}
	}
	for(let elem of document.querySelectorAll('.bxr-default-element .bxr-promo-ribbon-info')){
		//elem.style.height = max+'px';
	}
	if(window.innerWidth <= 991){
		let span = document.querySelectorAll('span.bxr-promo-ribbon-name');
		for(let elem of span){
			//elem.style.cssText = "background-color: transparent;color: #fff;";
		}
	}
});