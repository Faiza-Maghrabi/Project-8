//function to delay question transfer to make decsions more visible
function delay(){
    return new Promise(resolve => {
        setTimeout(resolve, 200);
    });
}

// console.log("pain");
// await delay();
// console.log("after pain");

//function that checks what question the user is on before being able to submit
//checks a hidden h1 element for the id number - hides the old one and shows the new one
async function checkEnd(){
    await delay();
    let numElement = document.querySelector('h1[class="number"]');
    let num = numElement.id;
    if (num != 60) {
        numElement.id = parseInt(num) + 1;
        //console.log(numElement);

        let oldQuestion = document.querySelector('section[id="'+num+'"]');
        oldQuestion.className = "invisible";

        let newQuestion = document.querySelector('section[id="'+numElement.id+'"]')
        newQuestion.className = "visible";
    }
    else{
        let oldQuestion = document.querySelector('section[id="60"]');
        oldQuestion.className = "invisible";
        let submitButn = document.querySelector('input[type="submit"]');
        submitButn.className = "visible";
    }

}


const allradio = document.querySelectorAll('input[type="radio"]');
//console.log(allradio);
for (let i = 0; i < allradio.length; i++) {
    allradio[i].addEventListener('click',checkEnd);
}

// let submitButn = document.querySelector('input[type="submit"]');
// submitButn.addEventListener('click', checkEnd);
// window.alert(submitButn);
let firstQ = document.querySelector('section[id="1"]');
firstQ.className = "visible";

