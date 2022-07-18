//function to delay question transfer to make decsions more visible - not currently being used
function delay(){
    return new Promise(resolve => {
        setTimeout(resolve, 200);
    });
}


//function that checks what question the user is on before being able to submit
//checks a hidden h1 element for the id number - hides the old one and shows the new one
async function checkEnd(){
    //await delay();
    let numElement = document.querySelector('h1[class="number"]');
    let num = numElement.id;
    if (num != 60) {
        numElement.id = parseInt(num) + 1;
        //console.log(numElement);
        updateBar(parseInt(num) + 1);
        let oldQuestion = document.querySelector('section[id="'+num+'"]');
        oldQuestion.className = "invisible";

        let newQuestion = document.querySelector('section[id="'+numElement.id+'"]');
        newQuestion.className = "visible";
        
    }
    else{
        let oldQuestion = document.querySelector('section[id="60"]');
        oldQuestion.className = "invisible";
        let submitButn = document.querySelector('input[type="submit"]');
        submitButn.className = "visible";
    }

}

function PrevQuestion(){
    let numElement = document.querySelector('h1[class="number"]');
    let num = numElement.id;
    if (num != 1) {
        numElement.id = parseInt(num) - 1;
        //console.log(numElement);
        updateBar(parseInt(num) - 1);
        let oldQuestion = document.querySelector('section[id="'+num+'"]');
        oldQuestion.className = "invisible";

        let newQuestion = document.querySelector('section[id="'+numElement.id+'"]');
        newQuestion.className = "visible";
        
    }
}

function updateBar(QNum){
    gsap.to('#progress-bar',{
        width: ((QNum/60)*100) + '%'
    })
}

function beginQuiz(){
    document.querySelector('section[id="-1"]').className = "invisible";
    document.querySelector('section[id="1"]').className = "visible";
    document.getElementById("bar-hold").className = "visible";
    document.getElementById("back").className = "visible";
}


const allradio = document.querySelectorAll('input[type="radio"]');
//console.log(allradio);
for (let i = 0; i < allradio.length; i++) {
    allradio[i].addEventListener('click',checkEnd);
}

// let submitButn = document.querySelector('input[type="submit"]');
// submitButn.addEventListener('click', checkEnd);
// window.alert(submitButn);

let startBtn = document.querySelector('button[class="button"]');
startBtn.addEventListener('click', beginQuiz);
let backBtn = document.getElementById("back");
backBtn.addEventListener('click', PrevQuestion);



