//Read recipe data
let readRecipes = function () {
    db.collection("userRecipes").get().then(function (querySnapshot) {
        querySnapshot.forEach(function (doc) {
            renderUserRecipe(doc);
        })
    }).then(function () {
        renderFooter();
    })
};

//Render user recipe data
function renderUserRecipe(doc) {
    window.addEventListener( "pageshow", function ( event ) {
        let traversal = event.persisted ||
            ( typeof window.performance != "undefined" &&
                window.performance.navigation.type === 2 );
        if (traversal) {
            window.location.reload();
        }
    });

    let recipeParent = document.createElement('div');
    recipeParent.className = "recipeParent";

    let recipeHolder = document.createElement('div');
    recipeHolder.className = "recipeHolder";
    recipeParent.appendChild(recipeHolder);

    let recipeImg = document.createElement('div');
    recipeImg.className = "recipeImg";
    recipeHolder.appendChild(recipeImg);

    let img = document.createElement('img');
    img.src = doc.data().recipeImage;
    recipeImg.appendChild(img);

    let recipeInfo = document.createElement('div');
    recipeInfo.className = "recipeInfo";
    recipeHolder.appendChild(recipeInfo);

    let h1 = document.createElement('h1');
    h1.textContent = doc.data().recipeName;
    recipeInfo.appendChild(h1);

    let pDescription = document.createElement('p');
    pDescription.textContent = doc.data().recipeDescription;
    recipeInfo.appendChild(pDescription);

    let pTime = document.createElement('p');
    pTime.textContent = doc.data().recipeTime;
    recipeInfo.appendChild(pTime);

    let imgTime = document.createElement('img');
    imgTime.src = '../assets/time.svg';
    pTime.appendChild(imgTime);

    let pServings = document.createElement('p');
    pServings.textContent = doc.data().recipeServings;
    recipeInfo.appendChild(pServings);

    let imgServings = document.createElement('img');
    imgServings.src = '../assets/servings.svg';
    pServings.appendChild(imgServings);

    let ing1 = document.createElement('p');
    ing1.className = "ingredients";
    ing1.textContent = doc.data().ingredient1;
    recipeInfo.appendChild(ing1);

    let ing2 = document.createElement('p');
    ing2.className = "ingredients";
    ing2.textContent = doc.data().ingredient2;
    recipeInfo.appendChild(ing2);

    let ing3 = document.createElement('p');
    ing3.className = "ingredients";
    ing3.textContent = doc.data().ingredient3;
    recipeInfo.appendChild(ing3);

    let ing4 = document.createElement('p');
    ing4.className = "ingredients";
    ing4.textContent = doc.data().ingredient4;
    recipeInfo.appendChild(ing4);

    let ins1 = document.createElement('p');
    ins1.className = "instructions";
    ins1.textContent = doc.data().instruction1;
    recipeInfo.appendChild(ins1);

    let ins2 = document.createElement('p');
    ins2.className = "instructions";
    ins2.textContent = doc.data().instruction2;
    recipeInfo.appendChild(ins2);

    let ins3 = document.createElement('p');
    ins3.className = "instructions";
    ins3.textContent = doc.data().instruction3;
    recipeInfo.appendChild(ins3);

    let ins4 = document.createElement('p');
    ins4.className = "instructions";
    ins4.textContent = doc.data().instruction4;
    recipeInfo.appendChild(ins4);

    let viewButton = document.createElement('button');
    viewButton.textContent = 'View';
    viewButton.className = "viewRecipe";
    viewButton.id = doc.id;
    viewButton.setAttribute("name", doc.name);
    recipeHolder.appendChild(viewButton);
    viewButton.onclick = function (e) {
        window.location.href = "viewRecipe.html";
    };

    let editButton = document.createElement('button');
    editButton.textContent = 'Edit';
    editButton.className = "editRecipeUser";
    editButton.id = doc.id;
    editButton.setAttribute('content', doc.content)
    recipeHolder.appendChild(editButton);
    editButton.onclick = async function () {
        console.log(doc.content);
        let data;
        const {value: formValues} = await Swal.fire({
            showCancelButton: true,
            confirmButtonColor: '#5bd658',
            cancelButtonColor: '#d33',
            title: 'Edit Recipe',
            width: 1000,
            html:
                '<form id="editRecipe" action="">\n' +
                '<input value="https://upload.wikimedia.org/wikipedia/commons/thumb/6/67/Ice_Block%2C_Canal_Park%2C_Duluth_%2832752478892%29.jpg/1200px-Ice_Block%2C_Canal_Park%2C_Duluth_%2832752478892%29.jpg" type="text" name="recipeImage" placeholder="Add Recipe Image (URL)"><br>\n' +
                '            <input type="text" name="recipeName" placeholder="Recipe Name"><br>\n' +
                '            <input type="text" name="recipeDescription" placeholder="Recipe Description"><br>\n' +
                '            <input type="text" name="recipeTime" placeholder="Recipe Total Time"><br>\n' +
                '            <input type="text" name="recipeServings" placeholder="Recipe Serving Size"><br>\n' +
                '            <h1>Enter Ingredients</h1><br>\n' +
                '            <input  name="ingredient1" placeholder="Ingredient #1"><br>\n' +
                '            <input  name="ingredient2" placeholder="Ingredient #2"><br>\n' +
                '            <input  name="ingredient3" type="text" placeholder="Ingredient #3"><br>\n' +
                '            <input  name="ingredient4" type="text" placeholder="Ingredient #4"><br>\n' +
                '            <input  name="ingredient5" type="text" placeholder="Ingredient #5"><br>\n' +
                '            <input  name="ingredient6" type="text" placeholder="Ingredient #6"><br>\n' +
                '            <input  name="ingredient7" type="text" placeholder="Ingredient #7"><br>\n' +
                '            <input  name="ingredient8" type="text" placeholder="Ingredient #8"><br>\n' +
                '<!--            <i class="fas fa-plus-circle"></i>-->\n' +
                '            <h1>Enter Instructions</h1><br>\n' +
                '            <input type="text" name="instruction1" placeholder="Instruction #1"><br>\n' +
                '            <input type="text" name="instruction2" placeholder="Instruction #2"><br>\n' +
                '            <input type="text" name="instruction3" placeholder="Instruction #3"><br>\n' +
                '            <input type="text" name="instruction4" placeholder="Instruction #4"><br>\n' +
                '            <input type="text" name="instruction5" placeholder="Instruction #5"><br>\n' +
                '            <input type="text" name="instruction6" placeholder="Instruction #6"><br>\n' +
                '            <input type="text" name="instruction7" placeholder="Instruction #7"><br>\n' +
                '            <input name="instruction8" type="text" placeholder="Instruction #8"><br>' +
                '        </form>',

            focusConfirm: false,
            preConfirm: () => {
                let editRecipeForm = document.getElementById("editRecipe");
                data = {
                    recipeImage: editRecipeForm.recipeImage.value.trim(),
                    recipeName: editRecipeForm.recipeName.value.trim(),
                    recipeDescription: editRecipeForm.recipeDescription.value.trim(),
                    recipeTime: editRecipeForm.recipeTime.value.trim(),
                    recipeServings: editRecipeForm.recipeServings.value.trim(),
                    ingredient1: editRecipeForm.ingredient1.value.trim(),
                    ingredient2: editRecipeForm.ingredient2.value.trim(),
                    ingredient3: editRecipeForm.ingredient3.value.trim(),
                    ingredient4: editRecipeForm.ingredient4.value.trim(),
                    ingredient5: editRecipeForm.ingredient5.value.trim(),
                    ingredient6: editRecipeForm.ingredient6.value.trim(),
                    ingredient7: editRecipeForm.ingredient7.value.trim(),
                    ingredient8: editRecipeForm.ingredient8.value.trim(),
                    instruction1: editRecipeForm.instruction1.value.trim(),
                    instruction2: editRecipeForm.instruction2.value.trim(),
                    instruction3: editRecipeForm.instruction3.value.trim(),
                    instruction4: editRecipeForm.instruction4.value.trim(),
                    instruction5: editRecipeForm.instruction5.value.trim(),
                    instruction6: editRecipeForm.instruction6.value.trim(),
                    instruction7: editRecipeForm.instruction7.value.trim(),
                    instruction8: editRecipeForm.instruction8.value.trim()
                };
            }
        }).then((result) => {
           if (result.value) {
               db.collection('userRecipes').doc(this.id).update(data).then(Swal.fire({
                   title: 'Updated!',
                   text: 'Your recipe has been updated',
                   icon: 'success'
               })).then(() => {
                   window.addEventListener("click", function () {
                       window.location.reload();
                   })
               });
           }
        });
        // if (formValues) {
        //     console.log(data);
        //     db.collection('userRecipes').doc(this.id).update(data)
        // }
        // Swal.fire({
        //     title: 'Success!',
        //     text: 'Your recipe has been updated.',
        //     icon: 'success'
        // }).then(() => {
        //     window.addEventListener("click", function () {
        //         window.location.reload();
        //     })
        // });
    };

    let deleteButton = document.createElement('button');
    deleteButton.textContent = 'Delete';
    deleteButton.className = "deleteRecipe";
    deleteButton.id = doc.id;
    deleteButton.onclick = function () {
        Swal.fire({
            title: 'Do you want to delete your recipe?',
            text: "This change cannot be reversed!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#5bd658',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete my recipe'
        }).then((result) => {
            if (result.value) {
                db.collection('userRecipes').doc(this.id).delete().then(Swal.fire({
                    title: 'Deleted!',
                    text: 'Your recipe has been deleted.',
                    icon: 'success'
                })).then(() => {
                    window.addEventListener("click", function () {
                        window.location.reload();
                    })
                });
            }
        });
    };
    recipeHolder.appendChild(deleteButton);

    document.body.appendChild(recipeParent);
}


//Render footer
function renderFooter() {

    let footer = document.createElement('footer');

    let p = document.createElement('p');
    footer.appendChild(p);

    let copyright = document.createElement('span');
    copyright.className = "footerLeft";
    copyright.textContent = "Copyright © 2019 The Jungle Cook";
    p.appendChild(copyright);

    let footerLogin = document.createElement('span');
    footerLogin.className = "footerMiddle";
    let aLogin = document.createElement('a');
    aLogin.href = "login.html";
    aLogin.textContent = "Login";
    footerLogin.appendChild(aLogin);
    p.appendChild(footerLogin);

    let footerRecipes = document.createElement('span');
    footerRecipes.className = "footerMiddle";
    let aRecipes = document.createElement('a');
    aRecipes.href = "recipes.html";
    aRecipes.textContent = "Recipes by Category";
    footerRecipes.appendChild(aRecipes);
    p.appendChild(footerRecipes);

    let privacy = document.createElement('span');
    privacy.className = "footerMiddle";
    privacy.textContent = "Privacy and Copyright";
    p.appendChild(privacy);

    let footerCreate = document.createElement('span');
    footerCreate.className = "footerMiddle";
    let aCreate = document.createElement('a');
    aCreate.href = "createRecipe.html";
    aCreate.textContent = "Create Recipe";
    footerCreate.appendChild(aCreate);
    p.appendChild(footerCreate);

    let footerUser = document.createElement('span');
    footerUser.className = "footerMiddle";
    let aUser = document.createElement('a');
    aUser.href = "recipes.html";
    aUser.textContent = "Your Recipes";
    footerUser.appendChild(aUser);
    p.appendChild(footerUser);

    let footerSocial = document.createElement('span');
    footerSocial.className = "footerRight";
    let aFacebook = document.createElement('a');
    aFacebook.href = "https://facebook.com";
    let imgFacebook = document.createElement('img');
    imgFacebook.src = "../assets/facebook.svg";
    aFacebook.appendChild(imgFacebook);
    footerSocial.appendChild(aFacebook);
    p.appendChild(footerSocial);

    footerSocial.className = "footerRight";
    let aInstagram = document.createElement('a');
    aInstagram.href = "https://instagram.com";
    let imgInstagram = document.createElement('img');
    imgInstagram.src = "../assets/instagram.svg";
    aInstagram.appendChild(imgInstagram);
    footerSocial.appendChild(aInstagram);
    p.appendChild(footerSocial);

    document.body.appendChild(footer);
}