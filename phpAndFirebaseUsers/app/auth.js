//Listen to auth state changes
auth.onAuthStateChanged(user => {
   if (user) {
       document.querySelector(".status").innerHTML = "<h1>You are logged in</h1>";
   } else {
       document.querySelector(".status").innerHTML = "<h1>You are logged out</h1>";
   }
});



let signUp = document.querySelector('#signUpForm');
signUp.addEventListener('submit', (e) => {
    e.preventDefault();

    //Get user info
    let email = signUp['suEmail'].value;
    let password = signUp['suPassword'].value;

    console.log(email, password);

    //Sign up user
    auth.createUserWithEmailAndPassword(email, password).then(credentials => {
        signUp.reset();
    })
});

//Logout User
let logout = document.querySelector('#logout');
logout.addEventListener('click', (e) => {
    e.preventDefault();
    auth.signOut();
});

//Login User
let loginUser = document.querySelector('#signInForm');
loginUser.addEventListener('submit', (e) => {
    e.preventDefault();

    //Get user info
    let email = loginUser['siEmail'].value;
    let password = loginUser['siPassword'].value;

    auth.signInWithEmailAndPassword(email, password).then(credentials => {
        loginUser.reset();
    })

});

//Google sign in
googleSignIn = () => {
    base_provider = new firebase.auth.GoogleAuthProvider();
    firebase.auth().signInWithPopup(base_provider).then(function (result) {
        console.log("Success. Google linked");
    }).catch(function (err) {
        console.log(err);
        console.log("Failed to do");
    })
};

//Password reset
let resetPassword = document.querySelector('#passwordReset');
resetPassword.addEventListener('submit', (e) => {
    e.preventDefault();

    let emailReset = resetPassword['resetEmail'].value;

    auth.sendPasswordResetEmail(emailReset).then(function (result) {
        alert('Email sent')
    }).catch(function (err) {
        console.log(err);
        alert('Failed')
    })
});
