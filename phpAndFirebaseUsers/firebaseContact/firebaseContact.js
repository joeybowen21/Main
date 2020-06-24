//Firebase collection
let ref = firebase.database().ref('contacts');
getData();


//Listener for form submission
document.getElementById('contactForm').addEventListener('submit', submitForm);

//Submits form
function submitForm(e) {
    e.preventDefault();

    //Get values
    let firstName = getInputValues('firstName');
    let lastName = getInputValues('lastName');
    let email = getInputValues('email');
    let comment = getInputValues('comment');

    //Save contacts
    saveData(firstName, lastName, email, comment);

    //Show Confirmation
    document.getElementById('alert').style.display = 'block';

    //Hide Confirmation
    setTimeout(function () {
            document.getElementById('alert').style.display = 'none';
        }, 10000);

    //Clear form
    document.getElementById('contactForm').reset();
}

//Function to get contact form values
function getInputValues(id) {
    return document.getElementById(id).value;
}

//Save contacts to firebase
function saveData(firstName, lastName, email, comment) {
    let data = {
        firstName: firstName,
        lastName: lastName,
        email: email,
        comment: comment
    };
    ref.push(data);
}

function getData() {
    ref.on('value', gotData, errorData);

    function gotData(data) {
        let contacts = data.val();
        let keys = Object.keys(contacts);

        for (var i = 0; i < keys.length; i++) {
            let k = keys[i];
            let firstName = contacts[k].firstName;
            let lastName = contacts[k].lastName;
            let email = contacts[k].email;
            let comment = contacts[k].comment;

            let messageContainerFire = document.createElement('div');
            messageContainerFire.setAttribute("id", "messageContainerFire");
            document.querySelector("#formWrapperFire").appendChild(messageContainerFire);

            let message = document.createElement('div');
            message.setAttribute("id", "message");
            document.querySelector("#messageContainerFire").appendChild(message);

            let messageHeader = document.createElement('div');
            messageHeader.setAttribute("id", "messageHeader");
            messageHeader.innerHTML = firstName + " " + lastName + "<br>" + email;
            document.querySelector("#message").appendChild(messageHeader);

            let messageComment = document.createElement('div');
            messageHeader.setAttribute("id", "messageComment");
            messageComment.innerHTML = comment;
            messageComment.setAttribute("style", "font-weight: bold; padding: 5px; word-break: break-all; border-bottom: 2px solid #000000;");
            document.querySelector("#message").append(messageComment);
        }
    }

    function errorData(err) {
        console.log("Error");
        console.log(err);
    }

}
