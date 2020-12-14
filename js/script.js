document.addEventListener("DOMContentLoaded", function() {

    const descToggle = document.querySelector("#descToggle");
    const detailToggle = document.querySelector("#detailToggle");
    const colorsToggle = document.querySelector("#colorsToggle");

    descToggle.style.color = "blue";

    const desc = document.querySelector("#description");
    const col = document.querySelector("#colors");
    const det = document.querySelector("#details");

    descToggle.addEventListener('click', () => {

        desc.style.display = 'block';
        col.style.display = 'none';
        det.style.display = 'none';
        descToggle.style.color = "blue";
        detailToggle.style.color = "black";
        colorsToggle.style.color = "black";

    });

    detailToggle.addEventListener('click', () => {

        desc.style.display = 'none';
        col.style.display = 'none';
        det.style.display = 'block';
        descToggle.style.color = "black";
        detailToggle.style.color = "blue";
        colorsToggle.style.color = "black";

    });


    colorsToggle.addEventListener('click', () => {

        desc.style.display = 'none';
        col.style.display = 'block';
        det.style.display = 'none';
        descToggle.style.color = "black";
        detailToggle.style.color = "black";
        colorsToggle.style.color = "blue";

    });


});
