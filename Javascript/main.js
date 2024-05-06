// Slider animation
const track = document.getElementById("img-track");

window.onmousedown = e => {
	track.dataset.mouseDownAt = e.clientX;
}

window.onmousemove = e => {

	if (track.dataset.mouseDownAt==="0") return
	const mouseDelta = parseFloat(track.dataset.mouseDownAt)- e.clientX , 
	maxDelta =window.innerWidth;
	const percentage = (mouseDelta/maxDelta) * -100;
	nextPercentage = parseFloat(track.dataset.prevPercentage) + percentage;
	if (nextPercentage>0){
		nextPercentage=0;
	}
	if (nextPercentage<-100){
		nextPercentage=-100;
	}

	track.dataset.percentage = nextPercentage;

	track.animate({

		transform:"translate(" + (nextPercentage) + "%,-50%)"
	},{duration:1200,fill:"forwards"});

	for(const image of track.getElementsByClassName("image")){
		image.animate({objectPosition:nextPercentage +100+ "% 50%" },{duration:1200,fill:"forwards"});
	}

}

window.onmouseup = e => {
	track.dataset.mouseDownAt = "0";
	if(track.dataset.percentage===undefined){
		track.dataset.percentage=0;
	}

	track.dataset.prevPercentage=track.dataset.percentage;

}

// Change topic
let items = document.querySelectorAll(`.topicpick .list .item`)
let next = document.getElementById(`next`)
let prev = document.getElementById(`prev`)
let imgTrack = document.querySelectorAll(`.topicpick .img-track .item`)

let countItem = items.lenght
let itemActive = 0

next.onclick = function(){
    itemActive = itemActive + 1;
    if(itemActive >= countItem){
        itemActive = 0;
    }
    showSlider();
}
prev.onclick = function(){
    itemActive = itemActive - 1;
    if(itemActive < 0){
        itemActive = countItem - 1;
    }
    showSlider();
}

function showSlider(){
    let itemActiveOld = document.querySelector(`.topicpick .list .item.active`)
    let imgtrackActiveOld = document.querySelector(`.img-track .item.active`)
    itemActiveOld.classList.remove(`active`)
    imgtrackActiveOld.classList.remove(`active`)

    items[itemActive].classList.add(`active`)
    imgTrack[itemActive].classList.add(`active`)
}

imgTrack.forEach((imgTrack, index) => {
    imgTrack.addEventListener('click', () => {
        itemActive = index
        showSlider()
    })
})

