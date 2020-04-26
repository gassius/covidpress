window.onload = () => {
    const covidpress = document.getElementById('covidpress-advisor-container');
    console.log(covidpress);
    const closeButton = document.getElementById('covidpress-advisor-dismiss');
    closeButton.onclick = () => {        
        covidpress.style.bottom = -600;
    };
    covidpress.style.bottom = 0;
}