window.onload = function(){
    var image = document.querySelector("#featured img");
    var fig = document.querySelector("figcaption");
    var images = document.querySelectorAll("#thumbnails img");
    var len = images.length;
    for(let i=0; i<len; i++){
        images[i].onclick = function(){
            image.src = images[i].src.replace('small','medium');
            fig.innerHTML = images[i].title;
        };
    }
    image.onmouseover = function () {
        fig.style.opacity = 0.8;
        fig.style.transitionDuration = '1s';
    };
    image.onmouseout = function() {
        fig.style.opacity = 0;
        fig.style.transitionDuration = '1s';
    };
};