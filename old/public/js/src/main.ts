function main() {
	let burger = document.getElementById('toggle');
	burger.addEventListener('click', toggleMenu);
}

function toggleMenu(){
	let menu: HTMLElement = document.getElementById('menu');
	menu.classList.toggle('hidden');
}

main();