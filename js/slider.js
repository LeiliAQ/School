let slideIndex = 1 ;
function setSlide(input,index){
    slideIndex = index;
    let item = document.querySelector(`#${input}`)
    let slides = [...document.querySelector('.slides').children] ;
    slides.forEach((element)=>{
        element.classList.remove('active');
    })
    item.classList.add('active');
}

setInterval(()=>{
    slideIndex += 1;
    if(slideIndex == 4){
        slideIndex = 1;
    }
    setSlide(`slide${slideIndex}` , slideIndex)
} , 6000)

function onFocus() {
    document.getElementById("another-main").style.display = "block";
    document.getElementById("bar-icon").style.display = "none";
    document.getElementById("bar-icon-blur").style.display = "block";
}

function onBlur() {
    document.getElementById("another-main").style.display = "none";
    document.getElementById("bar-icon").style.display = "block";
    document.getElementById("bar-icon-blur").style.display = "none";
}