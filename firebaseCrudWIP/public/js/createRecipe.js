let createRecipeForm = document.getElementById("createRecipe");

//Save user recipe data
createRecipeForm.addEventListener('submit', (e) => {
    e.preventDefault();
    let data = {
        recipeImage: createRecipeForm.recipeImage.value.trim(),
        recipeName: createRecipeForm.recipeName.value.trim(),
        recipeDescription: createRecipeForm.recipeDescription.value.trim(),
        recipeTime: createRecipeForm.recipeTime.value.trim(),
        recipeServings: createRecipeForm.recipeServings.value.trim(),
        ingredient1: createRecipeForm.ingredient1.value.trim(),
        ingredient2: createRecipeForm.ingredient2.value.trim(),
        ingredient3: createRecipeForm.ingredient3.value.trim(),
        ingredient4: createRecipeForm.ingredient4.value.trim(),
        ingredient5: createRecipeForm.ingredient5.value.trim(),
        ingredient6: createRecipeForm.ingredient6.value.trim(),
        ingredient7: createRecipeForm.ingredient7.value.trim(),
        ingredient8: createRecipeForm.ingredient8.value.trim(),
        instruction1: createRecipeForm.instruction1.value.trim(),
        instruction2: createRecipeForm.instruction2.value.trim(),
        instruction3: createRecipeForm.instruction3.value.trim(),
        instruction4: createRecipeForm.instruction4.value.trim(),
        instruction5: createRecipeForm.instruction5.value.trim(),
        instruction6: createRecipeForm.instruction6.value.trim(),
        instruction7: createRecipeForm.instruction7.value.trim(),
        instruction8: createRecipeForm.instruction8.value.trim()
    };
    db.collection('userRecipes').add(data).then(function (docRef) {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Your recipe has been added. Check out Your Recipes to see it!'
        });
        console.log('Document written with ID: ', docRef.id);
    }).catch(function (error) {
        console.error('Error adding document: ', error);
    });
    createRecipeForm.recipeImage.value = "";
    createRecipeForm.recipeName.value = "";
    createRecipeForm.recipeDescription.value = "";
    createRecipeForm.recipeTime.value = "";
    createRecipeForm.recipeServings.value = "";
    createRecipeForm.ingredient1.value = "";
    createRecipeForm.ingredient2.value = "";
    createRecipeForm.ingredient3.value = "";
    createRecipeForm.ingredient4.value = "";
    createRecipeForm.ingredient5.value = "";
    createRecipeForm.ingredient6.value = "";
    createRecipeForm.ingredient7.value = "";
    createRecipeForm.ingredient8.value = "";
    createRecipeForm.instruction1.value = "";
    createRecipeForm.instruction2.value = "";
    createRecipeForm.instruction3.value = "";
    createRecipeForm.instruction4.value = "";
    createRecipeForm.instruction5.value = "";
    createRecipeForm.instruction6.value = "";
    createRecipeForm.instruction7.value = "";
    createRecipeForm.instruction8.value = "";
    readRecipes();
});