window.onload = () => {
    const covidpress = document.getElementById('covidpress-advisor-container');
    const closeButton = document.getElementById('covidpress-advisor-dismiss');    
    closeButton.onclick = () => {   
        covidpress.style.bottom = '-600px';
    };
    covidpress.style.bottom = 0;
}