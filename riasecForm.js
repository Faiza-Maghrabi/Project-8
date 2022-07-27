//function to delay question transfer to make decsions more visible - not currently being used
function delay(){
    return new Promise(resolve => {
        setTimeout(resolve, 200);
    });
}

const allradio = document.querySelectorAll('input[type="radio"]');
//console.log(allradio);
for (let i = 0; i < allradio.length; i++) {
    allradio[i].addEventListener('click',checkEnd);
}



//function that checks what question the user is on before being able to submit
//checks a hidden h1 element for the id number - hides the old one and shows the new one
async function checkEnd(){
    await delay();
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

        console.log(num);        
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

//IMAGE CHANGING - IF NO SELECT, THEN EVERY HOVER CHANGES IMAGE
//IF THE RADIO WAS ALREADY SELECTED, IMAGE DOSENT CHANGE
//IF THE RADIO WASNT ALREADY SELECTED - BUT ANOTHER ONE WAS - HAVE BOTH CHANGE - IF NEW ONE IS SELECTRED, THE PREVIOUS ONE'S CHANGES ARE REMOVED.


//changes image when hovered over - NEED TO CHECK IF SOMETHING IS SELECTED OR NOT
function hover(number,y){
    let combine = number + " " + y;
    //console.log(document.querySelector('label[for="'+combine+'"] img'));
    document.querySelector('label[for="'+combine+'"] img').src = "Emojis/Selected/"+(y + 1)+".png";
    //console.log(a + " " + b);
}

function hoverOff(number,y){
    let combine = number + " " + y;
    document.querySelector('label[for="'+combine+'"] img').src = "Emojis/"+(y + 1)+".png";
}





// let submitButn = document.querySelector('input[type="submit"]');
// submitButn.addEventListener('click', checkEnd);
// window.alert(submitButn);

let startBtn = document.querySelector('button[class="button"]');
startBtn.addEventListener('click', beginQuiz);
let backBtn = document.getElementById("back");
backBtn.addEventListener('click', PrevQuestion);



