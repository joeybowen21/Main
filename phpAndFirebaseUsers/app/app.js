function displaySpeakers () {
    $.getJSON('data/data.json', function (result) {
        //success one
        //console.log(result.lists);
        let listArray= result.lists;

        $.each(listArray, function (index, listName) {
            $('.jsonSpeakers').append(`<table>
                <tr><td><img style="width: 150px; height: 150px; padding-right: 50px;" src="${listName.image}"></td>
                    <td style="padding-right: 50px;">${listName.name}</td><td>${listName.description}</td></tr></table>`);

        });
    }).fail(function (err) {
        alert('We messed up!');
    });
}

$(document).ready(function () {
    displaySpeakers();
});

