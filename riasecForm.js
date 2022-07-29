//function to delay question transfer to make decsions more visible
function delay(){
    return new Promise(resolve => {
        setTimeout(resolve, 400);
    });
}

//function that changes the size of the image that is selected
function ClickSizeChange(num){
    for (let i = 0; i < 5; i++) {
        console.log(i);
        let input = document.querySelector('input[id="'+num+' '+i+'"]')
        if (input.checked == true) {
            document.querySelector('label[for="'+num+' '+i+'"] img').width = "90";
        }
        else{
            document.querySelector('label[for="'+num+' '+i+'"] img').width = "70";
        }
    }
}


//function that checks what question the user is on before being able to submit
//checks a hidden h1 element for the id number - hides the old one and shows the new one
async function checkEnd(){
    let numElement = document.querySelector('h1[class="number"]');
    let num = numElement.id;
    //change image appearance
    ClickSizeChange(num);

    await delay();
    if (num != 60) {
        numElement.id = parseInt(num) + 1;
        //console.log(numElement);
        updateBar(parseInt(num) + 1);
        // if (num != -1){
        //     hideOld(num);
        // }
        // else{
        //     let oldQuestion = document.querySelector('section[id=-1]');
        //     oldQuestion.className = "hidden";
        // }
        hideOld(num);

        // let newQuestion = document.querySelector('section[id="'+numElement.id+'"]');
        // newQuestion.className = "nothidden";
        showNew(parseInt(num)+1);

        //console.log(num);        
    }
    else{
        // let oldQuestion = document.querySelector('section[id="60"]');
        // oldQuestion.className = "hidden";
        hideOld(num);
        let submitButn = document.querySelector('input[type="submit"]');
        submitButn.className = "nothidden";
    }

}

function hideOld(currid){
    document.querySelector('h2[id="'+currid+'"]').className = "hidden";
    for (let i = 0; i < 5; i++) {
        document.querySelector('input[id="'+currid+' '+i+'"]').type = "hidden";
        document.querySelector('label[for="'+currid+' '+i+'"]').className = "hidden";
    }
}

function showNew(currid){
    document.querySelector('h2[id="'+currid+'"]').className = "nothidden";
    for (let i = 0; i < 5; i++) {
        document.querySelector('input[id="'+currid+' '+i+'"]').type = "radio";
        document.querySelector('label[for="'+currid+' '+i+'"]').className = "emojishow";
    }
}

function PrevQuestion(){
    let numElement = document.querySelector('h1[class="number"]');
    let num = numElement.id;

    if (num!= 1){
        numElement.id = parseInt(num) - 1;
        hideOld(num);
        showNew(num-1);
        updateBar(parseInt(num)-1);
    }
}

function updateBar(QNum){
    gsap.to('#progress-bar',{
        width: ((QNum/60)*100) + '%'
    })
}

function beginQuiz(){
    document.querySelector('section[id="-1"]').className = "hidden";
    // document.querySelector('section[id="1"]').className = "nothidden";
    showNew(1);
    document.getElementById("bar-hold").className = "nothidden";
    document.getElementById("back").className = "nothidden";
}

//changes image when hovered over
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



