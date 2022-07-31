//function to delay question transfer to make decsions more visible
function delay(){
    return new Promise(resolve => {
        setTimeout(resolve, 300);
    });
}

//function that changes the size of the image that is selected
function ClickSizeChange(num){
    for (let i = 0; i < 5; i++) {

        let input = document.querySelector('input[id="'+num+' '+i+'"]')
        if (input.checked == true) {
            document.querySelector('label[for="'+num+' '+i+'"] img').width = "90";
            //console.log(input.value);
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
    //console.log(num);

    ClickSizeChange(num);
    await delay();

    let oldsection = document.querySelector('section[id="'+num+'"]');
    oldsection.className = "hidden";

    if (num != 60) {
        updateBar(parseInt(num) + 1);
        numElement.id = parseInt(num) + 1;
        let newsection = document.querySelector('section[id="'+numElement.id+'"]');
        newsection.className = "nothidden";
    }
    else{

        let submitButn = document.querySelector('input[type="submit"]');
        submitButn.className = "nothidden";
    }

}


function PrevQuestion(){
    let numElement = document.querySelector('h1[class="number"]');
    let num = numElement.id;

    if (num!= 1){
        numElement.id = parseInt(num) - 1;
        let oldsection = document.querySelector('section[id="'+num+'"]');
        oldsection.className = "hidden";
        let newsection = document.querySelector('section[id="'+numElement.id+'"]');
        newsection.className = "nothidden";
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
    // console.log(document.querySelector('section[id="1"]'));
    document.querySelector('section[id="1"]').className = "nothidden";
    
    document.getElementById("bar-hold").className = "nothidden";
    document.getElementById("back").className = "nothidden";
}

//changes image when hovered over
function hover(number,y){
    let combine = number + " " + y;
    //console.log(y);
    //console.log(document.querySelector('label[for="'+combine+'"] img'));
    document.querySelector('label[for="'+combine+'"] img').src = "Emojis/Selected/"+(y + 1)+".png";
    //console.log(a + " " + b);
}

function hoverOff(number,y){
    let combine = number + " " + y;
    document.querySelector('label[for="'+combine+'"] img').src = "Emojis/"+(y + 1)+".png";
}

let startBtn = document.querySelector('button[class="button"]');
startBtn.addEventListener('click', beginQuiz);
let backBtn = document.getElementById("back");
backBtn.addEventListener('click', PrevQuestion);



