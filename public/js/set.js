const search = document.querySelector('input[placeholder="search set"]');
const setContainer = document.querySelector(".section-container");
const set = document.querySelectorAll("#delete-button");

search.addEventListener("keyup", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();

        const data = {search: this.value};

        fetch("/search", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function (sets) {
            setContainer.innerHTML = "";
            loadSets(sets)
        });
    }
});

function loadSets(sets) {
    sets.forEach(set => {
        console.log(set);
        createSet(set);
    });
}

function createSet(set) {
    const template = document.querySelector("#set-template");

    const clone = template.content.cloneNode(true);

    const div = clone.querySelector(".flashcard");
    div.id = set.id;
    const name = clone.querySelector(".flashcard-category");
    name.innerHTML = set.name;
    const terms = clone.querySelector(".category-terms");
    terms.innerHTML = "x terms";

    setContainer.appendChild(clone);
}

function deleteSet(e) {
    e.preventDefault();
    e.stopPropagation();
    const id = this.parentElement.getAttribute("id");
    window.location = '/deleteSet?id=' + id;
}

set.forEach(button => button.addEventListener("click", deleteSet));